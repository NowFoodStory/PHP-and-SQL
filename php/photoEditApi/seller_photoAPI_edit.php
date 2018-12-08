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

// print_r($bdata);


$result['data_from'] = $bdata;
////TODO: 先用 SELECT 檢查密碼是否正確

$sql = "UPDATE `seller_initial` SET 
                `logo_photo`=?
                WHERE `seller_sid`=? ";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $bdata['logo_photo'],
    $_SESSION['seller']['seller_sid']
]);
if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['resultCode'] = 200;
    $result['errorMsg'] = '';
    $_SESSION['seller']['logo_photo'] = $bdata['logo_photo'];

} else {
    $result['resultCode'] = 406;
    $result['errorMsg'] = '修改沒有成功';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);