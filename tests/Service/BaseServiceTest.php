<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/

namespace Service;

use Pbxg33k\MusicInfo\MusicInfo;
use Pbxg33k\MusicInfo\Service\BaseService;
use Symfony\Component\Yaml\Yaml;

class BaseServiceTest extends \PHPUnit_Framework_TestCase
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
        parent::setUp();
        $config = Yaml::parse(file_get_contents(__DIR__ . '/../../src/Resources/config/config.yml'));
        $this->musicInfo = new MusicInfo($config['music_info']);
        //$this->musicInfo->loadService('Base');
        $this->baseService = new BaseService();
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
