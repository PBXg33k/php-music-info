<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/

namespace Pbxg33k\MusicInfo\Service\Spotify\Endpoint;

use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\MusicInfo\Exception\MethodNotImplementedException;
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
        return $this->parent;
    }

    /**
     * @param $arguments
     *
     * @return void
     *
     * @throws MethodNotImplementedException
     */
    public function get($arguments)
    {
        throw new MethodNotImplementedException();
        // TODO: Implement get() method.
    }

    /**
     * @param $arguments
     *
     * @return void
     *
     * @throws MethodNotImplementedException
     */
    public function getComplete($arguments)
    {
        throw new MethodNotImplementedException();
        // TODO: Implement getComplete() method.
    }

    /**
     * @param $id
     *
     * @return array|object
     */
    public function getById($id)
    {
        return $this->getByGuid($id);
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function getByName($name)
    {
        return $this->transform($this->getParent()->getApiClient()->search($name, 'album'));
    }

    /**
     * @param $guid
     *
     * @return array|object
     */
    public function getByGuid($guid)
    {
        return $this->transform($this->getParent()->getApiClient()->getAlbum($guid));
    }
}