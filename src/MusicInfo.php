<?php
namespace Pbxg33k\MusicInfo;

use Pbxg33k\MusicInfo\Exception\ServiceConfigurationException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\MusicInfo\Models\IMusicService;
use Symfony\Component\Config\FileLocator;

class MusicInfo
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var array
     */
    protected $services;
    protected $config;

    /**
     * Supported Services
     * @var array
     */
    protected $supportedServices = [];

    public function __construct($config)
    {
        $this->config = $config;

        $this->services = new ArrayCollection();
        $this->setClient(
            new Client($config['defaults']['guzzle'])
        );

        if(isset($config['services'])) {
            foreach($config['services'] as $service) {
                if(!isset($config['init'])) {
                    $config['init'] = null;
                }
                $this->loadService($service, $config['init']);
                $this->supportedServices[] = $service;
            }
        } else {
            throw new \Exception("musicinfo.services is required");
        }

        return $this->getServices();
    }

    public function loadConfig($configDirectory)
    {
        $locator = new FileLocator($configDirectory);
        $generalConfig = $locator->locate('config.yml');
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
     * Load service
     *
     * @param $service
     * @param $init
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function loadService($service, $init = false)
    {
        $fqcn = implode('\\',['Pbxg33k', 'MusicInfo', 'Service', $service, 'Service']);
        if(class_exists($fqcn)) {
            /** @var IMusicService $client */
            $client = new $fqcn();
            $client->setConfig($this->mergeConfig($service));
            $client->setClient($this->getClient());
            if($init == true) {
                $client->init();
            }
            $this->addService($client, $service);
        } else {
            throw new \Exception('Service class does not exist: '.$service.' ('.$fqcn.')');
        }
    }

    /**
     * Merge shared config with service specific configuration
     *
     * @param $service
     * @return array
     */
    public function mergeConfig($service)
    {
        $service = strtolower($service);
        if(isset($this->config[$service])) {
            $config = array_merge(
                $this->config[$service],
                $this->config['defaults']
            );
            return $config;
        } else {
            return $this->config['defaults'];
        }
    }

    /**
     * Load all services
     *
     * @return bool|ArrayCollection
     */
    public function loadServices()
    {
        foreach($this->supportedServices as $service) {
            $this->loadService($service);
        }

        return $this->getServices();
    }

    /**
     * @param IMusicService $service
     *
     * @return $this
     */
    public function addService(IMusicService $service, $key)
    {
        $this->services[$key] = $service;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getServices()
    {
        return $this->services;
    }

    public function getService($key)
    {
        if(isset($this->services[$key])) {
            return $this->services[$key];
        } else {
            return null;
        }
    }

    /**
     * @param string $key
     *
     * @return $this
     */
    public function removeService($key)
    {
        if(isset($this->services[$key])) {
            unset($this->services[$key]);
        }

        return $this;
    }

    /**
     * @return IMusicService
     */
    public function getPreferredService()
    {
        return $this->getService($this->config['preferred_order'][0]);
    }
}