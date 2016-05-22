<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 22-May-16
 * Time: 22:21
 */

namespace Service\VocaDB\Endpoint;

use Pbxg33k\VocaDB\Album as AlbumEndpoint;
use Pbxg33k\MusicInfo\Models\IMusicServiceEndpoint;

class Album extends AlbumEndpoint implements IMusicServiceEndpoint
{
    /**
     * @return mixed
     */
    function getApiService()
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
}