<?php
if (!isset($from_commodity)) {
    $result['error'] = '請從 CommodityAPI 訪問';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$keys = (int)$_SESSION['seller']['seller_sid'];
$sql = sprintf(
    "SELECT `opening`, `close_time`,`FB`,`IG`,`Web`,`Introduction`, `logo_photo`,
     `cover_photo`, `checkout`  FROM seller_initial 
    WHERE seller_sid =%s",
    $keys
);

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