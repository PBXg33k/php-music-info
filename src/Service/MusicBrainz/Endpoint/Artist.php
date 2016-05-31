<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 31-May-16
 * Time: 23:41
 */

namespace Pbxg33k\MusicInfo\Service\MusicBrainz\Endpoint;

use Doctrine\Common\Collections\ArrayCollection;
use MusicBrainz\Filters\ArtistFilter;
use Pbxg33k\MusicInfo\Model\Artist as ArtistModel;
use Pbxg33k\MusicInfo\Model\IMusicServiceEndpoint;
use Pbxg33k\MusicInfo\Service\MusicBrainz\Service;

class Artist implements IMusicServiceEndpoint
{
    /**
     * @var Service
     */
    protected $parent;

    public function __construct($parent)
    {
        $this->setParent($parent);
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
     * @param $raw
     *
     * @return ArtistModel
     */
    public function transformSingle($raw)
    {
        $object = new ArtistModel;
        $object
            ->setId($raw->id)
            ->setName($raw->name)
            ->setType('artist')
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
        if(is_array($raw)) {
            foreach ($raw as $artist) {
                $collection->add($this->transform($artist));
            }
        }

        return $collection;
    }

    /**
     * @param $raw
     *
     * @return ArrayCollection
     * @throws \Exception
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
        return $this->transform($this->parent->getApiClient()->search(new ArtistFilter(['artist' => $name])));
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