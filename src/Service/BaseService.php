<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/

namespace Pbxg33k\MusicInfo\Service;

use GuzzleHttp\ClientInterface;
use Pbxg33k\MusicInfo\Exception\ServiceConfigurationException;
use Pbxg33k\MusicInfo\Model\IMusicService;
use Pbxg33k\MusicInfo\Model\IMusicServiceEndpoint;
use Psr\Cache\CacheItemPoolInterface;

class BaseService implements IMusicService
{
    const ERR_METHOD_NOT_IMPLEMENTED = "Method not implemented";
    /**
     * @var ClientInterface
     */
    protected $client;

    protected $apiClient;

    protected $config;

    protected $initialized = false;

    /**
     * @var CacheItemPoolInterface
     */
    protected $cache;

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param ClientInterface $client
     *
     * @return BaseService
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getApiClient()
    {
        return $this->apiClient;
    }

    /**
     * @param mixed $apiClient
     *
     * @return BaseService
     */
    public function setApiClient($apiClient)
    {
        $this->apiClient = $apiClient;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     *
     * @return BaseService
     */
    public function setConfig($config = null)
    {
        $this->config = $config;

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
     * @param CacheItemPoolInterface $cache
     * @return BaseService
     */
    public function setCache(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;

        return $this;
    }



    /**
     * @return boolean
     */
    public function isInitialized()
    {
        return $this->initialized;
    }

    /**
     * @param boolean $initialized
     *
     * @return BaseService
     */
    public function setInitialized($initialized)
    {
        $this->initialized = $initialized;

        return $this;
    }


    /**
     * Service specific initializer
     *
     * Construct your API client in this method.
     * It is set to be the method that is called by Symfony's Service Loader
     *
     * @param array $config
     *
     * @return void
     * @throws ServiceConfigurationException
     */
    public function init($config = [])
    {
        throw new ServiceConfigurationException(self::ERR_METHOD_NOT_IMPLEMENTED);
    }

    /**
     *
     * @throws ServiceConfigurationException
     * @return IMusicServiceEndpoint
     */
    public function artist()
    {
        throw new ServiceConfigurationException(self::ERR_METHOD_NOT_IMPLEMENTED);
    }

    /**
     *
     * @throws ServiceConfigurationException
     * @return IMusicServiceEndpoint
     */
    public function album()
    {
        throw new ServiceConfigurationException(self::ERR_METHOD_NOT_IMPLEMENTED);
    }

    /**
     *
     * @throws ServiceConfigurationException
     * @return IMusicServiceEndpoint
     */
    public function song()
    {
        throw new ServiceConfigurationException(self::ERR_METHOD_NOT_IMPLEMENTED);
    }

    /**
     *
     * @throws ServiceConfigurationException
     * @return IMusicServiceEndpoint
     */
    public function track()
    {
        throw new ServiceConfigurationException(self::ERR_METHOD_NOT_IMPLEMENTED);
    }
}