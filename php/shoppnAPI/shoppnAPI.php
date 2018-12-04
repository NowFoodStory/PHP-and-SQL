<?php
require __DIR__.'/../__connect_db.php';

$sql =  "SELECT seller_sid , seller_name FROM seller_initial ";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$seller = $stmt->fetchAll(PDO::FETCH_ASSOC);
json_encode($seller, JSON_UNESCAPED_UNICODE);
foreach( $seller as $sellerID){
    $seller_sid = $sellerID['seller_sid'];
    $seller_name = $sellerID['seller_name'];
    $sql1 = " SELECT * FROM `food_commodity` WHERE `seller_sid`=$seller_sid";
    json_encode($Data, JSON_UNESCAPED_UNICODE);
    // var_export($Data);
    $Datas = array_push($Data,$seller_sid,$seller_sid);
    // var_export($Datas);
    $suckmydick=array_push($Data,$seller_sid,$seller_sid);
    var_export($Datas);
    // echo json_encode($Data1, JSON_UNESCAPED_UNICODE);
    // echo json_encode($Datas, JSON_UNESCAPED_UNICODE);
};


// print_r($seller_name);
// print_r($seller_name);