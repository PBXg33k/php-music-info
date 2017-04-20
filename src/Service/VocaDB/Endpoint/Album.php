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
 * Time: 22:21
 */

namespace Pbxg33k\MusicInfo\Service\VocaDB\Endpoint;

use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\MusicInfo\Model\Artist as ArtistModel;
use Pbxg33k\MusicInfo\Model\IMusicServiceEndpoint;
use Pbxg33k\VocaDB\Album as AlbumEndpoint;
use Pbxg33k\MusicInfo\Model\Album as AlbumModel;
use Pbxg33k\VocaDB\Models\Collections\AlbumCollection;
use Pbxg33k\VocaDB\Models\Album as VocaDBModel;

class Album extends AlbumEndpoint implements IMusicServiceEndpoint
{
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

    /**
     * @param VocaDBModel $raw
     * @return AlbumModel
     */
    public function transformSingle($raw)
    {
        $object = new AlbumModel();
        $object
            ->setId($raw->getId())
            ->setName($raw->getName())
            ->setArtists(
                new ArrayCollection(
                    [
                    (new ArtistModel())->setName($raw->getName())
                    ]
                )
            )
            ->setType($raw->getDiscType())
            ->setImage($raw->getMainPicture()->urlThumb)
            ->setReleaseDate(new \DateTime($raw->getReleaseDate()->formatted))
            ->setDataSource('vocadb')
            ->setRawData($raw);

        return $object;
    }

    public function transformCollection($raw)
    {
        $collection = new ArrayCollection();
        if ($raw instanceof AlbumCollection) {
            foreach ($raw->collection as $album) {
                $collection->add($this->transformSingle($album));
            }

            return $collection;
        }

        throw new \Exception('Transform failed. Object is not an instance of AlbumCollection');
    }

    public function transform($raw)
    {
        return $this->transformCollection($raw);
    }

    public function getByName($name, $complete = true)
    {
        return $this->transform(parent::getByName($name, $complete));
    }
}
