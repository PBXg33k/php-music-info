<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/

namespace Pbxg33k\MusicInfo\Service\VocaDB;

use Pbxg33k\MusicInfo\Service\BaseService;
use Pbxg33k\MusicInfo\Service\VocaDB\Endpoint;
use Pbxg33k\VocaDB\Album;
use Pbxg33k\VocaDB\Artist;
use Pbxg33k\VocaDB\Client as VocaDBClient;
use Pbxg33k\VocaDB\Song;

class Service extends BaseService
{
    /**
     * {@inheritdoc}
     */
    public function init($config = null)
    {
        if (empty($config)) {
            $config = $this->getConfig();
        }

        $this->setApiClient(new VocaDBClient(['guzzle' => $config]));
        $this->setInitialized(true);

        // Override Client endpoints (optional)
        $this->apiClient->artist = new Endpoint\Artist($this->getApiClient(), $this->getCache());
        $this->apiClient->album = new Endpoint\Album($this->getApiClient(), $this->getCache());
        $this->apiClient->song = new Endpoint\Track($this->getApiClient(), $this->getCache());

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
