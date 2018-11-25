<?php

if(! isset($from_commodity)){
    $result['error'] = '請從 commodity_API.php 訪問';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$sql = sprintf("SELECT * FROM food_shop_list WHERE seller_sid IN (%S)",
    implode(',')
);