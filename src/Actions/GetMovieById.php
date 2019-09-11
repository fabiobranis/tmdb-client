<?php


namespace UpcomingMovies\Actions;


use Slim\Psr7\Request;
use Slim\Psr7\Response;

/**
 * This is our action class that handles the genre show route requests
 * Class GetMovieById
 * @package UpcomingMovies\Actions
 */
class GetMovieById extends MoviesActions
{

    /**
     * Get a genre
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function __invoke(Request $request, Response $response)
    {
        $response->getBody()->write(json_encode($this->repository->find($request->getAttribute('id'), true)));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}