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

if ($bdata['city'] === "縣市"){
    // echo "縣市判斷成空值";
    $bdata['city']=empty($bdata['city']);
}




if (empty($bdata['city']) && empty($bdata['search'])) {
    // echo "都不帶值";
    $s_sql = "SELECT seller_sid,`seller_name`,`opening`,`close_time`,`logo_photo`,`lng`,`lat`,`distance`  FROM seller_initial ORDER BY `seller_initial`.`distance` ASC";
}else if(!empty($bdata['city']) && empty($bdata['search'])) {
    // echo "城市欄位帶值 欄位後面順便帶區";
    $a = '\'' . '%' . $bdata['city'].$bdata['place'] . '%' . '\'';
    $s_sql = "SELECT seller_sid,`seller_name`,`opening`,`close_time`,`logo_photo`,`lng`,`lat`,`distance`  FROM seller_initial WHERE seller_address LIKE $a ORDER BY `seller_initial`.`distance` ASC";

}else if(empty($bdata['city']) && !empty($bdata['search'])){
    // echo "搜尋欄位帶值";
    $b = '\'' . '%' . $bdata['search'] . '%' . '\'';
    $s_sql = "SELECT seller_sid,`seller_name`,`opening`,`close_time`,`logo_photo`,`lng`,`lat`,`distance`  FROM seller_initial WHERE seller_name LIKE $b ORDER BY `seller_initial`.`distance` ASC";
}else{
    // echo"城市欄位跟搜尋帶值";
    $a = '\'' . '%' . $bdata['city'].$bdata['place'] . '%' . '\'';
    $b = '\'' . '%' . $bdata['search'] . '%' . '\'';
    $s_sql = "SELECT seller_sid,`seller_name`,`opening`,`close_time`,`logo_photo`,`lng`,`lat`,`distance`  FROM seller_initial WHERE seller_address LIKE $a and seller_name LIKE $b ORDER BY `seller_initial`.`distance` ASC";
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
if(empty($result)){
    $resultMsg['resultCode'] = 255;
    $resultMsg['errorMsg'] = '沒有搜尋結果';
}elseif(!empty($result)){
    $resultMsg['resultCode']= 200;
    $resultMsg['errorMsg'] = '搜尋成功';
    $resultMsg['result'] = $result;
}
echo json_encode($resultMsg, JSON_UNESCAPED_UNICODE);
