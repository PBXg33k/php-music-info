<?php

/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 31-May-16
 * Time: 23:57
 */
class MusicBrainzTest extends PHPUnit_Framework_TestCase
{
    protected $musicInfo;

    protected $musicBrainzService;

    public function setUp()
    {
        $config = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__ . '/../src/Resources/config/config.yml'));
        $this->musicInfo = new \Pbxg33k\MusicInfo\MusicInfo($config['music_info']);
        $this->musicBrainzService = $this->musicInfo->getService('musicbrainz');
    }
    
    public function testMusicBrainzService()
    {
        $this->assertInstanceOf('Pbxg33k\MusicInfo\Service\MusicBrainz\Service', $this->musicBrainzService);
    }
}
