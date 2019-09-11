<?php
declare(strict_types=1);

namespace Foundation\HttpClient;


use Foundation\HttpClient\Traits\UrlBuilder;

/**
 * A simple decorator for CURL requests
 * Class ClientRequest
 * @package Foundation\HttpClient
 */
final class ClientRequest
{

    use UrlBuilder;

    /**
     * @var string
     */
    private $url;

    /**
     * @var array
     */
    private $headers;

    /**
     * ClientRequest constructor.
     * @param string $url
     * @param array $headers
     */
    public function __construct(string $url, array $headers = [])
    {
        $this->url = $url;
        $this->headers = $headers;
    }

    /**
     * Make the get request
     * @param string $endpoint
     * @param array $query
     * @return ClientResponse
     */
    public function get(string $endpoint = '', array $query = []): ClientResponse
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->buildWithQueryString($this->url, $endpoint, $query));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = ClientResponseBuilder::buildClientResponse(curl_exec($ch), curl_getinfo($ch, CURLINFO_HTTP_CODE));
        curl_close($ch);
        return $response;
    }
}