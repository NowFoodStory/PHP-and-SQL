<?php
require __DIR__ . '/../__connect_db.php';


$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '用戶沒有登入',
];
header('Content-Type: application/json');
if (!isset($_SESSION['seller'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$seller_sid = $_SESSION['seller']['seller_sid'];
///廠商有哪些訂單
$Numb_sid = "SELECT d.Numb_sid,s.seller_name,s.seller_sid,d.total,d.status,d.order_time,d.user_name,d.user_phone 
FROM order_data AS d 
JOIN seller_initial AS s ON d.seller_sid = s.seller_sid 
WHERE d.seller_sid = ? AND d.status=1 ORDER BY d.order_time DESC ";
$stmt = $pdo->prepare($Numb_sid);
$stmt->execute([$seller_sid]);
$Numb_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($Numb_data, JSON_UNESCAPED_UNICODE);