<?php


namespace UpcomingMovies\Commands\Integration;


use Symfony\Component\Console\Output\OutputInterface;
use UpcomingMovies\Services\DatabaseSeeders\SeedGenres;
use UpcomingMovies\Services\DatabaseSeeders\SeedUpcomingMovies;

/**
 * Console action to fetch all data that we need from TMDB
 * Class FetchDataFromTMDB
 * @package UpcomingMovies\Commands\Integration
 */
class FetchDataFromTMDB
{

    /**
     * @var SeedGenres
     */
    private $seedGenres;

    /**
     * @var SeedUpcomingMovies
     */
    private $seedUpcomingMovies;

    /**
     * FetchDataFromTMDB constructor.
     * @param SeedGenres $seedGenres
     * @param SeedUpcomingMovies $seedUpcomingMovies
     */
    public function __construct(SeedGenres $seedGenres, SeedUpcomingMovies $seedUpcomingMovies)
    {
        $this->seedGenres = $seedGenres;
        $this->seedUpcomingMovies = $seedUpcomingMovies;
    }

    /**
     * We need to use invoke method here
     * @param OutputInterface $output
     */
    public function __invoke(OutputInterface $output)
    {
        $output->writeln('Fetching genres');
        $this->seedGenres->handle();
        $output->writeln('Fetching movies');
        $this->seedUpcomingMovies->handle();
        $output->writeln('Done!');
    }

}