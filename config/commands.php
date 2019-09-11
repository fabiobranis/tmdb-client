<?php

use UpcomingMovies\Commands\Integration\FetchDataFromTMDB;
use UpcomingMovies\Commands\Migrations\Migrate;

/**
 * Here we will register all cli commands
 */

return [
    'migrate [option]' => Migrate::class,
    'fetch' => FetchDataFromTMDB::class,
];