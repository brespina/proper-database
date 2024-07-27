<?php

namespace App\Database;

use PDO;
use PDOException;

class Connection {
    private $pdo;

    public function __construct(array $config) {
        $dsn = "pgsql:host={$config['host']};port={$config['port']};dbname={$config['db']}";
        try {
            $this->pdo = new PDO($dsn, $config['user'], $config['pass'], [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,

            ]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(),(int)$e->getCode());
        }
    }

    public function getPdo(): PDO {
        return $this->pdo;
    }
}