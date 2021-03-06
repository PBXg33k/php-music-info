<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/

/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 22-May-16
 * Time: 22:14
 */

namespace Pbxg33k\MusicInfo\Service\VocaDB\Endpoint;

use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\MusicInfo\Model\Artist as ArtistModel;
use Pbxg33k\MusicInfo\Model\IMusicServiceEndpoint;
use Pbxg33k\VocaDB\Artist as ArtistEndpoint;
use Pbxg33k\VocaDB\Models\Artist as VocaDBArtistModel;

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
     *
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

    public function getByName($name, $complete = true)
    {
        return $this->transform(parent::getByName($name, $complete));
    }

    /**
     * @param VocaDBArtistModel $raw
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
     * @param $raw
     *
     * @return ArrayCollection
     */
    public function transform($raw)
    {
        return $this->transformCollection($raw);
    }
}
