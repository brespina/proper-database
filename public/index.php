<?php
require __DIR__ . '/../src/Autoloader.php';

use App\Database\Connection;
use App\Controller\CollegeController;

$config = require __DIR__ . '/../config/database.php';
$connection = new Connection($config);
$controller = new CollegeController($connection);


$availableColumns = $controller->getAvailableColumns();
$selectedColumns = $_POST['columns'] ?? $availableColumns;

$selectedColumns = array_reverse($selectedColumns);
$availableColumns = array_reverse($availableColumns);

$data = $controller->getData(($selectedColumns));

require __DIR__ . '/../templates/college_statistics.php';