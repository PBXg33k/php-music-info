<?php
namespace Service\VocaDB;

use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\MusicInfo\MusicInfo;
use Pbxg33k\MusicInfo\Service\VocaDB\Service as VocaDBService;
use Symfony\Component\Yaml\Yaml;

class ServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Pbxg33k\MusicInfo\MusicInfo
     */
    protected $musicInfo;

    /**
     * @var VocaDBService
     */
    protected $vocaDBService;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $config = Yaml::parse(file_get_contents(__DIR__ . '/../../../src/Resources/config/config.yml'));
        $this->musicInfo = new MusicInfo($config['music_info']);
        $this->vocaDBService = $this->musicInfo->getService('vocadb');
    }

    public function testVocaDBService()
    {
        $this->assertInstanceOf('Pbxg33k\MusicInfo\Service\VocaDB\Service', $this->vocaDBService);
    }

    public function testArtistSearchWithServiceAsArray()
    {
        $result = $this->musicInfo->doSearch('livetune', 'artist', ['vocadb']);

        $this->assertInstanceOf(ArrayCollection::class, $result);
    }

    public function testArtistSearchWithServiceAsString()
    {
        $result = $this->musicInfo->doSearch('livetune', 'artist', 'vocadb');

        $this->assertInstanceOf(ArrayCollection::class, $result);
    }

    /**
     * @expectedException \Exception
     */
    public function testNonExistingCall()
    {
        $this->musicInfo->doSearch('nonexisting', 'call', ['vocadb']);
    }
}