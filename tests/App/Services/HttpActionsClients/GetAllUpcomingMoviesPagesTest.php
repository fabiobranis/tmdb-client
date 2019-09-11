<?php


namespace Tests\App\Services\HttpActionsClients;


use UpcomingMovies\Services\HttpActionsClients\GetAllUpcomingMoviesPages;

/**
 * Class GetAllUpcomingMoviesPagesTest
 * @package Tests\App\Services\HttpActionsClients
 */
class GetAllUpcomingMoviesPagesTest extends RestTest
{

    /**
     *
     */
    public function testIfArrayIsCorrect(): void
    {

        $action = new GetAllUpcomingMoviesPages($this->client);
        $data = $action->getAllResults();
        $this->assertIsArray($data);
    }

}