<?php


namespace Foundation\Database;


use Illuminate\Database\Capsule\Manager;

/**
 * A class to boot the eloquent models with configurations
 * Class BootDatabase
 * @package Foundation\Database
 */
class BootDatabase
{

    /**
     * Boot the Eloquent with the .env parameters
     * @param array $configuration
     */
    public static function make(array $configuration): void
    {
        $capsule = new Manager();
        $capsule->addConnection($configuration);
        $capsule->bootEloquent();
    }

}