<?php

if(! isset($from_commodity)){
    $result['error'] = '請從 commodity_API.php 訪問';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$entityBody = file_get_contents('php://input');
$bdata = json_decode($entityBody, true);

$reuire_fields = [
    'food_name',
    'food_class',
    'food_quantity',
    'food_price',
    'food_discount',
    'food_photo'

];
foreach($reuire_fields as $rf){
    if(empty($bdata[$rf])){
        $result['resultCode'] = 405;
        $result['errorMsg'] = $rf. '為必要欄位';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

$sql = "INSERT INTO `food_shop_list` SET
    `food_name`=?,
    `food_class`=?,
    `food_quantity`=?,
    `food_price`=?,
    `food_discount`=?,
    `food_photo`=?
    WHERE `seller_sid`=?";
$stmt = $pdo->prepare($sql);

$stmt->execute([
    $bdata['food_name'],
    $bdata['food_class'],
    $bdata['food_price'],
    $bdata['food_discount'],
    $bdata['food_photo'],
    $_SESSION['seller']['seller_sid']
]);
if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['resultCode'] = 200;
    $result['errorMsg'] = '上架成功';
} else {
    $result['resultCode'] = 406;
    $result['errorMsg'] = '上架失敗';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);