<?php
/**
 * Created by PhpStorm.
 * User: oguzu
 * Date: 28-3-2017
 * Time: 20:26
 */


use Pbxg33k\MusicInfo\Command\SearchArtistCommand;
use Symfony\Component\Console\Tester\CommandTester;


class SearchArtistCommandTest extends PHPUnit_Framework_TestCase
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
        $command = new SearchArtistCommand();

        $musicInfo = $this->musicInfo = $this->createMock(\Pbxg33k\MusicInfo\MusicInfo::class);

        $command->setMusicInfo($musicInfo);

        $this->commandTester = new CommandTester($command);

        parent::setUp();
    }

    /**
     * @test
     */
    public function willSearchArtistOnMultipleServices()
    {
        $this->musicInfo->expects($this->once())
            ->method('doSearch')
            ->willReturn([
                'vocadb' => [
                    $this->createTestArtist('vocadb')
                ],
                'spotify' => [
                    $this->createTestArtist('spotify')
                ]
            ]);

        $this->commandTester->execute([
            'artist'  => 'livetune'
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

        $this->musicInfo->expects($this->once())
            ->method('doSearch')
            ->willReturn([
                $service => [
                    $this->createTestArtist($service)
                ]
            ]);

        $this->commandTester->execute([
            'artist'  => 'livetune',
            'service' => $service
        ]);

        $output = $this->commandTester->getDisplay();
        $this->assertContains($service, $output);
        $this->assertNotContains('spotify', $output);
    }

    protected function createTestArtist($service)
    {
        $artist = new \Pbxg33k\MusicInfo\Model\Artist();
        $artist
            ->setId(mt_rand(0,100))
            ->setName('Test name')
            ->setImage('testimage')
            ->setType('foo')
            ->setUri("http://www.google.nl/")
            ->setDataSource($service);

        return $artist;

    }

}
