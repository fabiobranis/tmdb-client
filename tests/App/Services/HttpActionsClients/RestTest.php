<?php


namespace Tests\App\Services\HttpActionsClients;


use Foundation\HttpClient\ClientRequest;
use Tests\TestApp;
use UpcomingMovies\Services\TMDB\RestClient;

/**
 * Class RestTest
 * @package Tests\App\Services\HttpActionsClients
 */
abstract class RestTest extends TestApp
{

    /**
     * @var RestClient
     */
    protected $client;

    /**
     * Set up our test
     */
    public function setUp(): void
    {
        $clientRequest = new ClientRequest(getenv('TMDB_URL'));
        $this->client = new RestClient($clientRequest,getenv('TMDB_TOKEN'));
        parent::setUp();
    }
}