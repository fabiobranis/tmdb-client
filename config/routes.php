<?php


use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use UpcomingMovies\Actions\GenresIndex;
use UpcomingMovies\Actions\GetMovieById;
use UpcomingMovies\Actions\HomeAction;
use UpcomingMovies\Actions\MoviesIndex;

/**
 * Here we will register the routes
 * @param App $app
 */
return function (App $app) {
    $app->get('/', HomeAction::class);
    $app->group('/api/v1', function (RouteCollectorProxy $group) {
        $group->get('/genres', GenresIndex::class);
        $group->get('/movies', MoviesIndex::class);
        $group->get('/movies/{id}', GetMovieById::class);
    });

};

