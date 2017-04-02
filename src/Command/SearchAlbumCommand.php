<?php
/**
 * Created by PhpStorm.
 * User: oguzu
 * Date: 1-4-2017
 * Time: 16:07
 */

namespace Pbxg33k\MusicInfo\Command;


use Pbxg33k\MusicInfo\MusicInfo;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SearchAlbumCommand extends BaseCommand
{
    const COMMAND_NAME = 'search:album';

    const COMMAND_DESCRIPTION = 'Search an album on one or more services';

    /**
     * @var MusicInfo
     */
    protected $musicInfo;

    protected function configure()
    {
        $this
            ->addArgument('album', InputArgument::REQUIRED, 'Album name')
            ->addArgument('service', InputArgument::OPTIONAL, 'Service to use, default to all enabled');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $service = ($input->getArgument('service') != '') ? $input->getArgument('service') : null;

        $searchResult = $this->musicInfo->doSearch($input->getArgument('album'), 'album', $service);

        $resultsTable = $this->generateTableForSearchResult($searchResult, [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'image' => 'Image',
            'dataSource' => 'Source'
        ], new Table($output));

        $resultsTable->render();

    }
}