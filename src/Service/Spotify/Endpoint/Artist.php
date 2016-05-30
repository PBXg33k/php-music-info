<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 30-May-16
 * Time: 16:30
 */

namespace Pbxg33k\MusicInfo\Service\Spotify\Endpoint;

use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\MusicInfo\Exception\MethodNotImplementedException;
use Pbxg33k\MusicInfo\Model\IMusicServiceEndpoint;
use Pbxg33k\MusicInfo\Service\Spotify\Service as SpotifyService;
use Pbxg33k\MusicInfo\Model\Artist as ArtistModel;

class Artist implements IMusicServiceEndpoint
{
    const DATA_SOURCE = 'spotify';
    /**
     * @var SpotifyService
     */
    protected $parent;

    public function __construct(SpotifyService $apiService)
    {
        $this->parent = $apiService;
    }

    /**
     * @return mixed
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }
    
    /**
     * @return SpotifyService
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
        if(is_object($raw) && isset($raw->artists)) {
            foreach($raw->artists->items as $artist) {
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