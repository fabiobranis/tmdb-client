<?php


namespace UpcomingMovies\Actions;


use UpcomingMovies\Repositories\MovieRepository;

/**
 * This is our movies actions abstract class that injects the repository dependency
 * Class MoviesActions
 * @package UpcomingMovies\Actions
 */
abstract class MoviesActions
{

    /**
     * @var MovieRepository
     */
    protected $repository;

    /**
     * MoviesActions constructor.
     * @param MovieRepository $repository
     */
    public function __construct(MovieRepository $repository)
    {
        $this->repository = $repository;
    }

}