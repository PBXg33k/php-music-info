<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 22-May-16
 * Time: 22:14
 */

namespace Pbxg33k\MusicInfo\Service\VocaDB\Endpoint;

use Pbxg33k\VocaDB\Artist as ArtistEndpoint;
use Pbxg33k\MusicInfo\Model\IMusicServiceEndpoint;

class Artist extends ArtistEndpoint implements IMusicServiceEndpoint
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
}