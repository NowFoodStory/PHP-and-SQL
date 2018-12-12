<?php
require __DIR__.'/../__connect_db.php';


$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '用戶沒有登入',
];
if(! isset($_SESSION['user'])){
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
    exit;
}
$method = $_SERVER['REQUEST_METHOD'];
$body = file_get_contents('php://input');
$body = json_decode($body, true);

switch($method){
    case 'GET':
    require __DIR__.'/';
    exit;
    case'PUT':
    require __DIR__.'/USER_PUT.php';
    exit;
    default:
    $result['resultCode'] = 401;
    $result['errorMsg'] = '錯誤的HTTP訪問';
}