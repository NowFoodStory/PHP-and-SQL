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
    'seller_opening',
    'seller_fb',
    'seller_ig',
    'seller_web',
    'seller_introduce',
    'seller_cover_photo',
    'logo_photo'
];
foreach($reuire_fields as $rf){
    if(empty($bdata[$rf])){
        $result['resultCode'] = 405;
        $result['errorMsg'] = $rf. '為必要欄位';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
}



$sql = "INSERT INTO `seller_data` ( `seller_sid`,`seller_opening`, `seller_fb`, 
`seller_ig`, `seller_web`, `seller_introduce`, `seller_cover_photo`, `logo_photo`)
 VALUES (?,?,?,?,?,?,?,?)";


$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_SESSION['seller']['seller_sid'],
    $bdata['food_name'],
    $bdata['food_class'],
    $bdata['food_quantity'],
    $bdata['food_price'],
    $bdata['food_discount'],
    $bdata['food_photo']

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