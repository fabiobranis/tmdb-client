<?php


namespace UpcomingMovies\Repositories;

use Foundation\Database\Pagination\PaginatorBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use UpcomingMovies\Models\Genre;

/**
 * Class GenreRepository
 * @package UpcomingMovies\Repositories
 */
class GenreRepository
{

    /**
     * Store only one genre
     * @param array $data
     * @return Genre
     */
    public function store(array $data): Genre
    {
        return Genre::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Genre
     */
    public function update(int $id, array $data): Genre
    {
        /** @var Genre $genre */
        $genre = Genre::find($id);
        $genre->update($data);
        return $genre;
    }

    /**
     * @param int $id
     * @return Genre|null
     */
    public function find(int $id): ?Genre
    {
        return Genre::find($id);
    }

    /**
     * @param $value
     * @param string $column
     * @return Genre|null
     */
    public function findBy($value, string $column): ?Genre
    {
        return Genre::where($column, $value)->first();
    }

    /**
     * @param array $ids
     * @return Collection
     */
    public function findTheseTmdbIds(array $ids): Collection
    {
        return Genre::whereIn('tmdb_id', $ids)->get();
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Genre::all();
    }

    /**
     * @param PaginatorBuilder $paginatorBuilder
     * @return LengthAwarePaginator
     */
    public function paginate(PaginatorBuilder $paginatorBuilder): LengthAwarePaginator
    {
        return Genre::buildPaginator($paginatorBuilder);
    }

}