<?php


namespace Tests\App\Services\HttpActionsClients;


use UpcomingMovies\Services\HttpActionsClients\GetUpcomingMoviesByPage;

class GetUpcomingMoviesByPageTest extends RestTest
{

    /**
     * Just a simple test.
     * In a real world application I would make an DTO class and map into the result and check if the array has the
     * instances in it's rows
     */
    public function testIfArrayIsCorrect(): void
    {

        $action = new GetUpcomingMoviesByPage($this->client);
        // first page - only for testing purposes
        $pageData = $action->getPageResults();
        $this->assertIsArray($pageData);
    }
}