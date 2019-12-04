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
use Pbxg33k\InfoBase\Model\IServiceEndpoint;

interface IMusicServiceEndpoint extends IServiceEndpoint
{
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
