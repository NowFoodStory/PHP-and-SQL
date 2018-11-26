<?php

if (!isset($from_commodity)) {
    $result['error'] = '請從 commodity_API.php 訪問';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
} elseif (!isset($_SESSION['seller'])) {
    $result['error'] = '請先登入會員';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$keys = array_keys($_SESSION['seller']);

// 取得裡面要有商品才可以找產品資料
if (!empty($keys)) {
    $sql = sprintf(
        "SELECT * FROM food_commodity WHERE seller_sid IN (%s)",
        implode(',', $keys)
    );

    $stmt = $pdo->query($sql);

    $result = [
        'success' => true,
        'resultCode' => 200,
        'error' => '',
        'method' => $method,
        'sequence' => $keys, // 索引式陣式, 可以保有順序
        'commodity' => $stmt->fetchAll(PDO::FETCH_ASSOC),
    ];
} else {
    $result = [
        'success' => true,
        'resultCode' => 200,
        'error' => '',
        'method' => $method,
        'commodity' => [],
    ];
}


echo json_encode($result, JSON_UNESCAPED_UNICODE);
