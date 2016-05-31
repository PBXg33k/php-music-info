<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 30-May-16
 * Time: 15:11
 */

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

        return $treeBuilder;
    }
}