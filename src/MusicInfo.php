<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/

namespace Pbxg33k\MusicInfo;

use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Pbxg33k\MusicInfo\Exception\ServiceConfigurationException;
use Pbxg33k\MusicInfo\Model\IMusicService;
use Pbxg33k\MusicInfo\Service\BaseService;
use Pbxg33k\Traits\PropertyTrait;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Cache\Adapter\NullAdapter;

class MusicInfo
{
    use PropertyTrait;
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var ArrayCollection
     */
    protected $services;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var CacheItemPoolInterface
     */
    protected $cache;

    /**
     * Supported Services
     * @var array
     */
    protected $supportedServices = [];

    /**
     * MusicInfo constructor.
     *
     * @param $config
     *
     * @throws ServiceConfigurationException if musicinfo.service is missing
     */
    public function __construct($config)
    {
        $this->config = $config;

        // Set NullAdapter for cache to prevent exceptions
        $this->setCache(new NullAdapter());

        $this->services = new ArrayCollection();
        $this->setClient(
            new Client($config['defaults']['guzzle'])
        );

        if (isset($config['services'])) {
            foreach ($config['services'] as $service) {
                if (!isset($config['init_services'])) {
                    $config['init_services'] = null;
                }
                $this->loadService($service, $config['init_services']);
                $this->supportedServices[] = $service;
            }
        } else {
            throw new ServiceConfigurationException("musicinfo.services is required");
        }

    }

    /**
     * @param ClientInterface $client
     *
     * @return $this
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param CacheItemPoolInterface $cacheItemPool
     * @return $this
     */
    public function setCache(CacheItemPoolInterface $cacheItemPool)
    {
        $this->cache = $cacheItemPool;

        return $this;
    }

    /**
     * @return CacheItemPoolInterface
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * Load service
     *
     * @param $service
     * @param $init
     *
     * @return IMusicService
     *
     * @throws \Exception
     */
    public function loadService($service, $init = false)
    {
        $fqcn = implode('\\', ['Pbxg33k', 'MusicInfo', 'Service', $service, 'Service']);
        if (class_exists($fqcn)) {
            /** @var IMusicService $client */
            $client = new $fqcn();
            $client->setConfig($this->mergeConfig($service));
            $client->setClient($this->getClient());
            $client->setCache($this->getCache());
            if ($init === true) {
                $client->init();
            }
            $this->addService($client, $service);

            return $service;
        } else {
            throw new \Exception('Service class does not exist: ' . $service . ' (' . $fqcn . ')');
        }
    }

    /**
     * Merge shared config with service specific configuration
     *
     * @param $service
     *
     * @return array
     */
    public function mergeConfig($service)
    {
        $service = strtolower($service);
        if (isset($this->config['service_configuration'][$service])) {
            $config = array_merge(
                $this->config['defaults'],
                $this->config['service_configuration'][$service]
            );

            return $config;
        } else {
            return $this->config['defaults'];
        }
    }

    /**
     * Load all services
     *
     * @param bool $initialize
     *
     * @return ArrayCollection
     * @throws \Exception
     */
    public function loadServices($initialize = false)
    {
        foreach ($this->supportedServices as $service) {
            $this->loadService($service, $initialize);
        }

        return $this->getServices();
    }

    /**
     * @param IMusicService $service
     * @param               $key
     *
     * @return $this
     */
    public function addService(IMusicService $service, $key)
    {
        $this->services[strtolower($key)] = $service;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param $key
     *
     * @return BaseService|null
     */
    public function getService($key)
    {
        $key = strtolower($key);
        if (isset($this->services[$key])) {
            return $this->initializeService($this->services[$key]);
        } else {
            return null;
        }
    }

    /**
     * @param BaseService $service
     *
     * @return BaseService
     * @throws ServiceConfigurationException
     */
    public function initializeService(BaseService $service)
    {
        if (!$service->isInitialized()) {
            $service->init();
        }

        return $service;
    }

    /**
     * @param string $key
     *
     * @return $this
     */
    public function removeService($key)
    {
        if (isset($this->services[$key])) {
            unset($this->services[$key]);
        }

        return $this;
    }

    /**
     * @return BaseService|null
     */
    public function getPreferredService()
    {
        return $this->getService($this->config['preferred_order'][0]);
    }

    /**
     * Perform Multi-service search
     *
     * @param      $argument
     * @param      $type
     * @param null $servicesArg
     *
     * @return ArrayCollection
     * @throws \Exception
     */
    public function doSearch($argument, $type, $servicesArg = null)
    {
        $services = $this->_prepareSearch($servicesArg);
        $results = new ArrayCollection();

        foreach ($services as $serviceKey => $service) {
            $methodName = $this->getMethodName($type);

            if (!method_exists($service, $methodName)) {
                throw new \Exception(sprintf('Method (%s) not found in %s', $methodName, get_class($service)));
            }

            $results->set($serviceKey, $service->{$methodName}()->getByName($argument));
        }

        return $results;
    }

    /**
     * Return an arraycollection with (loaded) services
     *
     * @param mixed $servicesArg
     *
     * @return ArrayCollection
     * @throws \Exception
     */
    protected function _prepareSearch($servicesArg = null)
    {
        $services = new ArrayCollection();

        if (null === $servicesArg) {
            $services = $this->getServices();
        } elseif (is_array($servicesArg)) {
            foreach ($servicesArg as $service) {
                if (is_string($service) && $loadedService = $this->getService($service)) {
                    $services->set($service, $loadedService);
                } else {
                    throw new \Exception(sprintf('Service (%s) cannot be found', $service));
                }
            }
        } elseif (is_string($servicesArg) && $loadedService = $this->getService($servicesArg)) {
            $services->set($servicesArg, $loadedService);

        }

        return $services;
    }
}