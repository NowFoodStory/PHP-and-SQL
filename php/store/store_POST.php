<?php
$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '資料不足',
];

$seller_sid = isset($_GET['seller_sid']) ? intval($_GET['seller_sid']) : 1;
$entityBody = file_get_contents('php://input');

$bdata = json_decode($entityBody, true);
$result['Buy'] = $bdata;
$Numb= date("djis");
$data = (string)$Numb;
$Numb_sid = $data.$seller_sid.$_SESSION['user']['user_id'];


echo $Numb_sid ; 

$sql = "INSERT INTO `orders` ( `Numb_sid`,`seller_sid`,`user_id`, 
`food_sid`, `quantity`, `price_discount`, `order_time`, `status`)
 VALUES (?,?,?,?,?,?,NOW(),'1')";


$stmt = $pdo->prepare($sql);

$stmt->execute([
    $Numb_sid,
    $seller_sid,
    $_SESSION['user']['user_id'],
    $bdata['food_sid'],
    $bdata['quantity'],
    $bdata['price_discount']
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