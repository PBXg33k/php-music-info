<?php
namespace Pbxg33k\MusicInfo\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class MusicInfoExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration;

        $config = $this->processConfiguration($configuration, $configs);

    }
}