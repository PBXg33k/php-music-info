<?php


class VocaDBTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected $musicInfo;
    
    protected function _before()
    {
        $this->musicInfo = new \Pbxg33k\MusicInfo\MusicInfo();
    }

    protected function _after()
    {
    }

    // tests
    public function testMe()
    {

    }
}