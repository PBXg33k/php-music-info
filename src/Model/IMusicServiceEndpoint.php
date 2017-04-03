<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/

namespace Pbxg33k\MusicInfo\Model;


use Doctrine\Common\Collections\ArrayCollection;
use Psr\Cache\CacheItemPoolInterface;

interface IMusicServiceEndpoint
{
    /**
     * @param $apiService
     *
     * @return mixed
     */
    public function setParent($apiService);

    /**
     * @param CacheItemPoolInterface $cacheItemPool
     *
     * @return mixed
     */
    public function setCache(CacheItemPoolInterface $cacheItemPool);

    /**
     * Transform single item to model
     *
     * @param $raw
     *
     * @return BaseModel
     */
    public function transformSingle($raw);

    /**
     * Transform collection to models
     *
     * @param $raw
     *
     * @return ArrayCollection
     */
    public function transformCollection($raw);

    /**
     * Transform to models
     *
     * @param $raw
     *
     * @return ArrayCollection
     */
    public function transform($raw);

    /**
     * @return mixed
     */
    public function getParent();

    /**
     * @param $arguments
     *
     * @return mixed
     */
    public function get($arguments);

    /**
     * @param $arguments
     *
     * @return mixed
     */
    public function getComplete($arguments);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getById($id);

    /**
     * @param $name
     *
     * @return mixed
     */
    public function getByName($name);

    /**
     * @param $guid
     *
     * @return mixed
     */
    public function getByGuid($guid);
}
