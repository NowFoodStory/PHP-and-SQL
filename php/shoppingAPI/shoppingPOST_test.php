<?php
require __DIR__.'/../__connect_db.php';


$ar = ['麵包', '壽司'];
$ar2 = [];
foreach($ar as $k=>$v){
    $ar2[$k] = $pdo->quote($v);
}

// food_class='麵包' OR food_class='壽司' OR food_class='壽司2'

$f_sql =  sprintf("SELECT * FROM food_commodity WHERE food_class=%s and food_quantity > 0",
    implode(' OR food_class=', $ar2)
);

echo $f_sql;

$f_stmt = $pdo->query($f_sql);

$foods = $f_stmt->fetchAll(PDO::FETCH_ASSOC);


print_r($foods);
exit;


$s_sql =  "SELECT seller_sid,`seller_name`,`opening`,`close_time`,`logo_photo` FROM seller_initial ";
$s_stmt = $pdo->query($s_sql);
$seller = $s_stmt->fetchAll(PDO::FETCH_ASSOC);

$f_sql =  "SELECT * FROM food_commodity WHERE food_class=? and food_quantity > 0";
$f_stmt = $pdo->query($f_sql);

// $stmt->execute([]);
$food = [];


$condition = file_get_contents('php://input');
$bdata = json_decode($condition, true);
$fc = $f_stmt->fetchAll(PDO::FETCH_ASSOC);


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
// echo json_encode($food, JSON_UNESCAPED_UNICODE);
echo json_encode($seller, JSON_UNESCAPED_UNICODE);