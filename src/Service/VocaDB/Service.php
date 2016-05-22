<?php
namespace Pbxg33k\MusicInfo\Service\VocaDB;

use Pbxg33k\MusicInfo\Service\BaseService;
use Pbxg33k\VocaDB\Client as VocaDBClient;
use Pbxg33k\VocaDB\Album;
use Pbxg33k\VocaDB\Artist;
use Pbxg33k\VocaDB\Song;
use Service\VocaDB\Endpoint;

class Service extends BaseService
{
    /**
     * {@inheritdoc}
     */
    public function init($config = null)
    {
        if(!$config) {
            $config = $this->getConfig()['guzzle'];
        }

        $this->setApiClient(new VocaDBClient(['guzzle' => $config]));
        $this->client = new VocaDBClient($config);
        $this->setInitialized();

        // Override Client endpoints (optional)
        $this->client->artist   = new Endpoint\Artist($this->getApiClient());
        $this->client->album    = new Endpoint\Album($this->getApiClient());

        return $this;
    }

    /**
     * @return Artist
     */
    public function artist()
    {
        return $this->getApiClient()->artist;
    }

    /**
     * @return Album
     */
    public function album()
    {
        return $this->getApiClient()->album;
    }

    /**
     * @return Song
     */
    public function song()
    {
        return $this->getApiClient()->song;
    }

    /**
     * @return Song
     */
    public function track()
    {
        return $this->song();
    }
}