<?php
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
