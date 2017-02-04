<?php
namespace Service\Spotify\Endpoint;

use Pbxg33k\MusicInfo\Model\Track as TrackModel;
use Pbxg33k\MusicInfo\MusicInfo;
use Pbxg33k\MusicInfo\Service\Spotify\Service as SpotifyService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Yaml\Yaml;

class TrackTest extends \PHPUnit_Framework_TestCase
{
    const TEST_TRACK_TITLE = 'Tell Your World';
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
        $config = Yaml::parse(file_get_contents(__DIR__ . '/../../../../src/Resources/config/config.yml'));
        $this->musicInfo = new MusicInfo($config['music_info']);
        $this->spotifyService = $this->musicInfo->getService('spotify');
    }

    public function testTrackSearchWithServiceAsArray()
    {
        /** @var ArrayCollection $result */
        $result = $this->musicInfo->doSearch(self::TEST_TRACK_TITLE, 'track', [ self::SERVICE_KEY ]);

        $this->assertInstanceOf(ArrayCollection::class, $result);
        $this->assertInstanceOf(TrackModel::class, $result->get(self::SERVICE_KEY)->first());
    }

    public function testTrackSearchByTrackName()
    {
        $result = $this->musicInfo->getService(self::SERVICE_KEY)->track()->getByName(self::TEST_TRACK_TITLE);

        $this->assertInstanceOf(ArrayCollection::class, $result);
        $this->assertInstanceOf(TrackModel::class, $result->first());
    }
}