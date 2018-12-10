<?php

$seller_sid = isset($_GET['seller_sid']) ? intval($_GET['seller_sid']) : 1;
$sql ="SELECT * FROM seller_initial WHERE seller_sid = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$seller_sid]);
$seller = $stmt->fetchAll(PDO::FETCH_ASSOC);




$shop ="SELECT * FROM food_commodity WHERE seller_sid =? and food_quantity > 0" ;
$stmt2 =$pdo->prepare($shop);
$stmt2 ->execute([$seller_sid]);
$food = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$SellerAndShop=[
    'sellerData'=>$seller,
    'shopData'=>$food,
];
echo json_encode($SellerAndShop, JSON_UNESCAPED_UNICODE);


///http://localhost/FoodStory/PHP-and-SQL/php/store/storeAPI.php?sid=2