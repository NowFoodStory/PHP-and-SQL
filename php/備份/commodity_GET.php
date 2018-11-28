<?php
session_start();
if(! isset($from_commodity)){
    $result['error'] = '請從 CommodityAPI 訪問';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$result=[$_SESSION['seller']['seller_sid']];
$keys = array_keys($_SESSION['seller']['seller_sid']);

print_r($keys);

//一定要有登入才可以找商品資料
if(!empty($keys)) {
    $sql = sprintf("SELECT * FROM food_commodity WHERE seller_sid IN (%s)",
        implode(',', $keys)
);
 
    $stmt = $pdo->query($sql);

    $result = [
        'success' => true,
        'resultCode' => 200,
        'error' => '',
        'method' => $method,
        'commodity' => $_SESSION['seller']['seller_sid'],
        'sequence' => $keys, // 索引式陣式, 可以保有順序
        'sellerProducts' => $stmt->fetchAll(PDO::FETCH_ASSOC)
    ];
} else {
    $result = [
        'success' => true,
        'resultCode' => 202,
        'error' => '',
        'method' => $method,
        'sequence' => $keys,
        'commodity' => $_SESSION['seller']['seller_sid'],
        'sellerProducts' => []
    ];
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);




// <?php
// if (!isset($from_commodity)) {
//     $result['error'] = '請從 CommodityAPI 訪問';
//     echo json_encode($result, JSON_UNESCAPED_UNICODE);
//     exit;
// }

// $result = $_SESSION['seller']['seller_sid'];

// $sql = "SELECT `food_sid`,`food_name`,`food_class`,`food_quantity`,
//     `food_price`,`food_discount`,`food_photo` FROM `food_commodity` WHERE `seller_sid` =? ";
// ///解決方案1[[可以重前端去給值]]

// /// 測試 SQL 用keys去把陣列讀出來
// $stmt = $pdo->prepare($sql);

// $result = [
//             'success' => true,
//             'resultCode' => 200,
//             'error' => '',
//             'method' => $method,
//             'seller_sid' => $_SESSION['seller']['seller_sid'],
//             'sellerProducts' => $stmt->fetchAll(PDO::FETCH_ASSOC),
//         ];
// echo json_encode($result, JSON_UNESCAPED_UNICODE);

















// if(! isset($from_commodity)){
//     $result['error'] = '請從 CommodityAPI 訪問';
//     echo json_encode($result, JSON_UNESCAPED_UNICODE);
//     exit;
// }

// $keys = array_keys($_SESSION['seller']['seller_sid']);

// // 一定要有登入才可以找商品資料
// if(!empty($keys)) {
//     $sql = sprintf("SELECT * FROM `food_commodity` WHERE `seller_sid` IN (%s)",
//         implode(',', $keys)
//     );

//     $stmt = $pdo->query($sql);

//     $result = [
//         'success' => true,
//         'resultCode' => 200,
//         'error' => '',
//         'method' => $method,
//         'seller_sid' => $keys, // 索引式陣式, 可以保有順序
//         'sellerProducts' => $stmt->fetchAll(PDO::FETCH_ASSOC),
//     ];
// } else {
//     $result = [
//         'success' => true,
//         'resultCode' => 202,
//         'error' => '',
//         'method' => $method,
//         'sellerProducts' => [],
//     ];
// }
// echo json_encode($result, JSON_UNESCAPED_UNICODE);
