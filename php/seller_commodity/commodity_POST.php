<?php
if (!isset($from_commodity)) {
    $result['error'] = '請從 CommodityAPI 訪問';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$entityBody = file_get_contents('php://input');

// 把文字解析成 PHP 關聯式陣列
$bdata = json_decode($entityBody, true);

$result['data_from'] = $bdata;

$reuire_fields = [
    'food_name',
    'food_class',
    'food_quantity',
    'food_price',
    'food_discount',
    'food_photo'
];

foreach ($reuire_fields as $rf) {
    if (empty($bdata[$rf])) {
        $result['resultCode'] = 405;
        $result['errorMsg'] = $rf . '為必要欄位';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

$sql = "INSERT INTO `food_commodity`(
    `food_name`,`food_class`,`food_quantity`,
    `food_price`,`food_discount`,
    `food_photo`)
    VALUES(
        ?,
        ?,
        ?,
        ?,
        ?,
        ) WHERE `seller_sid`=? ";
try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
                //$stmt 宣告的變數
                //execute執行
        $_POST['food_name'],
        $_POST['food_class'],
        $_POST['food_quantity'],
        $_POST['food_price'],
        $_POST['food_discount'],
        $_POST['food_photo'],
        $_SESSION['seller']['seller_sid'],
        
    ]);
    $result['success'] = true;
    $result['resultCode'] = 200;
    $result['errorMsg'] = '';
            //result結果
} catch (PDOException $ex) {
    $result['resultCode'] = 402;
    $result['errorMsg'] = $ex->getMessage();
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);