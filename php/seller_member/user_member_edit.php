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
    'user_name',
    'user_phone',
    'user_email',
    'user_password'
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

$sql = "UPDATE `user_data` SET 
                `user_name`=?,
                `user_phone`=?,
                `user_email`=?,
                `user_password`=?
                WHERE `user_id`=? ";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $bdata['user_name'],
    $bdata['user_phone'],
    $bdata['user_email'],
    $bdata['user_password'],
    $_SESSION['user']['user_id']
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