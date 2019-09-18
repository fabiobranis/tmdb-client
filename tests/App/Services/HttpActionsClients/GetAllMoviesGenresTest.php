<?php


namespace Tests\App\Services\HttpActionsClients;


use UpcomingMovies\Services\HttpActionsClients\GetAllMoviesGenres;

/**
 * Class GetAllMoviesGenresTest
 * @package Tests\App\Services\HttpActionsClients
 */
class GetAllMoviesGenresTest extends RestTest
{

    /**
     * Just a simple test.
     * In a real world application I would make an DTO class and map into the result and check if the array has the
     * instances in it's rows
     */
    public function testIfArrayIsCorrect(): void
    {
        $action = new GetAllMoviesGenres($this->client);
        $array = $action->getAllResults();
        $this->assertIsArray($array);
    }
}