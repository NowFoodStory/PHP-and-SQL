<?php

$seller_sid = isset($_GET['seller_sid']) ? intval($_GET['seller_sid']) : 1;


if(! isset($_SESSION['user'])){
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
    exit;
}
$bdata = json_decode($entityBody, true);
$result['formFood'] = $bdata;

$sql = "INSERT INTO `orders` 
(`Numb_sid`,`order_sid`,`user_id`,`food_id`,`quantity`,`price_discount`,`orfer_time`,`pay`)
VALUES(?,?,?,?,?,?,?,0)";
$stmt = $pdo ->prepare($sql);
$stmt->execute([
 $bdata['Numb_sid'],
 $bdata['order_sid'],
 $_SESSION['user']['user_id'],
 $bdata['food_id'],
 $bdata['quantity'],
 $bdata['price_discount'],
 $bdata['orfer_time'],
]);


// $seller = $stmt->fetchAll(PDO::FETCH_ASSOC);



echo json_encode($BuyData,JSON_UNESCAPED_UNICODE);