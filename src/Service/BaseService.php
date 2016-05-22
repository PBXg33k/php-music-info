<?php
namespace Pbxg33k\MusicInfo\Service;

use Exception\ServiceConfigurationException;
use GuzzleHttp\ClientInterface;
use Pbxg33k\MusicInfo\Models\IMusicService;
use Pbxg33k\MusicInfo\Models\IMusicServiceEndpoint;

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