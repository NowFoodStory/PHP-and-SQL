<?php

$seller_sid = isset($_GET['seller_sid']) ? intval($_GET['seller_sid']) : 1;


// if(! isset($_SESSION['user'])){
//     echo json_encode($result,JSON_UNESCAPED_UNICODE);
//     exit;
// }
$bdata = json_decode($entityBody, true);
$result['formFood'] = $bdata;
$Time=mktime(9, 12, 31, 6, 10, 2015);
$dataTime = date("Y-m-d h:i:sa" );
echo json_encode($dataTime,JSON_UNESCAPED_UNICODE);

$sql = "INSERT INTO `orders` 
(`Numb_sid`,`order_sid`,`user_id`,`seller_sid`,`food_id`,`quantity`,`price_discount`,`orfer_time`,`pay`)
VALUES(?,?,?,?,?,?,NOW(),0)";
$stmt = $pdo ->prepare($sql);
$stmt->execute([
 $bdata['Numb_sid'],
 $bdata['order_sid'],
 $_SESSION['user']['user_id'],
 $seller_sid['seller_sid'],
 $bdata['food_id'],
 $bdata['quantity'],
 $bdata['price_discount'],
 $bdata['orfer_time']
]);
if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['resultCode'] = 255;
    $result['errorMsg'] = '新增訂單成功';
}
else {
    $result['resultCode'] = 455;
    $result['errorMsg'] = '訂單成立失敗';
}

// $seller = $stmt->fetchAll(PDO::FETCH_ASSOC);



echo json_encode($result,JSON_UNESCAPED_UNICODE);