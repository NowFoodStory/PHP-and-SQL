<?php
require __DIR__.'/../__connect_db.php';
$from_shopping = true;

$condition = file_get_contents('php://input');
$bdata = json_decode($condition, true);
// $ar = ['麵包', '壽司'];
$ar = [];
foreach($bdata as $k=>$v){
    $ar[$k] = $pdo->quote($v);
}

$f_sql =  sprintf("SELECT * FROM food_commodity WHERE food_class=%s and food_quantity > 0",
    implode(' OR food_class=', $ar)
);

$f_stmt = $pdo->query($f_sql);
$foods = $f_stmt->fetchAll(PDO::FETCH_ASSOC);
$s_sql =  "SELECT seller_sid,`seller_name`,`opening`,`close_time`,`logo_photo` FROM seller_initial ";
$s_stmt = $pdo->query($s_sql);
$seller = $s_stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($fc as $f){
    $food[$f['seller_sid']][] = $f;
}

// print_r($food);
// exit;
foreach($seller as $k=>$s){

    if(isset($food[$s['seller_sid']])){
        $seller[$k]['foods'] = $food[$s['seller_sid']];
    }
    
}
echo json_encode($seller, JSON_UNESCAPED_UNICODE);