<?php
require __DIR__.'/../__connect_db.php';

// $sql =  "SELECT seller_sid , seller_name FROM seller_initial ";
$sql =  "SELECT s.seller_sid , s.seller_name, f.food_name
        FROM seller_initial s 
        JOIN food_commodity f ON s.seller_sid=f.seller_sid
        ORDER BY s.seller_sid, f.food_sid ";



$stmt = $pdo->prepare($sql);
$stmt->execute();
$seller = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($seller, JSON_UNESCAPED_UNICODE);
exit;
foreach( $seller as $sellerID){
    $seller_sid = $sellerID['seller_sid'];
    $seller_name = $sellerID['seller_name'];
    $sql1 = " SELECT food_name FROM `food_commodity` WHERE `seller_sid`=$seller_sid";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute();
    $seller1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    $seller_sp = array($sellerID);
    $sp = (array($seller_sp,$seller1));
    // print_r($sp);
    // echo json_encode($sp, JSON_UNESCAPED_UNICODE);
};



// print_r($seller_name);
// print_r($seller_name);