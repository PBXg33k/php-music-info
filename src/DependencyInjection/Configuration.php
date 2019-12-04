<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/

namespace Pbxg33k\MusicInfo\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Pbxg33k\InfoBase\DependencyInjection\Configuration as InfoConfiguration;

class Configuration extends InfoConfiguration
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        return $this->buildConfigTreeBuilder($treeBuilder, 'music_info');
    }
}
