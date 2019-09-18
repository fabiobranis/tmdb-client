<?php


namespace Tests\App\Repositories;


use PDO;
use PDOException;
use Symfony\Component\Console\Output\ConsoleOutput;
use Tests\TestApp;
use UpcomingMovies\Commands\Migrations\Migrate;

/**
 * Class RepositoryTest
 * @package Tests\App\Repositories
 */
abstract class RepositoryTest extends TestApp
{
    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var Migrate
     */
    protected $migrate;

    /**
     * Create our PDO instance
     */
    protected function setUp(): void
    {
        try {
            $this->pdo = new PDO('sqlite:' . __DIR__ . '/../../fixtures/test.sqlite');
            $this->migrate = new Migrate($this->pdo);

            // just in case - tear down the database (the scripts must have drop table if exists)
            call_user_func($this->migrate, new ConsoleOutput(), 'reset');

            // creates the structure
            call_user_func($this->migrate, new ConsoleOutput());
        } catch (PDOException $exception) {
            die($exception);
        }

        parent::setUp();
    }

    protected function tearDown(): void
    {
        call_user_func($this->migrate, new ConsoleOutput(), 'reset');
        parent::tearDown(); // TODO: Change the autogenerated stub
    }
}