<?php
require __DIR__.'/../__connect_db.php';

$s_sql =  "SELECT seller_sid , seller_name FROM seller_initial ";
$s_stmt = $pdo->query($s_sql);
$seller = $s_stmt->fetchAll(PDO::FETCH_ASSOC);

$f_sql =  "SELECT * FROM `food_commodity` WHERE 1";
$f_stmt = $pdo->query($f_sql);
$fc = $f_stmt->fetchAll(PDO::FETCH_ASSOC);

$food = [];
foreach($fc as $f){
    $food[$f['seller_sid']][] = $f;
}

foreach($seller as $k=>$s){
    $seller[$k]['foods'] = $food[$s['seller_sid']];
}


echo json_encode($seller, JSON_UNESCAPED_UNICODE);
