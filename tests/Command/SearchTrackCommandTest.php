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
        $this->commandTester->execute([
            'track' => 'Tell Your World',
            'service' => 'vocadb'
        ]);

        $output = $this->commandTester->getDisplay();
        $this->assertContains('vocadb', $output);
        $this->assertNotContains('spotify', $output);
    }
}
