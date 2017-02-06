<?php
namespace Pbxg33k\MusicInfo\Service\MusicBrainz\Endpoint;

use Doctrine\Common\Collections\ArrayCollection;
use MusicBrainz\Filters\RecordingFilter;
use Pbxg33k\MusicInfo\Model\BaseModel;
use Pbxg33k\MusicInfo\Model\Song as SongModel;
use Pbxg33k\MusicInfo\Model\IMusicServiceEndpoint;
use Pbxg33k\MusicInfo\Service\MusicBrainz\Service;

class Song implements IMusicServiceEndpoint
{
    protected $parent;

    public function __construct($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @param $apiService
     *
     * @return mixed
     */
    public function setParent($apiService)
    {
        $this->parent = $apiService;
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
        $object = new SongModel();
        $object
            ->setId($raw->id)
            ->setTitle($raw->title)
            ->setDuration($raw->length)
            ->setIsrc($raw->isrc);
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
        // TODO: Implement getParent() method.
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