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
$result['formFood'] = $bdata;


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



// $sql = "INSERT INTO `food_commodity` ( `seller_sid`, `food_name`, 
// `food_class`, `food_quantity`, `food_price`, `food_discount`, `food_photo`)
//  VALUES (?,?,?,?,?,?,?)";
$sql = "UPDATE `food_commodity` SET 
                `seller_sid`=?,
                `food_name`=?,
                `food_class`=?,
                `food_quantity`=?,
                `food_price`=?,
                `food_discount`=?,
                `food_photo`=?
                WHERE `food_sid`=? ";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_SESSION['seller']['seller_sid'],
    $bdata['food_name'],
    $bdata['food_class'],
    $bdata['food_quantity'],
    $bdata['food_price'],
    $bdata['food_discount'],
    $bdata['food_photo'],
    $bdata['food_sid']

]);
if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['resultCode'] = 200;
    $result['errorMsg'] = '';
} else {
    $result['resultCode'] = 406;
    $result['errorMsg'] = '上傳沒有成功';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);