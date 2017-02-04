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

use Pbxg33k\MusicInfo\DependencyInjection\Configuration;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testConfig()
    {
        $config = new Configuration();

        $this->assertInstanceOf(\Symfony\Component\Config\Definition\Builder\TreeBuilder::class, $config->getConfigTreeBuilder());
    }
}
