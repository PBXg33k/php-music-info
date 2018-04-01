<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/

class Test extends PHPUnit_Framework_TestCase
{

    /**
     * @var \Pbxg33k\MusicInfo\MusicInfo
     */
    protected $musicInfo;

    public function setUp()
    {
        parent::setUp();
        $config = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__ . '/../src/Resources/config/config.yml'));
        $this->musicInfo = new \Pbxg33k\MusicInfo\MusicInfo($config['music_info']);
        $this->musicInfo->loadServices(true);
    }
    
    public function testMusicServiceClient()
    {
        $this->assertInstanceOf('GuzzleHttp\ClientInterface', $this->musicInfo->getClient());
    }

    public function testArtistSearchOnAllEnabledServices()
    {
        $this->markTestIncomplete('Looks like VocaDB has updated their API. Too lazy to fix atm');

        $result = $this->musicInfo->doSearch('livetune', 'artist');

        $this->assertInstanceOf(\Doctrine\Common\Collections\ArrayCollection::class, $result);
    }

    /**
     * @expectedException \Exception
     */
    public function testExceptionOnNonExistingService()
    {
        $this->musicInfo->doSearch('Exception Time', 'The Exception', ['idontexist']);
    }

    /**
     * @test
     */
    public function willInitializeServicesManually()
    {

        $config = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__ . '/../src/Resources/config/config.yml'));

        // Override init_services value
        $config['music_info']['init_services'] = false;

        $this->musicInfo = new \Pbxg33k\MusicInfo\MusicInfo($config['music_info']);
        $this->musicInfo->loadServices(false);

        $vocaDBService = $this->musicInfo->initializeService($this->musicInfo->getService('vocadb'));

        $this->assertTrue($vocaDBService->isInitialized());
    }
}
