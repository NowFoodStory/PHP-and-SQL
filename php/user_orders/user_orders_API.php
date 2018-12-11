<?php
require __DIR__ . '/../__connect_db.php';


$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '用戶沒有登入',
];
header('Content-Type: application/json');
if (!isset($_SESSION['user'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$user_id = $_SESSION['user']['user_id'];
///會員有哪些訂單
    $Numb_sid = "SELECT d.Numb_sid,s.seller_name,s.seller_sid,d.total,d.status,d.order_time
    FROM order_data AS d 
    JOIN seller_initial AS s 
    ON d.seller_sid = s.seller_sid 
    WHERE d.user_id = ? ";

$stmt = $pdo->prepare($Numb_sid);
$stmt->execute([$user_id]);
$Numb_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
// foreach($Numb_data as $nd){
//     $Numb['Numb'][] = $nd;
// }
echo json_encode($Numb_data, JSON_UNESCAPED_UNICODE);