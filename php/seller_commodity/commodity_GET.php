<?php

if(! isset($from_commodity)){
    $result['error'] = '請從commodity.php 訪問';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$result = [
    'success' => true,
    'resultCode' => 200,
    'errorMsg' => '',
    'data' => $_SESSION['seller']['seller_sid'],
];

print_r($result);

$sql = "SELECT * FROM `food_commodity` WHERE `seller_sid`";


$stmt = $pdo->query($sql);

print_r($stmt);

