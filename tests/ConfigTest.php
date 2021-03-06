<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/

class ConfigTest extends PHPUnit_Framework_TestCase
{
    const YAML_NAMESPACE = 'music_info';
    /**
     * @var \Pbxg33k\MusicInfo\MusicInfo
     */
    protected $musicInfo;

    protected $config;

    public function setUp()
    {
        $this->config = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__ . '/../src/Resources/config/config.yml'));
        $this->musicInfo = new Pbxg33k\MusicInfo\MusicInfo($this->config[self::YAML_NAMESPACE]);
    }

    public function testConfigWithoutInitService()
    {
        unset($this->config[self::YAML_NAMESPACE]['init_services']);
        $this->musicInfo = new Pbxg33k\MusicInfo\MusicInfo($this->config[self::YAML_NAMESPACE]);
    }

    public function testServiceConfigurationExceptionOnConstruct()
    {
        $this->expectException(\Pbxg33k\InfoBase\Exception\ServiceConfigurationException::class);
        unset($this->config[self::YAML_NAMESPACE]['services']);
        $this->musicInfo = new Pbxg33k\MusicInfo\MusicInfo($this->config[self::YAML_NAMESPACE]);
    }
    
    public function testLoadService()
    {
        $this->musicInfo->loadService('VocaDB', true);
    }
    
    public function testExceptionOnNonExistingService()
    {
        $this->expectException(\Exception::class);
        $this->musicInfo->loadService('i do not exist lol');
    }

    public function testLoadServicesMethod()
    {
        $this->musicInfo->loadServices();
    }

    public function testGetNonExistingService()
    {
        $this->assertNull($this->musicInfo->getService('i do not exist'));
    }

    public function testRemoveService()
    {
        $this->assertInstanceOf('Pbxg33k\MusicInfo\Service\VocaDB\Service', $this->musicInfo->getService('vocadb'));
        $this->musicInfo->removeService('vocadb');
        $this->assertNull($this->musicInfo->getService('vocadb'));
    }
    
    public function testDefaults()
    {
        unset($this->config[self::YAML_NAMESPACE]['service_configuration']['vocadb']);
        $this->musicInfo = new Pbxg33k\MusicInfo\MusicInfo($this->config[self::YAML_NAMESPACE]);
    }

    public function testPreferredServiceConfig()
    {
        $this->assertEquals(
            $this->musicInfo->getService(strtolower($this->config[self::YAML_NAMESPACE]['preferred_order'][0])),
            $this->musicInfo->getPreferredService()
        );
    }
}
