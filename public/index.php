<?php
require __DIR__ . '/../src/Autoloader.php';

use App\Database\Connection;
use App\Controller\documentController;

$config = require __DIR__ . '/../config/database.php';
$connection = new Connection($config);
$controller = new documentController($connection);

// configure which page to load. default is college stats
$page = $_GET['page'] ?? 'documents';

$pageTables = [
    'college_statistics' => 'College',
    'food_sales' => 'FoodSales',
    'football_players' => 'FootballPlayers',
    'office_supplies' => 'OfficeSupplies',
    'insurance_policies' => 'InsurancePolicies'
];

// get table name for current page
$tableName = $pageTables[$page] ?? $pageTables['college_statistics'];

// get available columns and data
$availableColumns = $controller->getAvailableColumns($tableName);
$selectedColumns = $_POST['columns'] ?? $availableColumns;

$selectedColumns = array_reverse($selectedColumns);
$availableColumns = array_reverse($availableColumns);

$data = $controller->getData($tableName, $selectedColumns);

// include the page template
$templatePath = __DIR__ . '/../templates/' . $page . '.php';
if (file_exists($templatePath)) {
    require $templatePath;
} else {
    echo "Page not found.";
}