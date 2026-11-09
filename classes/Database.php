<?php

class Database
{
    private mysqli $connection;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/database.php';

        $this->connection = new mysqli(
            $config['host'],
            $config['username'],
            $config['password'],
            $config['database']
        );

        $this->connection->set_charset($config['charset']);
    }

    public function getConnection(): mysqli
    {
        return $this->connection;
    }
}