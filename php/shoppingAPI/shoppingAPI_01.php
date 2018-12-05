<?php
require __DIR__.'/../__connect_db.php';

$s_sql =  "SELECT seller_sid , seller_name FROM seller_initial ";
$s_stmt = $pdo->query($s_sql);
$seller = $s_stmt->fetchAll(PDO::FETCH_ASSOC);

$f_sql =  "SELECT * FROM `food_commodity` WHERE 1";
$f_stmt = $pdo->query($f_sql);
$fc = $f_stmt->fetchAll(PDO::FETCH_ASSOC);

$result = [
    'seller' => $seller,
    'fc' => $fc,
];

echo json_encode($result, JSON_UNESCAPED_UNICODE);
