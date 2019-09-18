<?php


namespace UpcomingMovies\Services\HttpActionsClients;


use UpcomingMovies\Services\HttpActionsClients\Contracts\RequestPaginatedResults;

/**
 * Class GetUpcomingMoviesByPage
 * @package UpcomingMovies\Services\HttpActionsClients
 */
final class GetUpcomingMoviesByPage extends AbstractActionClient implements RequestPaginatedResults
{

    /**
     * The endpoint of this action.
     * It's tight coupled because this action does not make sense without this endpoint
     * @var string
     */
    private static $endpoint = 'movie/upcoming';

    /**
     * @var int
     */
    private $totalPages;

    /**
     * Must get the page results in an Array of stdClass object
     * @param int $page
     * @return array
     */
    public function getPageResults(int $page = 1): array
    {
        $response = $this->restClient->handleRequest(self::$endpoint, $page);
        $body = $response->getBody();
        $this->totalPages = $body->total_pages;
        return $body->results;
    }

    /**
     * @return int
     */
    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

}