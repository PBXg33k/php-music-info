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

use Pbxg33k\InfoBase\Model\IService;

/**
 * MusicService Interface.
 *
 * This interface must be implemented by supported services in order to guarantee compliance.
 * The library MUST only perform calls to methods defined in this interface.
 * If your Service implementation requires additional actions you will need:
 *      - Extend your implementation with extra methods and call those in the methods defined in this interface
 *      - Contribute and help development by opening a Pull Request with your changes, accompanied with description
 *
 * @package Pbxg33k\MusicInfo\Models
 */
interface IMusicService extends IService
{
    /**
     * @return IMusicServiceEndpoint
     */
    public function artist();

    /**
     * @return IMusicServiceEndpoint
     */
    public function album();

    /**
     * @return IMusicServiceEndpoint
     */
    public function song();

    /**
     * @return IMusicServiceEndpoint
     */
    public function track();
}
