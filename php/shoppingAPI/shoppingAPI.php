<?php
require __DIR__.'/../__connect_db.php';


$from_shopping = true;
$body = file_get_contents('php://input');
$body = json_decode($body, true);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method){
    case 'GET':
    require __DIR__.'/shoppingGET.php';
    exit;
    case 'POST':
    require __DIR__.'/shoppingPOST.php';
    exit;
    default:
    $result['resultCode'] = 401;
    $result['errorMsg'] = '錯誤的 HTTP method';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);