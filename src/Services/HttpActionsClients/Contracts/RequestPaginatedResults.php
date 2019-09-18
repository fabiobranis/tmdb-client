<?php


namespace UpcomingMovies\Services\HttpActionsClients\Contracts;


/**
 * Interface RequestPaginatedResults
 * @package UpcomingMovies\Services\HttpActionsClients\Contracts
 */
interface RequestPaginatedResults
{

    /**
     * Must get the page results in an Array of stdClass object
     * @param int $page
     * @return array
     */
    public function getPageResults(int $page = 1): array;
}