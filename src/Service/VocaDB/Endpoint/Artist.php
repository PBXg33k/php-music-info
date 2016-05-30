<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 22-May-16
 * Time: 22:14
 */

namespace Pbxg33k\MusicInfo\Service\VocaDB\Endpoint;

use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\VocaDB\Artist as ArtistEndpoint;
use Pbxg33k\MusicInfo\Model\IMusicServiceEndpoint;
use Pbxg33k\MusicInfo\Model\Artist as ArtistModel;

class Artist extends ArtistEndpoint implements IMusicServiceEndpoint
{
    /**
     *
     */
    const DATA_SOURCE = 'vocadb';
    /**
     * @return mixed
     */
    public function getParent()
    {
        // TODO: Implement getApiService() method.
    }

    /**
     * Aliases getById
     *
     * @param $guid
     * @return mixed
     */
    public function getByGuid($guid)
    {
        return $this->getById($guid);
    }

    /**
     * @return mixed
     */
    public function setParent($apiService)
    {
        // TODO: Implement setApiService() method.
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
            ->setId($raw->getId())
            ->setName($raw->getName())
            ->setType($raw->getArtistType())
            ->setDataSource(self::DATA_SOURCE)
            ->setRawData($raw);

        return $object;
    }

    /**
     * @param $raw
     */
    public function transformCollection($raw)
    {
        $collection = new ArrayCollection();
        foreach($raw->collection as $artist)
        {
            $collection->add($this->transformSingle($artist));
        }

    }

    /**
     * @param $raw
     */
    public function transform($raw)
    {
        return $this->transformCollection($raw);
    }
}