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
        $this->commandTester->execute([
            'album' => 'Tell Your World',
            'service' => 'vocadb'
        ]);

        $output = $this->commandTester->getDisplay();
        $this->assertContains('vocadb', $output);
        $this->assertNotContains('spotify', $output);
    }
}
