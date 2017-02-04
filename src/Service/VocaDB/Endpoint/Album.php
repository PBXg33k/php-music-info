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
 * Time: 22:21
 */

namespace Pbxg33k\MusicInfo\Service\VocaDB\Endpoint;

use Pbxg33k\MusicInfo\Model\IMusicServiceEndpoint;
use Pbxg33k\VocaDB\Album as AlbumEndpoint;

class Album extends AlbumEndpoint implements IMusicServiceEndpoint
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

    public function transformSingle($raw)
    {
        // TODO: Implement transformSingle() method.
    }

    public function transformCollection($raw)
    {
        // TODO: Implement transformCollection() method.
    }

    public function transform($raw)
    {
        // TODO: Implement transform() method.
    }
}