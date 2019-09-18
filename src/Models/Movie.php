<?php


namespace UpcomingMovies\Models;


use Foundation\Database\Pagination\MakePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Movie
 * @package UpcomingMovies\Models
 */
class Movie extends Model
{

    use MakePaginator;

    /**
     * Our mass assignable fields
     * @var array
     */
    protected $fillable = [
        'name',
        'poster',
        'backdrop',
        'overview',
        'release_date',
        'tmdb_id',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return BelongsToMany
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

}