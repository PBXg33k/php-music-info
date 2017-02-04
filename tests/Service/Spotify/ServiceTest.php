<?php
namespace Service\Spotify;

use Pbxg33k\MusicInfo\MusicInfo;
use Pbxg33k\MusicInfo\Service\Spotify\Endpoint\Artist;
use Pbxg33k\MusicInfo\Service\Spotify\Endpoint\Track;
use Pbxg33k\MusicInfo\Service\Spotify\Service as SpotifyService;
use Symfony\Component\Yaml\Yaml;

class ServiceTest extends \PHPUnit_Framework_TestCase
{
    const TEST_SEARCH_NAME = 'livetune';
    const SERVICE_KEY = 'spotify';
    /**
     * @var \Pbxg33k\MusicInfo\MusicInfo
     */
    protected $musicInfo;

    /**
     * @var SpotifyService
     */
    protected $spotifyService;

    public function setUp()
    {
        $config = Yaml::parse(file_get_contents(__DIR__ . '/../../../src/Resources/config/config.yml'));
        $this->musicInfo = new MusicInfo($config['music_info']);
        $this->spotifyService = $this->musicInfo->getService('spotify');
    }

    public function testSpotifyService()
    {
        $this->assertInstanceOf('Pbxg33k\MusicInfo\Service\Spotify\Service', $this->spotifyService);
    }

    public function testSpotifyServiceClasses()
    {
        $this->assertInstanceOf(Artist::class, $this->spotifyService->getArtist());
        $this->assertInstanceOf(Artist::class, $this->spotifyService->artist());
        $this->assertInstanceOf(Track::class,  $this->spotifyService->getTrack());
        $this->assertInstanceOf(Track::class,  $this->spotifyService->track());
        $this->assertInstanceOf('SpotifyWebAPI\Session', $this->spotifyService->getSpotifySession());
        $this->assertInstanceOf('SpotifyWebAPI\SpotifyWebAPI', $this->spotifyService->getApiClient());
        $this->assertTrue($this->spotifyService->isInitialized());
    }
    
    public function testSpotifyArtistClasses()
    {
        $this->assertInstanceOf('Pbxg33k\MusicInfo\Service\Spotify\Service', $this->spotifyService->artist()->getParent());
    }
}
