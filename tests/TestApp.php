<?php


namespace Tests;


use Dotenv\Dotenv;
use Foundation\Database\BootDatabase;
use PHPUnit\Framework\TestCase;

class TestApp extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $dotEnv = Dotenv::create(__DIR__ . '/../');
        $dotEnv->load();
        BootDatabase::make([
            'driver' => env('DB_CONNECTION'),
            'database' => __DIR__ . '/fixtures/test.sqlite' ,
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS')
        ]);
    }
}