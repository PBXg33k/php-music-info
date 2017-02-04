<?php
namespace Service\Spotify\Endpoint;

use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\MusicInfo\Model\BaseModel;
use Pbxg33k\MusicInfo\Model\IMusicServiceEndpoint;
use Pbxg33k\MusicInfo\Service\Spotify\Service as SpotifyService;
use Pbxg33k\MusicInfo\Model\Album as AlbumModel;

class Album implements IMusicServiceEndpoint
{
    const DATA_SOURCE = 'spotify';

    /**
     * @var SpotifyService
     */
    protected $parent;

    public function __construct(SpotifyService $service)
    {
        $this->parent = $service;
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
        $object = new AlbumModel();
        $object
            ->setId($raw->id)
            ->setName($raw->name)
            ->setType($raw->album_type)
            ->setUri($raw->external_urls->spotify)
            ->setRawData($raw)
            ->setDataSource(self::DATA_SOURCE);

        return $object;
    }

    /**
     * @param $raw
     *
     * @return ArrayCollection
     * @throws \Exception
     */
    public function transformCollection($raw)
    {
        $collection = new ArrayCollection();
        if (is_object($raw) && isset($raw->albums)) {
            foreach ($raw->albums->items as $album) {
                $collection->add($this->transformSingle($album));
            }

            return $collection;
        }

        throw new \Exception('Transform failed');
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
        return $this->transformCollection($raw);
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