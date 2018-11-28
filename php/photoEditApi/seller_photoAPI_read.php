<?php
if(! isset($_SESSION['seller']['seller_photo'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$result = [
    'success' => true,
    'resultCode' => 200,
    'errorMsg' => '',
    'data' => $_SESSION['seller']['seller_photo']
];

echo json_encode($result, JSON_UNESCAPED_UNICODE);