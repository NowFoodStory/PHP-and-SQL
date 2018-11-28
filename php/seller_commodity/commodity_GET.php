<?php
if (!isset($from_commodity)) {
    $result['error'] = '請從 CommodityAPI 訪問';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

// $result = $_SESSION['seller']['seller_sid'];
$keys = (int)$_SESSION['seller']['seller_sid'];
$sql = sprintf(
    "SELECT * FROM food_commodity 
    WHERE seller_sid =%s",
    $keys
);

///接收不能為字串
// echo json_encode($keys);
// echo $sql;

$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = [
    'success' => true,
    'resultCode' => 200,
    'error' => '',
    'method' => $method,
    'sequence' => $keys,
    'seller_sid' => $_SESSION['seller']['seller_sid'],
    'sellerProducts' => $stmt->fetchAll(PDO::FETCH_ASSOC),
];

echo json_encode($result, JSON_UNESCAPED_UNICODE);