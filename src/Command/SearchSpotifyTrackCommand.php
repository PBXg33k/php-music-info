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
use Pbxg33k\MusicInfo\Model\Track;
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
            ->setName('music-info:search:spotify:track')
            ->setDescription('Search a track on Spotify')
            ->setHelp("This command will search and return a track using the Spotify API")
            ->addOption('save', 'p', InputOption::VALUE_OPTIONAL, false)
            ->addArgument('query', InputArgument::REQUIRED, 'Track title')
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $trackTitle = $input->getArgument('query');
        if(!$trackTitle) {
            throw new \InvalidArgumentException('Track title missing');
        }

        $result = $this->spotifyService->title()->getByName($trackTitle);

        $table = new Table($output);
        $table
            ->setHeaders(['ID','Artist', 'Name']);

        if(!$result) {
            $output->writeln('No results');
        } else {
            /** @var Track $track */
            foreach($result as $track) {
                $table
                    ->addRow([
                        $track->getId(),
                        $track->getTrackArtists(),
                        $track->getName()
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