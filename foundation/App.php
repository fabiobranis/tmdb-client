<?php


namespace Foundation;


use Slim\App as Application;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;

/**
 * This is our main application.
 * Class App
 * @package Foundation
 */
class App extends AppFactory
{
    /**
     * Boot the IoC container
     * @param ContainerInterface $container
     * @return Application
     */
    public static function make(ContainerInterface $container): Application
    {
        parent::setContainer($container);
        return parent::create();
    }
}