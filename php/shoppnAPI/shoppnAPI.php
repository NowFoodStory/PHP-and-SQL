<?php
require __DIR__.'/../__connect_db.php';

$sql =  "SELECT `seller_sid`,`seller_name` FROM `seller_initial` ";
$stmt = $pdo->prepare($sql);
$stmt->execute();
// $result =[
//     'sqlResponse' => $stmt->fetchAll(PDO::FETCH_ASSOC),
// ];
$sql1 =  "SELECT * FROM `food_commodity` ";
$stmt1 = $pdo->prepare($sql1);
$stmt1->execute();
$stmt->fetchAll(PDO::FETCH_ASSOC);

$result =[
    'Seller_Response' => $stmt->fetchAll(PDO::FETCH_ASSOC),

];
$result1=[
    'food' => $stmt1->fetchAll(PDO::FETCH_ASSOC),
];
// $forEach = foreach($stmt as );

echo json_encode($result, JSON_UNESCAPED_UNICODE);