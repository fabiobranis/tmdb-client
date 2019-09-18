<?php


namespace UpcomingMovies\Services\HttpActionsClients\Contracts;


/**
 * Interface RequestNoPaginatedResults
 * @package UpcomingMovies\Services\HttpActionsClients\Contracts
 */
interface RequestNoPaginatedResults
{
    /**
     * Must get the results in an Array of stdClass object
     * @return array
     */
    public function getAllResults(): array;
}