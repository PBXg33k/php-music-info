<?php
/**
 * Created by PhpStorm.
 * User: oguzu
 * Date: 11-4-2017
 * Time: 23:06
 */


use Pbxg33k\MusicInfo\Command\SearchAlbumCommand;
use Symfony\Component\Console\Tester\CommandTester;


class SearchAlbumCommandTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var CommandTester
     */
    protected $commandTester;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    protected $musicInfo;

    public function setUp()
    {
        $command = new SearchAlbumCommand();

        $this->commandTester = new CommandTester($command);

        parent::setUp();
    }

    /**
     * @test
     */
    public function willSearchAlbumOnMultipleServices()
    {
        $this->commandTester->execute([
            'album' => 'Tell Your World'
        ]);

        $output = $this->commandTester->getDisplay();
        $this->assertContains('vocadb', $output);
        $this->assertContains('spotify', $output);
    }

    /**
     * @test
     */
    public function willSearchArtistOnlyOnSelectedService()
    {
        $service = 'vocadb';

        $this->commandTester->execute([
            'album' => 'Tell Your World',
            'service' => $service
        ]);

        $output = $this->commandTester->getDisplay();
        $this->assertContains($service, $output);
        $this->assertNotContains('spotify', $output);
    }

    protected function createTestAlbum($dataSource)
    {
        $album = new \Pbxg33k\MusicInfo\Model\Album();
        $album
            ->setId(mt_rand(0,100))
            ->setName('Test name')
            ->setType('single')
            ->setImage('uri')
            ->setDataSource($dataSource);

        return $album;
    }
}
