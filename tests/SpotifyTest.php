<?php
use Pbxg33k\MusicInfo\Service\Spotify\Service as SpotifyService;

/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 30-May-16
 * Time: 15:28
 */
class SpotifyTest extends PHPUnit_Framework_TestCase
{
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
}
