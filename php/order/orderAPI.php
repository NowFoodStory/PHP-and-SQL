<?php
require __DIR__.'/../__connect_db.php';


header('Content-Type: application/json');
$from_orders = true;

$method = $_SERVER['REQUEST_METHOD'];
$body = file_get_contents('php://input');
$body = json_decode($body, true);

$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '用戶沒有登入',
];

if(! isset($_SESSION['seller'])){
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}elseif(! isset($_SESSION['user'])){
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}else{
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
switch ($method){
    case 'GET':
    require __DIR__.'/orderGET.php';
    exit;
    default:
    $result['resultCode'] = 401;
    $result['errorMsg'] = '錯誤的 HTTP method';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);