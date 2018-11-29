<?php
require __DIR__.'/../__connect_db.php';


$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '用戶沒有登入',
];
header('Content-Type: application/json');
$from_commodity = true;
if(! isset($_SESSION['seller'])){
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
    exit;
}
$method = $_SERVER['REQUEST_METHOD'];
$body = file_get_contents('php://input');
$body = json_decode($body, true);

switch ($method){
    case 'GET':
    require __DIR__.'/seller_data_GET.php';
    exit;
    // case 'POST':
    // require __DIR__.'/seller_data_POST.php';
    // exit;
    case 'PUT':
    require __DIR__.'/seller_data_PUT.php';
    exit;
    default:
    $result['resultCode'] = 401;
    $result['errorMsg'] = '錯誤的 HTTP method';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);