<?php

use Foundation\Console\Console;

require __DIR__ . '/vendor/autoload.php';

$app = new Console();
$app->registerCommands(require __DIR__ . '/config/commands.php');

try {
    $app->run();
} catch (Exception $e) {
    die($e);
}