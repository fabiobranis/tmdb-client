<?php


namespace UpcomingMovies\Services\HttpActionsClients;


use UpcomingMovies\Services\HttpActionsClients\Contracts\RequestNoPaginatedResults;

/**
 * Class GetAllMoviesGenres
 * @package UpcomingMovies\Services\HttpActionsClients
 */
final class GetAllMoviesGenres extends AbstractActionClient implements RequestNoPaginatedResults
{

    /**
     * The endpoint of this action.
     * It's tight coupled because this action does not make sense without this endpoint
     * @var string
     */
    private static $endpoint = 'genre/movie/list';

    /**
     * Must get the results in an Array of stdClass object
     * @return array
     */
    public function getAllResults(): array
    {
        $response = $this->restClient->handleRequest(self::$endpoint);
        return $response->getBody()->genres;
    }
}