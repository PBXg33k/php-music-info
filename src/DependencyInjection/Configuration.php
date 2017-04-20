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
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('music_info');

        // @codingStandardsIgnoreStart
        $rootNode
            ->children()
                ->booleanNode('init_services')->defaultTrue()->end()
                ->arrayNode('services')->end()
                ->arrayNode('preferred_order')->end()
                ->arrayNode('service_weight')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('service')->end()
                            ->floatNode('weight')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('guzzle')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('proxy')->defaultNull()->end()
                    ->end()
                ->end()
            ->end()
        ;

        // @codingStandardsIgnoreEnd

        return $treeBuilder;
    }
}
