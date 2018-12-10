<?php
require __DIR__.'/../__connect_db.php';

$method = $_SERVER['REQUEST_METHOD'];
$body = file_get_contents('php://input');
$body = json_decode($body, true);

switch ($method){
    case 'GET':
    require __DIR__.'/blogGET.php';
    exit;
    case 'POST':
    require __DIR__.'/blogPOST.php';
    exit;
    case 'PUT':
    require __DIR__.'/blogPUT.php';
    exit;
    case 'DELETE':
    require __DIR__.'/blogDELETE.php';
    exit;
    default:
    $result['resultCode'] = 401;
    $result['errorMsg'] = '錯誤的 HTTP method';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);