<?php

use Dotenv\Dotenv;
use Foundation\App;
use Foundation\ContainerFactory;
use Foundation\Database\BootDatabase;


require __DIR__ . '/../vendor/autoload.php';

$dotEnv = Dotenv::create(__DIR__ . '/../');
$dotEnv->load();

try {
    BootDatabase::make([
        'driver' => env('DB_CONNECTION'),
        'database' => __DIR__ . '/../' .env('DB_DATABASE'),
        'foreign_key_constraints' => env('DB_FOREIGN_KEYS')
    ]);
    $app = App::make(ContainerFactory::make());
    $routes = require __DIR__ . '/../config/routes.php';
    $routes($app);
    $app->run();
} catch (Exception $e) {
    die($e);
}



