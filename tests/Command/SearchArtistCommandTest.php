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

    public function setUp()
    {
        $command = new SearchArtistCommand();

        $this->commandTester = new CommandTester($command);

        parent::setUp();
    }

    /**
     * @test
     */
    public function willSearchArtistOnMultipleServices()
    {
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
        $this->commandTester->execute([
            'artist'  => 'livetune',
            'service' => 'vocadb'
        ]);

        $output = $this->commandTester->getDisplay();
        $this->assertContains('vocadb', $output);
        $this->assertNotContains('spotify', $output);
    }
}