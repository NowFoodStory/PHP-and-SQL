<?php
$Numb_sid = isset($_GET['Numb_sid']) ? intval($_GET['Numb_sid']) : 1;

$seller_sid="SELECT s.seller_name,s.logo_photo,s.seller_address,s.opening,s.close_time,s.seller_phone 
FROM order_data AS d JOIN seller_initial AS s ON d.seller_sid = s.seller_sid
WHERE d.Numb_sid = ?";

$stmt = $pdo->prepare($seller_sid);
$stmt->execute([$Numb_sid]);
$seller = $stmt->fetchAll(PDO::FETCH_ASSOC);

$foodsql="SELECT o.food_sid ,o.food_name,o.food_photo,o.food_quantity,o.food_discount
FROM order_data AS d 
JOIN orders AS o 
ON d.Numb_sid = o.Numb_sid
WHERE d.Numb_sid = ?";
$stmt2 = $pdo->prepare($foodsql);
$stmt2->execute([$Numb_sid]);
$fc = $stmt2->fetchAll(PDO::FETCH_ASSOC);


// $food =[];


// foreach($fc as $f){
//     $food[$f['Numb_sid']][] = $f;
// }

$result =[
    'sellerData'=>$seller,
    'FoodData'=>$fc,
];
echo json_encode($result, JSON_UNESCAPED_UNICODE);

