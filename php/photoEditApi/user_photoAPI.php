<?php
require __DIR__.'/../__connect_db.php';

$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '用戶沒有登入',
];

$from_me = true;

if(! isset($_SESSION['user'])){
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
    exit;
}

switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
    require __DIR__. '/user_photo_read.php';
    exit;
    case 'PUT':
    require __DIR__.'/user_photo_edit.php';
    exit;
    default:
    $result['resultCode'] = 401;
    $result['errorMsg'] = '錯誤的HTTP method';
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);