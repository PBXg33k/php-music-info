<?php
namespace Model;

use GuzzleHttp\Psr7\Uri;
use Pbxg33k\MusicInfo\Model\Artist as ArtistModel;

class ArtistTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ArtistModel
     */
    protected $model;

    public function setUp()
    {
        $this->model = new ArtistModel();
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

    public function testType()
    {
        $type = "type";

        $this->model->setType($type);
        $this->assertEquals($type, $this->model->getType());
    }

    public function testUri()
    {
        $uri = new Uri("http://www.poweredby.moe/");

        $this->model->setUri($uri);
        $this->assertEquals($uri, $this->model->getUri());
        $this->assertInstanceOf(Uri::class, $this->model->getUri());
    }

    public function testDataSource()
    {
        $dataSource = "web";

        $this->model->setDataSource($dataSource);
        $this->assertEquals($dataSource, $this->model->getDataSource());
    }

    public function testRawData()
    {
        $rawData = [];

        $this->model->setRawData($rawData);
        $this->assertEquals($rawData, $this->model->getRawData());
    }
}
