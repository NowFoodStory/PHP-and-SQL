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
$Numb_sid = "SELECT s.seller_sid,s.seller_name,d.Numb_sid 
FROM order_data AS d 
JOIN seller_initial AS s 
ON d.seller_sid = s.seller_sid 
WHERE d.user_id = ?";

$stmt = $pdo->prepare($Numb_sid);
$stmt->execute([$user_id]);
$Numb_data = $stmt->fetchAll(PDO::FETCH_ASSOC);


///食物內容
$foodsql = "SELECT o.food_name,o.food_photo,o.food_quantity,o.food_discount,o.status
FROM order_data AS d 
JOIN orders AS o 
ON d.Numb_sid = o.Numb_sid
WHERE d.Numb_sid = ?";
$stmt2 = $pdo->prepare($food);
// $stmt2->execute();
$fc = $stmt2->fetchAll(PDO::FETCH_ASSOC);
$Numb = [];

foreach($Numb_data as $nd){
    $Numb['Numb_sid'][] = $nd['Numb_sid'];
}



// $result =[
//     'sellerData'=>$Numb_data,
//     'FoodData'=>$fc,
// ];



echo json_encode($Numb, JSON_UNESCAPED_UNICODE);
// echo json_encode($fc, JSON_UNESCAPED_UNICODE);