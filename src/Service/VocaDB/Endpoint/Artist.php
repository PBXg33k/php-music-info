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
use Pbxg33k\VocaDB\Client;
use Psr\Cache\CacheItemPoolInterface;

class Artist extends ArtistEndpoint implements IMusicServiceEndpoint
{
    /**
     *
     */
    const DATA_SOURCE = 'vocadb';

    /**
     * @var CacheItemPoolInterface
     */
    protected $cache;

    public function __construct(Client $client, CacheItemPoolInterface $cache)
    {
        $this->setCache($cache);
        parent::__construct($client);
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
        $cacheKey = substr(sprintf(
            '%s_get_%s',
            self::DATA_SOURCE,
            preg_replace('~[A-Za-z0-9\.\_]~', '_',$name)
        ),0,64);

        $cachedObject = $this->cache->getItem($cacheKey);

        if(!$cachedObject->isHit()) {
            $result = $this->transform(parent::getByName($name, $complete));
            $cachedObject->set($result);
        } else {
            $result = $cachedObject->get();
        }

        return $result;
    }

    /**
     * @param VocaDBArtistModel $raw
     *
     * @return ArtistModel
     */
    public function transformSingle($raw)
    {
        $cacheKey = substr(sprintf(
            '%s_transform_%s',
            self::DATA_SOURCE,
            preg_replace('~[A-Za-z0-9\.\_]~', '_',$raw->getDefaultName())
        ),0,64);

        $cachedObject = $this->cache->getItem($cacheKey);

        if(!$cachedObject->isHit()) {
            $object = new ArtistModel;
            $object
                ->setId($raw->getId())
                ->setName($raw->getName())
                ->setType($raw->getArtistType())
                ->setDataSource(self::DATA_SOURCE)
                ->setRawData($raw);
            $cachedObject->set($cachedObject);
        } else {
            /** @var ArtistModel $object */
            $object = $cachedObject->get();
        }

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
