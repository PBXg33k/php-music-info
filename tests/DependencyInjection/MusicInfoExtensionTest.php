<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/

namespace DependencyInjection;
use Pbxg33k\MusicInfo\DependencyInjection\MusicInfoExtension;

class MusicInfoExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testExtension()
    {
        $ext = new MusicInfoExtension();
        $ext->load([], new \Symfony\Component\DependencyInjection\ContainerBuilder());
    }
}
