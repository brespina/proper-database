<?php

namespace App\Controller;

use App\Database\Connection;

class CollegeController {
    private $pdo;

    public function __construct(Connection $connection) {
        $this->pdo = $connection->getPdo();
    }

    public function getAvailableColumns(): array {
        $stmt = $this->pdo->query("SELECT column_name FROM information_schema.columns WHERE table_name = 'College'");
        $columns = [];
        while ($row = $stmt->fetch()) {
            $columns[] = $row['column_name'];
        }
        return $columns;
    }

    public function getData(array $columns): array {
        $columnsString = implode(", ", $columns);
        $stmt = $this->pdo->query('SELECT ' . $columnsString . ' FROM public."College"');
        $data = $stmt->fetchAll();

        if (!empty($data)) {
            array_unshift($data, array_keys($data[0]));
        }

        return $data;
    }
}