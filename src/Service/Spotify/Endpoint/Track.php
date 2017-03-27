<?php
/**
 * Created by PhpStorm.
 * User: oguzu
 * Date: 16-10-2016
 * Time: 17:10
 */

namespace Pbxg33k\MusicInfo\Service\Spotify\Endpoint;

use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\MusicInfo\Model\BaseModel;
use Pbxg33k\MusicInfo\Model\IMusicServiceEndpoint;
use Pbxg33k\MusicInfo\Service\Spotify\Service as SpotifyService;

class Track implements IMusicServiceEndpoint
{
    const DATA_SOURCE = 'spotify';

    protected $parent;

    public function __construct(SpotifyService $apiService)
    {
        $this->parent = $apiService;
    }

    /**
     * @param $apiService
     *
     * @return mixed
     */
    public function setParent($apiService)
    {
        $this->parent = $apiService;

        return $this;
    }

    /**
     * Transform single item to model
     *
     * @param $raw
     *
     * @return BaseModel
     */
    public function transformSingle($raw)
    {
        // TODO: Implement transformSingle() method.
    }

    /**
     * Transform collection to models
     *
     * @param $raw
     *
     * @return ArrayCollection
     */
    public function transformCollection($raw)
    {
        // TODO: Implement transformCollection() method.
    }

    /**
     * Transform to models
     *
     * @param $raw
     *
     * @return ArrayCollection
     */
    public function transform($raw)
    {
        // TODO: Implement transform() method.
    }

    /**
     * @return mixed
     */
    public function getParent()
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
        // TODO: Implement getById() method.
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function getByName($name)
    {
        // TODO: Implement getByName() method.
    }

    /**
     * @param $guid
     *
     * @return mixed
     */
    public function getByGuid($guid)
    {
        // TODO: Implement getByGuid() method.
    }
}