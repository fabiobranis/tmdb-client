<?php


namespace UpcomingMovies\Services\DatabaseSeeders;


use Exception;
use UpcomingMovies\Repositories\GenreRepository;
use UpcomingMovies\Services\HttpActionsClients\GetAllMoviesGenres;

/**
 * Seed the genres from TMDB
 * Class SeedGenres
 * @package UpcomingMovies\Services\DatabaseSeeders
 */
class SeedGenres
{
    /**
     * @var GenreRepository
     */
    private $genreRepository;

    /**
     * @var GetAllMoviesGenres
     */
    private $getAllMoviesGenres;

    /**
     * SeedGenres constructor.
     * @param GenreRepository $genreRepository
     * @param GetAllMoviesGenres $getAllMoviesGenres
     */
    public function __construct(GenreRepository $genreRepository, GetAllMoviesGenres $getAllMoviesGenres)
    {
        $this->genreRepository = $genreRepository;
        $this->getAllMoviesGenres = $getAllMoviesGenres;
    }

    /**
     * Store all genres
     */
    public function handle(): void
    {
        try{
            foreach ($this->getAllMoviesGenres->getAllResults() as $result) {

                $data = [
                    'name' => $result->name,
                    'tmdb_id' => $result->id,
                ];
                $genre = $this->genreRepository->findBy($result->id, 'tmdb_id');
                if ($genre) {
                    $this->genreRepository->update($genre->id, $data);
                } else {
                    $this->genreRepository->store($data);
                }
            }
        } catch (Exception $exception) {
            die($exception);
        }
    }

}