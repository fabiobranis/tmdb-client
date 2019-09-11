<?php
declare(strict_types=1);

namespace UpcomingMovies\Commands\Migrations;


use Exception;
use Foundation\File\ReadsFiles;
use InvalidArgumentException;
use PDO;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * This is a simple example of migrations.
 * I preferred to demonstrate the process, because I don't want to use boilerplate from frameworks
 * and I don't have enough time to create a SchemaBuilder.
 * Class Migrate
 * @package UpcomingMovies\Commands\Migrations
 */
class Migrate
{

    use ReadsFiles;

    /**
     * @var PDO
     */
    private $pdo;

    /**
     * Migrate constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Execute the action
     * @param OutputInterface $output
     * @param string|null $option
     */
    public function __invoke(OutputInterface $output, string $option = null)
    {
        if (!$option) {
            $output->writeln('Creating database structure..');
            $this->up();
            $output->writeln('Tables created!');
        } elseif ($option === 'reset') {
            $output->writeln('Resetting database structure');
            $this->down();
            $output->writeln('Tables deleted!');
        }else {
            throw new InvalidArgumentException();
        }
    }

    /**
     * Create database structure
     */
    private function up(): void
    {
        $filename = __DIR__ . '/tables/database_up.sql';
        $this->execStatement($filename);
    }

    /**
     * Drop all tables
     */
    private function down(): void
    {
        $filename = __DIR__ . '/tables/database_down.sql';
        $this->execStatement($filename);
    }

    /**
     * Execute the statements
     * @param $filename
     */
    private function execStatement($filename): void
    {
        try {
            $content = $this->giveTheFullContent($filename);
        } catch (Exception $e) {
            die($e);
        }
        $this->pdo->exec($content);
    }

}