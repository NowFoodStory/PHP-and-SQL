<?php
require __DIR__.'/../__connect_db.php';

$sql =  "SELECT seller_sid , seller_name , logo_photo FROM seller_initial ";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$seller = $stmt->fetchAll(PDO::FETCH_ASSOC);
json_encode($seller, JSON_UNESCAPED_UNICODE);
foreach( $seller as $sellerID){
    $seller_sid = $sellerID['seller_sid'];
    $seller_name = $sellerID['seller_name'];
    $seller_photo = $sellerID['logo_photo'];
    $sql1 = " SELECT * FROM `food_commodity` WHERE `seller_sid`=$seller_sid";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute();
    $seller1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    $sp = (array_merge($seller,$seller1));
    echo json_encode($sp, JSON_UNESCAPED_UNICODE);

};



// print_r($seller_name);
// print_r($seller_name);