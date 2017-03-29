<?php
/**
 * Created by PhpStorm.
 * User: oguzu
 * Date: 27-3-2017
 * Time: 16:50
 */

namespace Pbxg33k\MusicInfo\Command;


use Pbxg33k\MusicInfo\MusicInfo;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SearchArtistCommand extends BaseCommand
{
    const COMMAND_NAME = 'search:artist';

    const COMMAND_DESCRIPTION = 'Search an artist on one or more services';

    /**
     * @var MusicInfo;
     */
    protected $musicInfo;

    protected function configure()
    {
        $this
            ->addArgument('artist', InputArgument::REQUIRED, 'Artist Name')
            ->addArgument('service', InputArgument::OPTIONAL, 'Service to use, default to all configured', null);

        parent::configure();
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute($input, $output);

        $service = ($input->getArgument('service') != '') ? $input->getArgument('service') : null;

        $searchResults = $this->musicInfo->doSearch($input->getArgument('artist'), 'artist', $service);

        $resultsTable = $this->generateTableForSearchResult($searchResults, [
            'id'    => 'ID',
            'name'  => 'Name',
            'image' => 'Image URL',
            'type'  => 'Type',
            'dataSource' => 'Source',
            'uri'   => 'URL'
        ], new Table($output));

        $resultsTable->render();
    }

    /**
     * Set Music info property
     *
     * @param MusicInfo $musicInfo
     */
    public function setMusicInfo(MusicInfo $musicInfo)
    {
        $this->musicInfo = $musicInfo;
    }
}