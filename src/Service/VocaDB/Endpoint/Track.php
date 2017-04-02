<?php
/**
 * Created by PhpStorm.
 * User: oguzu
 * Date: 29-3-2017
 * Time: 16:29
 */

namespace Pbxg33k\MusicInfo\Service\VocaDB\Endpoint;

use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\MusicInfo\Model\BaseModel;
use Pbxg33k\MusicInfo\Model\IMusicServiceEndpoint;
use Pbxg33k\VocaDB\Song as TrackEndpoint;
use Pbxg33k\VocaDB\Models\Track as VocaDBTrackModel;
use Pbxg33k\MusicInfo\Model\Track as TrackModel;

class Track extends TrackEndpoint implements IMusicServiceEndpoint
{
    const DATA_SOURCE = 'vocadb';

    protected $parent;

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
     * @param VocaDBTrackModel $raw
     *
     * @return BaseModel
     */
    public function transformSingle($raw)
    {
        $object = new TrackModel();
        $object
            ->setId($raw->getId())
            ->setName($raw->getName());

        var_dump(
            __FILE__, __LINE__,
            $raw
        );die();

        return $object;

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
        $collection = new ArrayCollection();
        foreach ($raw->collection as $artist) {
            $collection->add($this->transformSingle($artist));
        }

        return $collection;
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
        return $this->parent;
    }

    /**
     * @param $guid
     *
     * @return mixed
     */
    public function getByGuid($guid, $complete = true)
    {
        return $this->transform(parent::getById($guid, $complete));
    }

    public function getByName($name, $complete = true)
    {
        return $this->transform(parent::getByName($name, $complete));
    }
}