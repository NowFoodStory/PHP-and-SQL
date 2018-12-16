<?php
$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '資料不足',
];

$seller_sid = isset($_GET['seller_sid']) ? intval($_GET['seller_sid']) : 1;
$total = isset($_GET['total']) ? intval($_GET['total']) : 1;
$entityBody = file_get_contents('php://input');

$bdata = json_decode($entityBody, true);
$result['Buy'] = $bdata;
$Numb = date("dj");
$data = (string)$Numb;
$Numb_sid = $seller_sid . $data . $_SESSION['user']['user_id'];

//echo $Numb_sid ; 

$sql = "INSERT INTO `orders` ( `Numb_sid`,`seller_sid`,`user_id`, 
`food_sid`,`food_name`,`food_photo`, `food_quantity`, `food_discount`, `order_time`, `status`)
 VALUES (?,?,?,?,?,?,?,?,NOW(),'1')";


$stmt = $pdo->prepare($sql);

$m_sql = "UPDATE `food_commodity` SET `food_quantity`=`food_quantity`-? WHERE `food_sid`=?";
$m_stmt = $pdo->prepare($m_sql);

$order_sql = "INSERT INTO`order_data`(`Numb_sid`,`seller_sid`,`user_id`,`user_name`,`user_phone`,`total`,`order_time`)
VALUES (?,?,?,?,?,?,NOW())";
$o_stmt = $pdo->prepare($order_sql);
foreach ($bdata as $p) {
    $stmt->execute([
        $Numb_sid,
        $seller_sid,
        $_SESSION['user']['user_id'],
        $p['food_sid'],
        $p['food_name'],
        $p['food_photo'],
        $p['food_quantity'],
        $p['food_discount']
    ]);

    $m_stmt->execute([
        $p['food_quantity'],
        $p['food_sid']
    ]);
}
$o_stmt->execute([
    $Numb_sid,
    $seller_sid,
    $_SESSION['user']['user_id'],
    $_SESSION['user']['user_name'],
    $_SESSION['user']['user_phone'],
    $total
]);
// $Numbsid =  $o_stmt->fetchAll(PDO::FETCH_ASSOC);

if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['resultCode'] = 200;
    $result['errorMsg'] = '上傳訂單成功';
    $result['Numb_sid'] = $Numb_sid;
} else {
    $result['resultCode'] = 406;
    $result['errorMsg'] = '上傳訂單失敗';
}

echo json_encode($result,JSON_UNESCAPED_UNICODE);