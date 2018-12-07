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


//echo $Numb_sid ; 

$sql = "UPDATE `food_commodity` SET `food_quantity`=? WHERE `food_sid`=? and `seller_sid`=?";


$stmt = $pdo->prepare($sql);

foreach($bdata as $p){
    $stmt->execute([
        $p['food_quantity'],
        $p['food_sid'],
        $seller_sid,
    ]);


}if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['resultCode'] = 200;
    $result['errorMsg'] = '減少庫存成功';
}else {
    $result['resultCode'] = 406;
    $result['errorMsg'] = '減少庫存失敗';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);