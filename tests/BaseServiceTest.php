<?php

use Pbxg33k\MusicInfo\Exception\ServiceConfigurationException;

class BaseServiceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Pbxg33k\MusicInfo\MusicInfo
     */
    protected $musicInfo;

    /**
     * @var \Pbxg33k\MusicInfo\Service\BaseService
     */
    protected $baseService;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $config = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__ . '/../src/Resources/config/config.yml'));
        $this->musicInfo = new \Pbxg33k\MusicInfo\MusicInfo($config['music_info']);
        //$this->musicInfo->loadService('Base');
        $this->baseService = new \Pbxg33k\MusicInfo\Service\BaseService();
        $this->baseService->setConfig($this->musicInfo->mergeConfig('Base'));
        $this->baseService->setClient($this->musicInfo->getClient());
    }

    public function testClient()
    {
        $this->assertInstanceOf(\GuzzleHttp\ClientInterface::class, $this->baseService->getClient());
    }

    /**
     * @expectedException \Pbxg33k\MusicInfo\Exception\ServiceConfigurationException
     */
    public function testInit()
    {
        $this->baseService->init();
    }

    /**
     * @expectedException \Pbxg33k\MusicInfo\Exception\ServiceConfigurationException
     */
    public function testArtist()
    {
        $this->baseService->artist();
    }

    /**
     * @expectedException \Pbxg33k\MusicInfo\Exception\ServiceConfigurationException
     */
    public function testAlbum()
    {
        $this->baseService->album();
    }

    /**
     * @expectedException \Pbxg33k\MusicInfo\Exception\ServiceConfigurationException
     */
    public function testSong()
    {
        $this->baseService->song();
    }

    /**
     * @expectedException \Pbxg33k\MusicInfo\Exception\ServiceConfigurationException
     */
    public function testTrack()
    {
        $this->baseService->track();
    }
}
