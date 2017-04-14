<?php
/**
 * Created by PhpStorm.
 * User: oguzu
 * Date: 27-3-2017
 * Time: 16:52
 */

namespace Pbxg33k\MusicInfo\Command;


use Pbxg33k\MusicInfo\MusicInfo;
use Pbxg33k\Traits\HydratableTrait;
use Pbxg33k\Traits\PropertyTrait;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Yaml\Yaml;

abstract class BaseCommand extends Command
{
    const COMMAND_PREFIX = 'music-info';

    const COMMAND_NAME = 'undefined';

    const COMMAND_DESCRIPTION = 'Description not set';

    /**
     * @var MusicInfo
     */
    protected $musicInfo;

    protected function initializeMusicInfo()
    {
        $config = Yaml::parse(file_get_contents(__DIR__ . '/../Resources/config/config.yml'));

        $this->musicInfo = new MusicInfo($config['music_info']);
    }

    protected function configure()
    {
        if (!$this->musicInfo) {
            $this->initializeMusicInfo();
        }

        $this
            ->setName(static::COMMAND_PREFIX . ':' . static::COMMAND_NAME)
            ->setDescription(static::COMMAND_DESCRIPTION)
            ->addOption('debug', 'd', InputOption::VALUE_NONE, 'Enables debug mode');

        parent::configure();
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('debug')) {
            Debug::enable();
        }

        parent::initialize($input, $output);
    }

    /**
     * @param       $collection
     * @param       $columns
     * @param Table      $table
     * @return Table
     */
    protected function generateTableForSearchResult($collection, $columns, Table $table)
    {
        $table->setHeaders(array_values($columns));

        foreach ($collection as $service => $serviceResult) {
            $table = $this->generateTableRows($serviceResult, $columns, $table);
        }

        return $table;
    }

    /**
     * @param       $collection
     * @param       $columns
     * @param Table      $table
     * @return Table
     */
    protected function generateTableRows($collection, $columns, Table $table)
    {
        foreach ($collection as $item) {
            $row = [];

            foreach ($columns as $columnKey => $columnValue) {
                $row[] = $item->getPropertyValue($columnKey);
            }

            $table->addRow($row);
        }

        return $table;
    }
}
