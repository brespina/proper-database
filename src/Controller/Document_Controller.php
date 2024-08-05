<?php

namespace App\Controller;

use App\Database\Connection;

class documentController {
    private $pdo;

    public function __construct(Connection $connection) {
        $this->pdo = $connection->getPdo();
    }

    public function getAvailableColumns(string $tableName): array {
        // sanatizing table name. 
        $tableName = preg_replace('/[^a-zA-Z0-9_]/', '', $tableName);

        // fetch columns from the information schema
        $stmt = $this->pdo->prepare("
            SELECT column_name
            FROM information_schema.columns
            WHERE table_name = :table_name
        ");
        $stmt->execute(['table_name' => $tableName]);

        $columns = [];
        while ($row = $stmt->fetch()) {
            $columns[] = $row['column_name'];
        }

        return $columns;
    }

    public function getData(string $tableName, array $columns): array {
        // sanitize table and handle spec char and spaces for postgres
        $tableName = preg_replace('/[^a-zA-Z0-9_]/', '', $tableName);

        $quotedColumns = array_map(function($column) {
            return '"' . str_replace('"', '""', $column) . '"'; // escape quotes inside column names
        }, $columns);
    

        $columnsString = implode(", ", $quotedColumns);
        $sql = "SELECT $columnsString FROM public.\"$tableName\"";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
    
        if (!empty($data)) {
            array_unshift($data, array_keys($data[0]));
        }
    
        return $data;
    }
}