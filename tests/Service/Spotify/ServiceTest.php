<?php
namespace Service\Spotify;

use Pbxg33k\MusicInfo\Service\Spotify\Service as SpotifyService;
use Doctrine\Common\Collections\ArrayCollection;


class ServiceTest extends \PHPUnit_Framework_TestCase
{
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
        $config = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__ . '/../src/Resources/config/config.yml'));
        $this->musicInfo = new Pbxg33k\MusicInfo\MusicInfo($config['music_info']);
        $this->spotifyService = $this->musicInfo->getService('spotify');
    }

    public function testSpotifyService()
    {
        $this->assertInstanceOf('Pbxg33k\MusicInfo\Service\Spotify\Service', $this->spotifyService);
    }

    public function testSpotifyServiceClasses()
    {
        $this->assertInstanceOf('Pbxg33k\MusicInfo\Service\Spotify\Endpoint\Artist', $this->spotifyService->getArtist());
        $this->assertInstanceOf('Pbxg33k\MusicInfo\Service\Spotify\Endpoint\Artist', $this->spotifyService->artist());
        $this->assertInstanceOf('SpotifyWebAPI\Session', $this->spotifyService->getSpotifySession());
        $this->assertInstanceOf('SpotifyWebAPI\SpotifyWebAPI', $this->spotifyService->getApiClient());
        $this->assertTrue($this->spotifyService->isInitialized());
    }
    
    public function testSpotifyArtistClasses()
    {
        $this->assertInstanceOf('Pbxg33k\MusicInfo\Service\Spotify\Service', $this->spotifyService->artist()->getParent());
    }

    public function testArtistSearchWithServiceAsArray()
    {
        /** @var ArrayCollection $result */
        $result = $this->musicInfo->doSearch('livetune', 'artist', [ self::SERVICE_KEY ]);

        $this->assertInstanceOf(ArrayCollection::class, $result);
        $this->assertInstanceOf(ArrayCollection::class, $result->get( self::SERVICE_KEY ));
        $this->assertInstanceOf(\Pbxg33k\MusicInfo\Model\Artist::class, $result->get( self::SERVICE_KEY )->first());
    }

    public function testArtistSearchWithServiceAsString()
    {
        $result = $this->musicInfo->doSearch('livetune', 'artist', self::SERVICE_KEY);

        $this->assertInstanceOf(ArrayCollection::class, $result);
        $this->assertInstanceOf(ArrayCollection::class, $result->get( self::SERVICE_KEY ));
        $this->assertInstanceOf(\Pbxg33k\MusicInfo\Model\Artist::class, $result->get( self::SERVICE_KEY )->first());
    }

    public function testTrackSearchWithServiceAsArray()
    {
        $result = $this->musicInfo->doSearch('Tell Your World', 'track', [ self::SERVICE_KEY ]);

        $this->assertInstanceOf(ArrayCollection::class, $result);
        $this->assertInstanceOf(ArrayCollection::class, $result->get( self::SERVICE_KEY ));
        $this->assertInstanceOf(\Pbxg33k\MusicInfo\Model\Track::class, $result->get( self::SERVICE_KEY )->first());
    }

    public function testTrackSearchWithServiceAsString()
    {
        $result = $this->musicInfo->doSearch('Tell Your World', 'track', self::SERVICE_KEY );

        $this->assertInstanceOf(ArrayCollection::class, $result);
        $this->assertInstanceOf(ArrayCollection::class, $result->get( self::SERVICE_KEY ));
        $this->assertInstanceOf(\Pbxg33k\MusicInfo\Model\Track::class, $result->get( self::SERVICE_KEY )->first());
    }
}
