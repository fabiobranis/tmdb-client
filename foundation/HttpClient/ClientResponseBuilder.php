<?php


namespace Foundation\HttpClient;

/**
 * It's just a simple builder to be an example of how I think it's nice to implement the pattern.
 * It's a very simple implementation
 * Class ClientResponseBuilder
 * @package Foundation\HttpClient
 */
class ClientResponseBuilder
{
    /**
     * Build our DTO
     * @param string $response
     * @param int $status
     * @return ClientResponse
     */
   public static function buildClientResponse(string $response, int $status): ClientResponse
   {
       return new ClientResponse(json_decode($response), $status);
   }
}