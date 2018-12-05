<?php

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 1;
$sql ="SELECT * FROM seller_initial 
WHERE seller_sid = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$sid]);
$seller = $stmt->fetchAll(PDO::FETCH_ASSOC);




$shop ="SELECT * FROM food_commodity WHERE seller_sid =?" ;
$stmt2 =$pdo->prepare($shop);
$stmt2 ->execute([$sid]);
$shops =  $stmt2->fetchAll(PDO::FETCH_ASSOC);

$SellerAndShop=[
    'sellerData'=>$seller,
    'shopData'=>$shops,
];
echo json_encode($SellerAndShop, JSON_UNESCAPED_UNICODE);


///http://localhost/FoodStory/PHP-and-SQL/php/store/storeAPI.php?sid=2