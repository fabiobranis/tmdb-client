<?php


namespace UpcomingMovies\Services\HttpActionsClients;


use UpcomingMovies\Services\TMDB\RestClient;

/**
 * Class AbstractActionClient
 * @package UpcomingMovies\Services\HttpActionsClients
 */
abstract class AbstractActionClient
{
    /**
     * @var RestClient
     */
    protected $restClient;

    /**
     * GetGenresByPage constructor.
     * @param RestClient $restClient
     */
    public function __construct(RestClient $restClient)
    {
        $this->restClient = $restClient;
    }
}