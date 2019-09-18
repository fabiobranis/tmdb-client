<?php


namespace Foundation\HttpClient\Traits;

/**
 * Just a simple trait to demonstrate how it's nice to inject behaviours or functionality without coupling your
 * classes with some implementations
 * Trait UrlBuilder
 * @package Foundation\HttpClient\Traits
 */
trait UrlBuilder
{

    /**
     * @param string $url
     * @param string $endpoint
     * @param array $parameters
     * @return string
     */
    protected function buildWithQueryString(string $url, string $endpoint = '', array $parameters = []): string
    {

        if ($endpoint && $parameters) {
            return join([
                $url,
                '/',
                $endpoint,
                '?',
                http_build_query($parameters)
            ]);
        }

        if ($endpoint) {
            return join([
                $url,
                '/',
                $endpoint,
            ]);
        }

        if ($parameters) {
            return join([
                $url,
                '?',
                http_build_query($parameters)
            ]);
        }

        return $url;
    }
}