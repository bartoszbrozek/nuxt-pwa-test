<?php

header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
header('Access-Control-Max-Age: 86400');
header('Content-Type: application/json; charset=utf-8');

function getItems()
{
    $products = [
        [
            'id' => 1,
            'name' => 'GTX 3080',
            'price' => 4010.99,
        ],

        [
            'id' => 2,
            'name' => 'GTX 2080',
            'price' => 2899.59,
        ],

        [
            'id' => 3,
            'name' => 'Radeon 5300',
            'price' => 899.99,
        ],

        [
            'id' => 4,
            'name' => 'Radeon 5700XT',
            'price' => 1699.99,
        ],
    ];

    echo json_encode($products);
    die;
}

function purchase()
{
    $request =
        [
            'ip' => getIp(),
            'request' => $_REQUEST,
            'json' => file_get_contents('php://input'),
        ];

    file_put_contents(__DIR__ . '/buy-logs.log', date('Y-m-d H:i:s') . ' -> ' . json_encode($request) . PHP_EOL . PHP_EOL, FILE_APPEND);
}

function getIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

switch ($_GET['action'] ?? '') {
    case 'getItems':
        getItems();
        break;

    case 'purchase':
        purchase();
        break;
}

die;
