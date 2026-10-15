<?php

class Database
{
    private array $credentials;

    public function __construct()
    {
        $this->credentials = require __DIR__ . '/db-credentials.php';
    }

    public function connect(): PDO
    {
        $c = $this->credentials;
        $dsn = "mysql:host={$c['host']};dbname={$c['dbName']};charset=utf8mb4";

        return new PDO($dsn, $c['user'], $c['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
}