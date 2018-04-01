<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/

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
        $this->markTestIncomplete('Unit tests should only use mocked data. FIXME');


        /** @var ArrayCollection $result */
        $result = $this->musicInfo->doSearch(self::TEST_TRACK_TITLE, 'track', [ self::SERVICE_KEY ]);

        $this->assertInstanceOf(ArrayCollection::class, $result);
        $this->assertInstanceOf(TrackModel::class, $result->get(self::SERVICE_KEY)->first());
    }

    public function testTrackSearchByTrackName()
    {
        $this->markTestIncomplete('Unit tests should only use mocked data. FIXME');


        $result = $this->musicInfo->getService(self::SERVICE_KEY)->track()->getByName(self::TEST_TRACK_TITLE);

        $this->assertInstanceOf(ArrayCollection::class, $result);
        $this->assertInstanceOf(TrackModel::class, $result->first());
    }
}