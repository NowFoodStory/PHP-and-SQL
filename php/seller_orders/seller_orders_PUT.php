<?php
require __DIR__ . '/../__connect_db.php';


$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '用戶沒有登入',
];


if (!isset($_SESSION['user'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$entityBody = file_get_contents('php://input');
$bdata = json_decode($entityBody, true);
$result['food'] = $bdata;

$sql = "UPDATE `order_data` SET `status`=? WHERE Numb_sid =?";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $bdata['Numb_sid'],
    $bdata['status']
]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result, JSON_UNESCAPED_UNICODE);