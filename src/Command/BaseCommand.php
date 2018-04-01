<?php
/**
 * Created by PhpStorm.
 * User: oguzu
 * Date: 27-3-2017
 * Time: 16:52
 */

namespace Pbxg33k\MusicInfo\Command;


use Pbxg33k\MusicInfo\MusicInfo;
use Symfony\Component\Yaml\Yaml;
use Pbxg33k\InfoBase\Command\BaseCommand as InfoBaseCommand;

abstract class BaseCommand extends InfoBaseCommand
{
    protected function initializeService()
    {
        $config = Yaml::parse(file_get_contents(__DIR__ . '/../Resources/config/config.yml'));

        $this->infoService = new MusicInfo($config['music_info']);
    }

    /**
     * @param MusicInfo $musicInfo
     * @return BaseCommand
     */
    public function setMusicInfo($musicInfo)
    {
        $this->infoService = $musicInfo;
        return $this;
    }
}
