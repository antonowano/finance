<?php

if ($_SERVER['ENV'] == 'development') {
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
}

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller;
use App\Exception\AppException;

$controller = new Controller();

try {
    $response = [
        'status' => 'success',
        'data' => match ($_GET['method'] ?? null) {
            'amount_by_day' => $controller->getAmountByDay(),
            'transactions_per_day' => $controller->getTransactionsPerDay(),
            'add_transaction' => $controller->addTransaction(),
            'delete_transaction' => $controller->deleteTransaction(),
            'all_categories' => $controller->getAllCategories(),
            'add_category' => $controller->addCategory(),
            'delete_category' => $controller->deleteCategory(),
            default => throw new AppException('Метод не указан')
        },
    ];
} catch (AppException $e) {
    $response = [
        'status' => 'error',
        'message' => $e->getMessage(),
    ];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
