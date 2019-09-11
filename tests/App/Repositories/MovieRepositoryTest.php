<?php


namespace Tests\App\Repositories;


use UpcomingMovies\Repositories\GenreRepository;
use UpcomingMovies\Repositories\MovieRepository;

class MovieRepositoryTest extends RepositoryTest
{

    /**
     * @var MovieRepository
     */
    private $repository;

    /**
     * @var GenreRepository
     */
    private $genreRepository;

    /**
     * Create the dependencies
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new MovieRepository();
        $this->genreRepository = new GenreRepository();
    }

    /**
     * Test if the movie is stored
     */
    public function testStoreShouldDoTheJob(): void
    {
        $newMovie = $this->repository->store([
            'name' => 'Test name',
            'poster' => 'some.url/poster.png',
            'backdrop' => 'some.url/backdrop.png',
            'overview' => 'Some description',
            'release_date' => '2019-01-01',
            'tmdb_id' => 10,
        ]);
        $this->assertIsObject($newMovie);
    }

    /**
     * Test updates
     */
    public function testUpdateShouldDoTheJob(): void
    {
        $newMovie = $this->repository->store([
            'name' => 'Test name',
            'poster' => 'some.url/poster.png',
            'backdrop' => 'some.url/backdrop.png',
            'overview' => 'Some description',
            'release_date' => '2019-01-01',
            'tmdb_id' => 10,
        ]);
        $this->assertIsObject($newMovie);

        $movie = $this->repository->findBy(10,'tmdb_id');
        $movie->name = 'Test name changed';
        $newMovie = $this->repository->update($movie->id, [
            'name' => 'Test name changed',
        ]);
        $this->assertIsObject($newMovie);
    }

    /**
     * Test if the genres got attached to the movie
     */
    public function testAttachGenres(): void
    {

        $newMovie = $this->repository->store([
            'name' => 'Test name',
            'poster' => 'some.url/poster.png',
            'backdrop' => 'some.url/backdrop.png',
            'overview' => 'Some description',
            'release_date' => '2019-01-01',
            'tmdb_id' => 10,
        ]);

        $genre = [
            'name' => 'Some name A',
            'tmdb_id' => 1
        ];
        $genreA = $this->genreRepository->store($genre);

        $genre = [
            'name' => 'Some name B',
            'tmdb_id' => 2
        ];

        $genreB = $this->genreRepository->store($genre);

        $result = $this->repository->attachGenres($newMovie->id, [$genreA->id,$genreB->id]);
        $this->assertTrue($result);
    }
}