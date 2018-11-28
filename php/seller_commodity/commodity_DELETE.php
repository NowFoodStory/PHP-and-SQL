<?php
$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '資料不足',
];

if(! isset($from_me)){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}


$entityBody = file_get_contents('php://input');

$bdata = json_decode($entityBody, true);

$sql ="DELETE FROM `seller_initial` WHERE `food_sid = ? `";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $bdata['food_sid']
]);

if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['resultCode'] = 200;
    $result['errorMsg'] = '刪除成功';
} else {
    $result['resultCode'] = 444;
    $result['errorMsg'] = '刪除失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);