<?php

if(! isset($from_commodity)){
    $result['error'] = '請從commodity.php 訪問';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "SELECT * FROM `food_commodity` WHERE `seller_sid`";


$stmt = $pdo->query($sql);

print_r($stmt);