<?php


namespace UpcomingMovies\Services\HttpActionsClients;


use UpcomingMovies\Services\HttpActionsClients\Contracts\RequestNoPaginatedResults;

/**
 * Class GetAllUpcomingMoviesPages
 * @package UpcomingMovies\Services\HttpActionsClients
 */
class GetAllUpcomingMoviesPages extends AbstractActionClient implements RequestNoPaginatedResults
{

    /**
     * Must get the results in an Array of stdClass object
     * @return array
     */
    public function getAllResults(): array
    {
        $getUpcomingMovies = new GetUpcomingMoviesByPage($this->restClient);
        $result = $getUpcomingMovies->getPageResults();
        for ($page = 2; $getUpcomingMovies->getTotalPages() > $page; $page++) {
            $result = array_merge($result,$getUpcomingMovies->getPageResults($page));
        }
        return $result;
    }
}