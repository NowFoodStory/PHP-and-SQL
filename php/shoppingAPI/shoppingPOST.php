<?php
$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '請從',
];
if (!isset($from_shopping)) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$entityBody = file_get_contents('php://input');
$bdata = json_decode($entityBody, true);
$ar2 = [];

if (empty($bdata['foodclass'])) {
    $f_sql = "SELECT * FROM food_commodity WHERE food_quantity > 0";
} else {
    foreach ($bdata['foodclass'] as $k => $v) {
        $ar2[$k] = $pdo->quote($v);
    }

    $f_sql = sprintf(
        "SELECT * FROM food_commodity WHERE food_class=%s and food_quantity > 0",
        implode(' OR food_class=', $ar2)
    );
}
$f_stmt = $pdo->query($f_sql);
$fc = $f_stmt->fetchAll(PDO::FETCH_ASSOC);
//city and search
if (empty($bdata['place']) && empty($bdata['city'])) {
    $s_sql = "SELECT seller_sid,`seller_name`,`opening`,`close_time`,`logo_photo`,`lng`,`lat` FROM seller_initial ";
}else if(!empty($bdata['place']) && empty($bdata['city'])) {
    // echo '條件:城市欄位帶值';
    $a = '\''.'%'.$bdata['city'].$bdata['place'].'%'.'\'';
    $pdo->quote($a);
    $s_sql = "SELECT seller_sid,`seller_name`,`opening`,`close_time`,`logo_photo`,`lng`,`lat` FROM seller_initial WHERE seller_address LIKE $a";
}else if(empty($bdata['place']) && !empty($bdata['city'])){
    // echo '條件:搜尋框帶值';
    $b = '\''.'%'.$bdata['search'].'%'.'\'';
    $s_sql = "SELECT seller_sid,`seller_name`,`opening`,`close_time`,`logo_photo`,`lng`,`lat` FROM seller_initial WHERE seller_name LIKE $b";
}else{
    // echo '條件:兩個都有值';
    $a = '\''.'%'.$bdata['city'].$bdata['place'].'%'.'\'';
    $b = '\''.'%'.$bdata['search'].'%'.'\'';
    $s_sql = "SELECT seller_sid,`seller_name`,`opening`,`close_time`,`logo_photo`,`lng`,`lat` FROM seller_initial WHERE seller_address LIKE $a and seller_name LIKE $b";
}

$s_stmt = $pdo->query($s_sql);
$seller = $s_stmt->fetchAll(PDO::FETCH_ASSOC);

$food = [];

foreach ($fc as $f) {
    $food[$f['seller_sid']][] = $f;
}
foreach ($seller as $k => $s) {

    if (isset($food[$s['seller_sid']])) {
        $seller[$k]['foods'] = $food[$s['seller_sid']];
    }

}
$result = [];
foreach ($seller as $k => $s) {
    if (isset($seller[$k]['foods'])) {
        $result[] = $seller[$k];
    }
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);