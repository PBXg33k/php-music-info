<?php
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
