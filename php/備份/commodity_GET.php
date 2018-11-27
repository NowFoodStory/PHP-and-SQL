<?php






















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
