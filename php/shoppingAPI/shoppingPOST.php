<?php
$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '資料不足',
];
if (!isset($from_shopping)) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$entityBody = file_get_contents('php://input');
$bdata = json_decode($entityBody, true);
$ar2 = [];
foreach ($bdata as $k => $v) {
    $ar2[$k] = $pdo->quote($v);
}

$f_sql = sprintf(
    "SELECT * FROM food_commodity WHERE food_class=%s and food_quantity > 0",
    implode(' OR food_class=', $ar2)
);
$f_stmt = $pdo->query($f_sql);
$fc = $f_stmt->fetchAll(PDO::FETCH_ASSOC);

$s_sql = "SELECT seller_sid,`seller_name`,`opening`,`close_time`,`logo_photo` FROM seller_initial ";
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
foreach ($seller as $k => $s) {
    if (! isset($seller[$k]['foods'])) {
        unset($seller[$k]);
    }
}

echo json_encode($seller, JSON_UNESCAPED_UNICODE);