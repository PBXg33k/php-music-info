<?php
/**
 * Created by PhpStorm.
 * User: oguzu
 * Date: 12-4-2017
 * Time: 0:34
 */

namespace Model;

use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\MusicInfo\Model\Album;
use Pbxg33k\MusicInfo\Model\Artist;
use Pbxg33k\MusicInfo\Model\Track;

class AlbumTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Album
     */
    protected $model;

    public function setUp()
    {
        $this->model = new Album();
    }

    public function testId()
    {
        $id = mt_rand(0,100);

        $this->model->setId($id);
        $this->assertEquals($id, $this->model->getId());
    }

    public function testName()
    {
        $name = "Foo";

        $this->model->setName($name);
        $this->assertEquals($name, $this->model->getName());
    }

    public function testType()
    {
        $type = "test";

        $this->model->setType($type);
        $this->assertEquals($type, $this->model->getType());
    }

    public function testArtists()
    {
        $artist = (new Artist())
            ->setId(39)
            ->setName('TestArtist');

        $artistArray = new ArrayCollection([$artist]);

        $this->model->setArtists($artistArray);
        $this->assertSame($artistArray, $this->model->getArtists());

        $this->model->removeArtist($artist);
        $this->assertEquals(0, $this->model->getArtists()->count());

        $this->model->addArtist($artist);
        $this->assertEquals($artistArray->toArray(), $this->model->getArtists()->toArray());
    }

    public function testTracks()
    {
        $track = (new Track())
            ->setId(39)
            ->setName('Test track');

        $trackArray = new ArrayCollection([$track]);

        $this->model->setTracks($trackArray);
        $this->assertSame($trackArray, $this->model->getTracks());

        $this->model->removeTrack($track);
        $this->assertEquals(0, count($this->model->getTracks()->toArray()));

        $this->model->addTrack($track);
        $this->assertEquals($trackArray->toArray(), $this->model->getTracks()->toArray());
    }

    public function testImage()
    {
        $image = 'testuristring';

        $this->model->setImage($image);
        $this->assertEquals($image, $this->model->getImage());
    }

    public function testUri()
    {
        $uri  = 'testuristring';

        $this->model->setUri($uri);
        $this->assertEquals($uri, $this->model->getUri());
    }

    /**
     * @todo replace with Genre object
     */
    public function testGenre()
    {
        $genre = 'testgenre';

        $genreArray = new ArrayCollection([$genre]);

        $this->model->setGenres($genreArray);
        $this->assertEquals($genreArray, $this->model->getGenres());
    }

    public function testReleaseDate()
    {
        $releasedate = '2017-04-01';

        $this->model->setReleaseDate($releasedate);
        $this->assertEquals($releasedate, $this->model->getReleaseDate());
    }

    public function testLabel()
    {
        $label = 'label';

        $this->model->setLabel($label);
        $this->assertEquals($label, $this->model->getLabel());
    }
}
