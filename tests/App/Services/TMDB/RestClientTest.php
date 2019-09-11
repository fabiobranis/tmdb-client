<?php


namespace Tests\App\Services\TMDB;


use Foundation\HttpClient\ClientRequest;
use Tests\TestApp;
use UpcomingMovies\Services\TMDB\RestClient;

/**
 * Class RestClientTest
 * @package Tests\App\Services\TMDB
 */
class RestClientTest extends TestApp
{

    /**
     * Test if the TMDB client do the job
     */
    public function testRequest200(): void
    {
        $clientRequest = new ClientRequest(getenv('TMDB_URL'));
        $client = new RestClient($clientRequest,getenv('TMDB_TOKEN'));
        $response = $client->handleRequest('genre/movie/list');
        $this->assertEquals(200, $response->getStatus());
    }
}