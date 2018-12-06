<?php
$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '用戶沒有登入',
];
if(! isset($_SESSION['seller'])){
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
    exit;
}

$entityBody = file_get_contents('php://input');

$bdata = json_decode($entityBody, true);

$buy = "UPDATE `food_commodity` 

SET `food_quantity`=`food_quantity`$SP WHERE `food_sid`=?";

$stmt = $pdo->prepare($buy);

$stmt->execute([
    $bdata['food_quantity']
]);
if($stmt->rowCount()==1)
    {
    $result['success'] = true;
    $result['resultCode'] = 200;
    $result['errorMsg'] = '';
} else {
    $result['resultCode'] = 406;
    $result['errorMsg'] = '修改沒有成功';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);
