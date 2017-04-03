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
use Pbxg33k\MusicInfo\Model\Artist as ArtistModel;
use Pbxg33k\MusicInfo\Model\IMusicServiceEndpoint;
use Pbxg33k\MusicInfo\Service\Spotify\Service as SpotifyService;
use Psr\Cache\CacheItemPoolInterface;

class Artist implements IMusicServiceEndpoint
{
    const DATA_SOURCE = 'spotify';

    /**
     * @var SpotifyService
     */
    protected $parent;

    protected $cache;

    public function __construct(SpotifyService $apiService, CacheItemPoolInterface $cache)
    {
        $this->parent = $apiService;
        $this->setCache($cache);
    }

    /**
     * @param $parent
     *
     * @return $this
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return SpotifyService
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param CacheItemPoolInterface $cacheItemPool
     * @return $this
     */
    public function setCache(CacheItemPoolInterface $cacheItemPool)
    {
        $this->cache = $cacheItemPool;

        return $this;
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
        throw new MethodNotImplementedException;
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
        throw new MethodNotImplementedException;
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
        return $this->transform($this->getParent()->getApiClient()->search($name, 'artist'));
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
            ->setType($raw->type)
            ->setUri($raw->external_urls->spotify)
            ->setRawData($raw)
            ->setDataSource(self::DATA_SOURCE);

        if(is_array($raw->images) && count($raw->images) >= 1) {
            $object->setImage($raw->images[array_keys($raw->images)[0]]->url);
        }

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
        if (is_object($raw) && isset($raw->artists)) {
            foreach ($raw->artists->items as $artist) {
                $collection->add($this->transformSingle($artist));
            }

            return $collection;
        }
        throw new \Exception('Transform failed');
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
}