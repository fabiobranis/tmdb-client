<?php


namespace UpcomingMovies\Actions;


use Foundation\Database\Pagination\PaginatorBuilder;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use UpcomingMovies\Repositories\GenreRepository;

/**
 * This is our action class that handles the genres index route requests
 * Class GenresIndex
 * @package UpcomingMovies\Actions
 */
class GenresIndex
{

    /**
     * @var GenreRepository
     */
    private $genreRepository;

    /**
     * GenresIndex constructor.
     * @param GenreRepository $genreRepository
     */
    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    /**
     * Paginate the genres
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $paginatorBuilder = new PaginatorBuilder($request->getQueryParams());
        $paginatorBuilder->setFieldsToFilter(['name']);
        $response->getBody()->write(json_encode($this->genreRepository->paginate($paginatorBuilder)));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

}