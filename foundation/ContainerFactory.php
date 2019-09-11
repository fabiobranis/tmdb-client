<?php


namespace Foundation;


use DI\ContainerBuilder;
use Exception;
use Psr\Container\ContainerInterface;

/**
 * This is a factory class to build the container
 * Class ContainerFactory
 * @package Foundation
 */
class ContainerFactory
{

    /**
     * @var ContainerInterface
     */
    private static $container;

    /**,
     * ContainerFactory constructor.
     */
    private function __construct()
    {
    }

    /**
     * It's just a demonstration on how to work with a singleton.
     * In this case, it's in the make method.
     * We have a private constructor, so we have to return the static container when requested the make method
     * @return ContainerInterface
     * @throws Exception
     */
    public static function make(): ContainerInterface
    {
        if (self::$container) {
            return self::$container;
        }

        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions(require __DIR__ . '/../config/dependencies.php');
        try {
            self::$container = $containerBuilder->build();
            return self::$container;
        } catch (Exception $e) {
            throw $e;
        }
    }
}