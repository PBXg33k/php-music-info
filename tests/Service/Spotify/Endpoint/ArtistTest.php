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


use Pbxg33k\MusicInfo\Service\Spotify\Endpoint\Artist;
use Pbxg33k\MusicInfo\Model\Artist as ArtistModel;
use Pbxg33k\MusicInfo\MusicInfo;
use Pbxg33k\MusicInfo\Service\Spotify\Service as SpotifyService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Yaml\Yaml;


class ArtistTest extends \PHPUnit_Framework_TestCase
{
    const TEST_ARTIST_TITLE = 'livetune';
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

    public function testArtistSearchWithServiceAsArray()
    {
        $this->markTestIncomplete('Unit tests should only use mocked data. FIXME');


        /** @var ArrayCollection $result */
        $result = $this->musicInfo->doSearch(self::TEST_ARTIST_TITLE, 'artist', [ self::SERVICE_KEY ]);

        $this->assertInstanceOf(ArrayCollection::class, $result);
        $this->assertInstanceOf(ArtistModel::class, $result->get(self::SERVICE_KEY)->first());
    }

    public function testArtistSearchWithServiceAsString()
    {
        $this->markTestIncomplete('Unit tests should only use mocked data. FIXME');


        $result = $this->musicInfo->doSearch(self::TEST_ARTIST_TITLE, 'artist', self::SERVICE_KEY);

        $this->assertInstanceOf(ArrayCollection::class, $result);
        $this->assertInstanceOf(ArrayCollection::class, $result->get( self::SERVICE_KEY ));
        $this->assertInstanceOf(ArtistModel::class, $result->get( self::SERVICE_KEY )->first());
    }

    public function testArtistSearchByArtistName()
    {
        $this->markTestIncomplete('Unit tests should only use mocked data. FIXME');


        $result = $this->musicInfo->getService(self::SERVICE_KEY)->artist()->getByName(self::TEST_ARTIST_TITLE);

        $this->assertInstanceOf(ArrayCollection::class, $result);
        $this->assertInstanceOf(ArtistModel::class, $result->first());
    }
}