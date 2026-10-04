<?php

class Database
{
    private string $host = 'localhost';
    private string $dbName = 'taskflow';
    private string $user = 'root';
    private string $password = '';

    public function connect(): PDO
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8mb4";

        $pdo = new PDO($dsn, $this->user, $this->password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        return $pdo;
    }
}