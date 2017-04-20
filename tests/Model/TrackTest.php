<?php
/**
 * Created by PhpStorm.
 * User: oguzu
 * Date: 14-4-2017
 * Time: 14:39
 */

namespace Model;

use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Psr7\Uri;
use Pbxg33k\MusicInfo\Model\Track as TrackModel;
use Pbxg33k\MusicInfo\Model\Artist;

class TrackTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TrackModel
     */
    protected $model;

    public function setUp()
    {
        $this->model = new TrackModel();
    }

    public function testId()
    {
        $id = mt_rand(0,100);

        $this->model->setId($id);
        $this->assertEquals($id, $this->model->getId());
    }

    public function testName()
    {
        $name = "teststring";

        $this->model->setName($name);
        $this->assertEquals($name, $this->model->getName());
    }

    public function testImage()
    {
        $image = "image";

        $this->model->setImage($image);
        $this->assertEquals($image, $this->model->getImage());
    }

    public function testUri()
    {
        $uri = new Uri("http://www.poweredby.moe/");

        $this->model->setUri($uri);
        $this->assertEquals($uri, $this->model->getUri());
        $this->assertInstanceOf(Uri::class, $this->model->getUri());
    }

    public function testExplicit()
    {
        $this->model->setExplicit(true);
        $this->assertTrue($this->model->getExplicit());
    }

    public function testLength()
    {
        $length  = 130;

        $this->model->setLength($length);
        $this->assertEquals($length, $this->model->getLength());
    }

    public function testPreviewUri()
    {
        $previewUri = new Uri("http://www.poweredby.moe/");

        $this->model->setPreviewUri($previewUri);
        $this->assertEquals($previewUri, $this->model->getPreviewUri());
    }

    public function testAlbumTrack()
    {
        $albumtracks = new ArrayCollection();

        $this->model->setAlbumTrack($albumtracks);
        $this->assertEquals($albumtracks, $this->model->getAlbumTrack());
    }

    public function testArtists()
    {
        $artist = (new Artist())
            ->setId(39)
            ->setName('TestArtist');

        $artistArray = new ArrayCollection([$artist]);

        $this->model->setTrackArtists($artistArray);
        $this->assertSame($artistArray, $this->model->getTrackArtists());

        $this->model->removeTrackArtist($artist);
        $this->assertEquals(0, $this->model->getTrackArtists()->count());

        $this->model->addTrackArtist($artist);
        $this->assertEquals($artistArray->toArray(), $this->model->getTrackArtists()->toArray());
    }
}
