<?php

use Foundation\HttpClient\ClientRequest;
use Psr\Container\ContainerInterface;
use Slim\Views\PhpRenderer;
use UpcomingMovies\Repositories\GenreRepository;
use UpcomingMovies\Repositories\MovieRepository;
use UpcomingMovies\Services\DatabaseSeeders\SeedGenres;
use UpcomingMovies\Services\DatabaseSeeders\SeedUpcomingMovies;
use UpcomingMovies\Services\HttpActionsClients\GetAllMoviesGenres;
use UpcomingMovies\Services\HttpActionsClients\GetAllUpcomingMoviesPages;
use UpcomingMovies\Services\TMDB\RestClient;

/**
 * Here we will register all class that must be resolved by the IoC container
 */
return [

    PhpRenderer::class => function () {
        return new PhpRenderer(__DIR__ . '/../public/');
    },
    PDO::class => function () {
        $pdo = new PDO('sqlite:' . __DIR__ . '/../db.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    },
    RestClient::class => function () {
        $clientRequest = new ClientRequest(getenv('TMDB_URL'));
        return new RestClient($clientRequest, getenv('TMDB_TOKEN'));
    },
    GenreRepository::class => function () {
        return new GenreRepository();
    },
    MovieRepository::class => function () {
        return new MovieRepository();
    },
    GetAllMoviesGenres::class => function (ContainerInterface $container) {
        return new GetAllMoviesGenres($container->get(RestClient::class));
    },
    GetAllUpcomingMoviesPages::class => function (ContainerInterface $container) {
        return new GetAllUpcomingMoviesPages($container->get(RestClient::class));
    },
    SeedGenres::class => function (ContainerInterface $container) {
        return new SeedGenres($container->get(GenreRepository::class), $container->get(GetAllMoviesGenres::class));
    },
    SeedUpcomingMovies::class => function (ContainerInterface $container) {
        return new SeedUpcomingMovies($container->get(MovieRepository::class),
            $container->get(GenreRepository::class),
            $container->get(GetAllUpcomingMoviesPages::class)
        );
    }
];
