<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/
namespace Pbxg33k\MusicInfo\Command;

use Pbxg33k\MusicInfo\Model\Artist;
use Pbxg33k\MusicInfo\Service\Spotify\Service;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SearchSpotifyTrackCommand extends Command
{
    /**
     * @var Service
     */
    protected $spotifyService;

    protected function configure()
    {
        $this
            ->setName('music-info:search:spotify:artist')
            ->setDescription('Search an artist on Spotify')
            ->setHelp("This command will search and return an artist using the Spotify API")
            ->addOption('save', 's', InputOption::VALUE_OPTIONAL)
            ->addArgument('query', InputArgument::REQUIRED, 'Artist name', false)
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $artist = $input->getArgument('artist');
        if(!$artist) {
            throw new \InvalidArgumentException('Artist missing');
        }

        $result = $this->spotifyService->artist()->getByName($artist);

        $table = new Table($output);
        $table
            ->setHeaders(['ID','Artist']);

        if(!$result) {
            $output->writeln('No results');
        } else {
            /** @var Artist $artist */
            foreach($result as $artist) {
                $table
                    ->addRow([
                        $artist->getId(),
                        $artist->getName()
                    ]);
            }

            $table->render();
        }
    }

    public function setSpotifyService(Service $service)
    {
        $this->spotifyService = $service;
    }
}