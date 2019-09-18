<?php


namespace UpcomingMovies\Actions;


use Foundation\Database\Pagination\PaginatorBuilder;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

/**
 * Our movies index actions
 * Class MoviesIndex
 * @package UpcomingMovies\Actions
 */
class MoviesIndex extends MoviesActions
{

    /**
     * Return a pagination of our movies
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $paginatorBuilder = new PaginatorBuilder($request->getQueryParams());
        $paginatorBuilder->setFieldsToFilter(['name']);
        $response->getBody()->write(json_encode($this->repository->paginate($paginatorBuilder)));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}