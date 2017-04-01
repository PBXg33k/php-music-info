<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/

namespace Service\VocaDB;

use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\MusicInfo\Model\IMusicServiceEndpoint;
use Pbxg33k\MusicInfo\MusicInfo;
use Pbxg33k\MusicInfo\Service\VocaDB\Endpoint\Album;
use Pbxg33k\MusicInfo\Service\VocaDB\Endpoint\Artist;
use Pbxg33k\MusicInfo\Service\VocaDB\Endpoint\Track;
use Pbxg33k\MusicInfo\Service\VocaDB\Service as VocaDBService;
use Symfony\Component\Yaml\Yaml;

class ServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Pbxg33k\MusicInfo\MusicInfo
     */
    protected $musicInfo;

    /**
     * @var VocaDBService
     */
    protected $vocaDBService;

    public function setUp()
    {
        parent::setUp();
        $config = Yaml::parse(file_get_contents(__DIR__ . '/../../../src/Resources/config/config.yml'));
        $this->musicInfo = new MusicInfo($config['music_info']);
        $this->vocaDBService = $this->musicInfo->getService('vocadb');
    }

    public function testVocaDBService()
    {
        $this->assertInstanceOf('Pbxg33k\MusicInfo\Service\VocaDB\Service', $this->vocaDBService);
    }

    public function testArtistSearchWithServiceAsArray()
    {
        $result = $this->musicInfo->doSearch('livetune', 'artist', ['vocadb']);

        $this->assertInstanceOf(ArrayCollection::class, $result);
    }

    public function testArtistSearchWithServiceAsString()
    {
        $result = $this->musicInfo->doSearch('livetune', 'artist', 'vocadb');

        $this->assertInstanceOf(ArrayCollection::class, $result);
    }

    /**
     * @expectedException \Exception
     */
    public function testNonExistingCall()
    {
        $this->musicInfo->doSearch('nonexisting', 'call', ['vocadb']);
    }

    /**
     * @test
     */
    public function willReturnArtistEndpoint()
    {
        $vocaDBService = $this->musicInfo->getService('vocadb');

        $this->assertInstanceOf(Artist::class, $vocaDBService->artist());
    }

    /**
     * @test
     */
    public function willReturnAlbumEndpoint()
    {
        $vocaDBService = $this->musicInfo->getService('vocadb');

        $this->assertInstanceOf(Album::class, $vocaDBService->album());
    }

    /**
     * @test
     */
    public function willReturnSongEndpoint()
    {
        $vocaDBService = $this->musicInfo->getService('vocadb');

        $this->assertInstanceOf(Track::class, $vocaDBService->song());
    }

    /**
     * @test
     */
    public function willReturnTrackEndpoint()
    {
        $vocaDBService = $this->musicInfo->getService('vocadb');

        $this->assertInstanceOf(Track::class, $vocaDBService->track());
    }
}