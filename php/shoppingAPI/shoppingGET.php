<?php
require __DIR__.'/../__connect_db.php';

$s_sql =  "SELECT `seller_sid`,`seller_name`,`opening`,`close_time`,`logo_photo` FROM seller_initial ";
$s_stmt = $pdo->query($s_sql);
$seller = $s_stmt->fetchAll(PDO::FETCH_ASSOC);

$f_sql =  "SELECT * FROM `food_commodity` WHERE 1 and food_quantity > 0";
$f_stmt = $pdo->query($f_sql);
$fc = $f_stmt->fetchAll(PDO::FETCH_ASSOC);

$food = [];
foreach($fc as $f){
    $food[$f['seller_sid']][] = $f;
}

foreach($seller as $k=>$s){
    if(isset($food[$s['seller_sid']])){
        $seller[$k]['foods'] = $food[$s['seller_sid']];
    }
}
foreach ($seller as $k => $s) {
    if (! isset($seller[$k]['foods'])) {
        unset($seller[$k]);
    }
}
echo json_encode($seller, JSON_UNESCAPED_UNICODE);
