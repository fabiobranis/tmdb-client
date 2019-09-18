<?php


namespace UpcomingMovies\Repositories;


use Foundation\Database\Pagination\PaginatorBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use UpcomingMovies\Models\Movie;

/**
 * Class MovieRepository
 * @package UpcomingMovies\Repositories
 */
class MovieRepository
{

    /**
     * Store only one movie
     * @param array $data
     * @return Movie
     */
    public function store(array $data): Movie
    {
        return Movie::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Movie
     */
    public function update(int $id, array $data): Movie
    {
        /** @var Movie $movie */
        $movie = Movie::find($id);
        $movie->update($data);
        return $movie;
    }

    /**
     * @param int $id
     * @param array $genres
     * @return bool
     */
    public function attachGenres(int $id, array $genres): bool
    {
        /** @var Movie $movie */
        $movie = Movie::find($id);
        $movie->genres()->attach($genres);
        return true;
    }

    /**
     * @param int $id
     * @param bool $withGenres
     * @return Movie|null
     */
    public function find(int $id, bool $withGenres = false): ?Movie
    {
        if (!$withGenres) {
            return Movie::find($id);
        }
        return Movie::with('genres')->find($id);
    }

    /**
     * @param $value
     * @param string $column
     * @return Movie|null
     */
    public function findBy($value, string $column): ?Movie
    {
        return Movie::where($column, $value)->first();
    }

    /**
     * @param PaginatorBuilder $paginatorBuilder
     * @return LengthAwarePaginator
     */
    public function paginate(PaginatorBuilder $paginatorBuilder): LengthAwarePaginator
    {
        return Movie::buildPaginator($paginatorBuilder, 'genres');
    }

}