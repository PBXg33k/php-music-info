<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/

namespace Pbxg33k\MusicInfo;

use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Pbxg33k\InfoBase\InfoService;
use Pbxg33k\MusicInfo\Exception\ServiceConfigurationException;
use Pbxg33k\MusicInfo\Model\IMusicService;
use Pbxg33k\MusicInfo\Service\BaseService;
use Pbxg33k\Traits\PropertyTrait;

class MusicInfo extends InfoService
{
    protected function getNamespace()
    {
        return __NAMESPACE__;
    }
}
