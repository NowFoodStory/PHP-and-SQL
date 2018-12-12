<?php
require __DIR__ . '/../__connect_db.php';


$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '用戶沒有登入',
];


if (!isset($_SESSION['seller'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$entityBody = file_get_contents('php://input');
$bdata = json_decode($entityBody, true);
$result['food'] = $bdata;

$sql = "UPDATE `order_data` SET `status`=2 WHERE Numb_sid =?";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $bdata['Numb_sid']
]);
if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['resultCode'] = 200;
    $result['errorMsg'] = '修改成功';
} else {
    $result['resultCode'] = 408;
    $result['errorMsg'] = '修改失敗';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);