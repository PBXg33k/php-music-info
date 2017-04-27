<?php
/**
 * Created by PhpStorm.
 * User: oguzu
 * Date: 11-4-2017
 * Time: 23:52
 */


use Pbxg33k\MusicInfo\Command\SearchTrackCommand;
use Symfony\Component\Console\Tester\CommandTester;

class SearchTrackCommandTest extends PHPUnit_Framework_TestCase
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
        $command = new SearchTrackCommand();

        $this->commandTester = new CommandTester($command);

        parent::setUp();
    }

    /**
     * @test
     */
    public function willSearchTrackOnMultipleServices()
    {

        $this->commandTester->execute([
            'track' => 'Tell Your World'
        ]);

        $output = $this->commandTester->getDisplay();
        $this->assertContains('vocadb', $output);
        $this->assertContains('spotify', $output);
    }

    /**
     * @test
     */
    public function willSearchTrackOnlyOnSelectedService()
    {
        $service = 'vocadb';

        $this->commandTester->execute([
            'track' => 'Tell Your World',
            'service' => $service
        ]);

        $output = $this->commandTester->getDisplay();
        $this->assertContains($service, $output);
        $this->assertNotContains('spotify', $output);
    }

    protected function createTestTrack($dataSource)
    {
        $track = new \Pbxg33k\MusicInfo\Model\Track();
        $track
            ->setId(mt_rand(0,100))
            ->setName('Test name')
            ->setImage('uri')
            ->setLength(3939)
            ->setUri(new \GuzzleHttp\Psr7\Uri('http://poweredby.moe/'))
            ->setDataSource($dataSource);

        return $track;
    }
}
