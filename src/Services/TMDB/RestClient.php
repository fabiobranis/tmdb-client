<?php


namespace UpcomingMovies\Services\TMDB;


use Foundation\HttpClient\ClientRequest;
use Foundation\HttpClient\ClientResponse;

/**
 * Class RestClient
 * @package UpcomingMovies\Services\TMDB
 */
class RestClient
{

    /**
     * @var ClientRequest
     */
    private $client;

    /**
     * @var string
     */
    private $token;

    /**
     * RestClient constructor.
     * @param ClientRequest $client
     * @param string $token
     */
    public function __construct(ClientRequest $client, string $token)
    {
        $this->client = $client;
        $this->token = $token;
    }

    /**
     * @param string $endpoint
     * @param int $page
     * @return ClientResponse
     */
    public function handleRequest(string $endpoint, int $page = null): ClientResponse
    {
        return $this->client->get($endpoint, [
            'api_key' => $this->token,
            'page' => $page,
        ]);
    }

}