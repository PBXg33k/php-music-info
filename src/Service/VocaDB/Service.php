<?php
namespace Pbxg33k\MusicInfo\Service\VocaDB;

use Pbxg33k\MusicInfo\Service\BaseService;
use Pbxg33k\VocaDB\Client as VocaDBClient;

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

        return $this;
    }

    public function artist()
    {
        return $this->getApiClient()->artist;
    }

    public function album()
    {
        return $this->getApiClient()->album;
    }

    public function song()
    {
        return $this->getApiClient()->song;
    }

    public function track()
    {
        return $this->song();
    }
}