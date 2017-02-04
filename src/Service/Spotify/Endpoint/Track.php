<?php
namespace Pbxg33k\MusicInfo\Service\Spotify\Endpoint;

use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Psr7\Uri;
use Pbxg33k\MusicInfo\Exception\MethodNotImplementedException;
use Pbxg33k\MusicInfo\Model\IMusicServiceEndpoint;
use Pbxg33k\MusicInfo\Model\Track as TrackModel;
use Pbxg33k\MusicInfo\Service\Spotify\Service as SpotifyService;

class Track implements IMusicServiceEndpoint
{
    const DATA_SOURCE = 'spotify';

    protected $parent;

    public function __construct(SpotifyService $apiService)
    {
        $this->setParent($apiService);
    }

    /**
     * @param $apiService
     *
     * @return $this
     */
    public function setParent($apiService)
    {
        $this->parent = $apiService;

        return $this;
    }

    /**
     * @param $raw
     *
     * @return TrackModel
     */
    public function transformSingle($raw)
    {
        $object = new TrackModel;
        $object
            ->setId($raw->id)
            ->setName($raw->name)
            ->setExplicit($raw->explicit)
            ->setLength($raw->duration_ms % 60)
            ->setPreviewUri(new Uri($raw->preview_url))
            ->setDataSource(self::DATA_SOURCE)
            ->setRawData($raw);

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
        if (is_object($raw) && isset($raw->tracks)) {
            foreach ($raw->tracks->items as $track) {
                $collection->add($this->transformSingle($track));
            }

            return $collection;
        }

        throw new \Exception('Transformation failed');
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
        throw new MethodNotImplementedException();
        // TODO: Implement getComplete() method.
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getById($id)
    {
        return $this->getParent()->getApiClient()->getTrack($id);;
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function getByName($name)
    {
        return $this->transform($this->getParent()->getApiClient()->search($name, 'track'));
    }

    /**
     * @param $guid
     *
     * @return mixed
     */
    public function getByGuid($guid)
    {
        return $this->getParent()->getApiClient()->getTrack($guid);
    }
}