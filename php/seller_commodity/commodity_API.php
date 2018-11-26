<?php
require __DIR__.'/../__connect_db.php';

$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '用戶沒有登入',
];

$from_commodity = true;

if(! isset($_SESSION['seller'])){
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
    exit;
}
switch($_SERVER[REQUEST_METHOD]){
    case 'GET':
    require __DIR__.'/commodity_GET.php';
    exit;
    // case 'POST':
    // require __DIR__.'/commodity_POST.php';
    // exit;
    // case 'PUT':
    // require __DIR__.'/commodity_PUT.php';
    // exit;
    // case 'DELETE':
    // require __DIR__.'/commodity_DELETE.php';
    $result['resultCode'] = 401;
    $result['errorMsg'] = '錯誤的 HTTP method';
}