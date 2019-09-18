<?php


namespace Tests\App\DatabaseSeeders;


use Foundation\HttpClient\ClientRequest;
use Tests\App\Repositories\RepositoryTest;
use UpcomingMovies\Repositories\GenreRepository;
use UpcomingMovies\Repositories\MovieRepository;
use UpcomingMovies\Services\DatabaseSeeders\SeedGenres;
use UpcomingMovies\Services\DatabaseSeeders\SeedUpcomingMovies;
use UpcomingMovies\Services\HttpActionsClients\GetAllMoviesGenres;
use UpcomingMovies\Services\HttpActionsClients\GetAllUpcomingMoviesPages;
use UpcomingMovies\Services\TMDB\RestClient;

/**
 * Class SeedUpcomingMoviesTest
 * @package Tests\App\DatabaseSeeders
 */
class SeedUpcomingMoviesTest extends RepositoryTest
{

    /**
     * @var MovieRepository
     */
    private $movieRepository;

    /**
     * @var GenreRepository
     */
    private $genreRepository;

    /**
     * @var GetAllUpcomingMoviesPages
     */
    private $getAllUpcomingMoviesPages;

    /**
     * Set up things
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->movieRepository = new MovieRepository();
        $this->genreRepository = new GenreRepository();
        $client = new RestClient(new ClientRequest(getenv('TMDB_URL')),getenv('TMDB_TOKEN'));
        $genresSeeder = new SeedGenres($this->genreRepository, new GetAllMoviesGenres($client));
        $genresSeeder->handle();
        $this->getAllUpcomingMoviesPages = new GetAllUpcomingMoviesPages($client);
    }

    /**
     * Test if everything is ok
     */
    public function testSeedData(): void
    {
        $seeder = new SeedUpcomingMovies($this->movieRepository, $this->genreRepository, $this->getAllUpcomingMoviesPages);
        $result = $seeder->handle();
        $this->assertTrue($result);
    }
}