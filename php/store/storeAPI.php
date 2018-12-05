<?php
require __DIR__.'/../__connect_db.php';


header('Content-Type: application/json');
$from_commodity = true;

$method = $_SERVER['REQUEST_METHOD'];
$body = file_get_contents('php://input');
$body = json_decode($body, true);

switch ($method){
    case 'GET':
    require __DIR__.'/store_GTE.php';
    exit;
    case 'POST':
    require __DIR__.'/store_Buy.php';
    exit;
    default:
    $result['resultCode'] = 401;
    $result['errorMsg'] = '錯誤的 HTTP method';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);