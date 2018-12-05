<?php
require __DIR__.'/../__connect_db.php';

$Seller = sprintf(
    "SELECT `seller_sid`,`seller_name`,`opening`,`close_time`,`logo_photo` FROM `seller_initial`"
);

$sql = sprintf(
    "SELECT * FROM　`seller_initial` WHERE `seller_sid`=$Seller"
);
// $sql = sprintf(
//     "SELECT * FROM `seller_initial`" );
// $sql2 = sprintf(
//     "SELECT * FROM `food_commodity`");

$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = [
    'success' => true,
    'resultCode' => 200,
    'error' => '',
    'method' => $method,
    'sellerProducts' => $stmt->fetchAll(PDO::FETCH_ASSOC),
];

echo json_encode($result, JSON_UNESCAPED_UNICODE);

// $sql = sprintf(
//     "SELECT * FROM seller_initial AS s
//     INNER JOIN food_commodity AS f ON s.seller_sid = f.seller_sid "
// );