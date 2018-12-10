<?php
require __DIR__.'/../__connect_db.php';


$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '用戶沒有登入',
];
header('Content-Type: application/json');
if(! isset($_SESSION['user'])){
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
    exit;
}
$user_id = $_SESSION['user']['user_id'];

$seller_sid="SELECT s.seller_sid,s.seller_name,d.Numb_sid 
FROM order_deta AS d 
JOIN seller_initial AS s 
ON d.seller_sid = s.seller_sid 
WHERE d.user_id = ?";

$stmt = $pdo->prepare($seller_sid);
$stmt->execute([$user_id]);
$seller = $stmt->fetchAll(PDO::FETCH_ASSOC);

$foodsql="SELECT o.food_name,o.food_photo,o.food_quantity,o.food_discount FROM order_deta AS d 
JOIN orders AS o 
ON d.Numb_sid = o.Numb_sid
WHERE d.Numb_sid = ?";
$stmt2 = $pdo->prepare($foodsql);
$stmt2->execute([$Numb_sid]);
$fc = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$result =[
    'sellerData'=>$seller,
    'FoodData'=>$fc,
];

echo json_encode($result, JSON_UNESCAPED_UNICODE);