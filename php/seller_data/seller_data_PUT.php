<?php
$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '資料不足',
];

if(! isset($from_commodity)){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}


$entityBody = file_get_contents('php://input');

$bdata = json_decode($entityBody, true);
$result['editFormSeller'] = $bdata;


$sql = "UPDATE `seller_initial` SET `opening`=?, 
`close_time`=?, `FB`=?, `IG`=?, `Web`=?, 
`Introduction`=?, `eggsAreReady`=? 
WHERE `seller_sid`=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $bdata['opening'],
    $bdata['close_time'],
    $bdata['FB'],
    $bdata['IG'],
    $bdata['Web'],
    $bdata['Introduction'],
    $bdata['eggsAreReady'],
    $_SESSION['seller']['seller_sid']
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