<?php


namespace Foundation\Console;


use DI\Container;
use Dotenv\Dotenv;
use Exception;
use Foundation\ContainerFactory;
use Foundation\Database\BootDatabase;
use Psr\Container\ContainerInterface;
use Silly\Edition\PhpDi\Application;

/**
 * This is the bootstrap class for the console application
 * Class Console
 * @package Foundation\Console
 */
class Console extends Application
{

    /**
     * @return Container|ContainerInterface
     * @throws Exception
     */
    protected function createContainer(): ContainerInterface
    {
        $dotEnv = Dotenv::create(__DIR__ . '/../../');
        $dotEnv->load();
        BootDatabase::make([
            'driver' => env('DB_CONNECTION'),
            'database' => __DIR__ . '/../../' .env('DB_DATABASE'),
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS')
        ]);
        return ContainerFactory::make();
    }

    /**
     * Register the commands from commands file
     * @param array $commands
     */
    public function registerCommands(array $commands): void
    {
        foreach ($commands as $name => $class) {
            $this->command($name, $class);
        }
    }
}