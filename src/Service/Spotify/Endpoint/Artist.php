<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 30-May-16
 * Time: 16:30
 */

namespace Pbxg33k\MusicInfo\Service\Spotify\Endpoint;

use Pbxg33k\MusicInfo\Model\IMusicServiceEndpoint;
use Pbxg33k\MusicInfo\Service\Spotify\Service as SpotifyService;

class Artist implements IMusicServiceEndpoint
{
    /**
     * @var SpotifyService
     */
    protected $parent;

    public function __construct(SpotifyService $apiService)
    {
        $this->parent = $apiService;
    }

    /**
     * @return mixed
     */
    function setParent($parent)
    {
        $this->parent = $parent;
    }
    
    /**
     * @return SpotifyService
     */
    function getParent()
    {
        return $this->parent;
    }

    /**
     * @param $arguments
     *
     * @return mixed
     */
    public function get($arguments)
    {
        // TODO: Implement get() method.
    }

    /**
     * @param $arguments
     *
     * @return mixed
     */
    public function getComplete($arguments)
    {
        // TODO: Implement getComplete() method.
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getById($id)
    {
        return $this->getById($id);
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function getByName($name)
    {
        return $this->getParent()->getApiClient()->search($name, 'artist');
    }

    /**
     * @param $guid
     *
     * @return mixed
     */
    public function getByGuid($guid)
    {
        return $this->getParent()->getApiClient()->getArtist($guid);
    }

}