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

print_r($bdata);


$result['data_from'] = $bdata;

$reuire_fields = [
    'seller_name',
    'principal',
    'seller_phone',
    'seller_EIN',
    'seller_address',
    'seller_email',
    'seller_password'
];
foreach($reuire_fields as $rf){
    if(empty($bdata[$rf])){
        $result['resultCode'] = 405;
        $result['errorMsg'] = $rf. '為必要欄位';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

////TODO: 先用 SELECT 檢查密碼是否正確

$sql = "UPDATE `seller_initial` SET 
                `seller_name`=?,
                `principal`=?,
                `seller_phone`=?,
                `seller_EIN`=?,
                `seller_address`=?,
                `seller_email`=?,
                `seller_password`=?,
                WHERE `seller_sid`=? ";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $bdata['seller_name'],
    $bdata['principal'],
    $bdata['seller_phone'],
    $bdata['seller_EIN'],
    $bdata['seller_address'],
    $bdata['seller_email'],
    $bdata['seller_password'],
    $_SESSION['seller']['seller_sid']
]);
if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['resultCode'] = 200;
    $result['errorMsg'] = '';
} else {
    $result['resultCode'] = 406;
    $result['errorMsg'] = '修改沒有成功';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);