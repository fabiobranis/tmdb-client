<?php


namespace UpcomingMovies\Models;


use Foundation\Database\Pagination\MakePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Genre
 * @package UpcomingMovies\Models
 */
class Genre extends Model
{

    use MakePaginator;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'tmdb_id',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}