<?php
namespace Pbxg33k\MusicInfo\Model;

use GuzzleHttp\ClientInterface;

/**
 * MusicService Interface.
 *
 * This interface must be implemented by supported services in order to guarantee compliance.
 * The library MUST only perform calls to methods defined in this interface.
 * If your Service implementation requires additional actions you will need:
 *      - Extend your implementation with extra methods and call those in the methods defined in this interface
 *      - Contribute and help development by opening a Pull Request with your changes, accompanied with description
 *
 *
 * @package Pbxg33k\MusicInfo\Models
 */
interface IMusicService
{
    /**
     * @param ClientInterface $client
     *
     * @return mixed
     */
    public function setClient(ClientInterface $client);

    /**
     * @return ClientInterface
     */
    public function getClient();

    /**
     * @param $config
     * @return mixed
     */
    public function setConfig($config= null);

    /**
     * @return mixed
     */
    public function getConfig();

    /**
     * Set the API Library client
     *
     * @param $apiClient
     * @return mixed
     */
    public function setApiClient($apiClient);

    /**
     * Get the API Library client
     * @return mixed
     */
    public function getApiClient();

    /**
     * Service specific initializer
     *
     * Construct your API client in this method.
     * It is set to be the method that is called by Symfony's Service Loader
     *
     * @param array $config
     * @return mixed
     */
    public function init($config = []);

    /**
     * @return IMusicServiceEndpoint
     */
    public function artist();

    /**
     * @return IMusicServiceEndpoint
     */
    public function album();

    /**
     * @return IMusicServiceEndpoint
     */
    public function song();

    /**
     * @return IMusicServiceEndpoint
     */
    public function track();
}