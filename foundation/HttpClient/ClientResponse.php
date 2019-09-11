<?php


namespace Foundation\HttpClient;


use stdClass;

/**
 * Works like a DTO to hold the response data
 * Class ClientResponse
 * @package Foundation\HttpClient
 */
class ClientResponse
{

    /**
     * @var stdClass
     */
    private $body;

    /**
     * @var int
     */
    private $status;

    /**
     * ClientResponse constructor.
     * @param stdClass $body
     * @param int $status
     */
    public function __construct(stdClass $body, int $status )
    {
        $this->body = $body;
        $this->status = $status;
    }

    /**
     * @return stdClass
     */
    public function getBody(): stdClass
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->body);
    }
}