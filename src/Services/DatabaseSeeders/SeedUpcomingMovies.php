<?php


namespace UpcomingMovies\Services\DatabaseSeeders;


use Exception;
use UpcomingMovies\Repositories\GenreRepository;
use UpcomingMovies\Repositories\MovieRepository;
use UpcomingMovies\Services\HttpActionsClients\GetAllUpcomingMoviesPages;

/**
 * Seed the movies and attach the genres
 * Class SeedUpcomingMovies
 * @package UpcomingMovies\Services\DatabaseSeeders
 */
class SeedUpcomingMovies
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
     * SeedGenres constructor.
     * @param MovieRepository $movieRepository
     * @param GenreRepository $genreRepository
     * @param GetAllUpcomingMoviesPages $getAllUpcomingMoviesPages
     */
    public function __construct(MovieRepository $movieRepository, GenreRepository $genreRepository, GetAllUpcomingMoviesPages $getAllUpcomingMoviesPages)
    {
        $this->movieRepository = $movieRepository;
        $this->genreRepository = $genreRepository;
        $this->getAllUpcomingMoviesPages = $getAllUpcomingMoviesPages;
    }

    /**
     * Store all movies and attach the genres
     */
    public function handle(): bool
    {
        try {
            foreach ($this->getAllUpcomingMoviesPages->getAllResults() as $result) {
                $data = [
                    'name' => $result->title,
                    'poster' => getenv('IMG_URL') . $result->poster_path,
                    'backdrop' => getenv('IMG_URL') . $result->backdrop_path,
                    'overview' => $result->overview,
                    'release_date' => $result->release_date,
                    'tmdb_id' => $result->id,
                ];
                $movie = $this->movieRepository->findBy($result->id, 'tmdb_id');
                if ($movie) {
                    $newMovie = $this->movieRepository->update($movie->id, $data);
                } else {
                    $newMovie = $this->movieRepository->store($data);
                }

                if (count($result->genre_ids) > 0) {
                    $genres = $this->genreRepository->findTheseTmdbIds($result->genre_ids);
                    $this->movieRepository->attachGenres($newMovie->id, $genres->map(function ($item) {
                        return $item->id;
                    })->toArray());
                }
            }
            return true;
        } catch (Exception $exception) {
            die($exception);
        }
    }
}