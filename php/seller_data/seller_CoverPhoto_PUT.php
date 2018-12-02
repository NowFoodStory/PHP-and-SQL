<?php
require __DIR__.'/../__connect_db.php';


$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '用戶沒有登入',
];
header('Content-Type: application/json');


if(! isset($_SESSION['seller'])){
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
    exit;
}


$method = $_SERVER['REQUEST_METHOD'];

$entityBody = file_get_contents('php://input');

$bdata = json_decode($entityBody, true);
$result['editFormSeller'] = $bdata;


$reuire_fields = [
    'cover_photo'
];
foreach($reuire_fields as $rf){
    if(empty($bdata[$rf])){
        $result['resultCode'] = 405;
        $result['errorMsg'] = $rf. '為必要欄位';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

$sql = "UPDATE `seller_initial` SET `cover_photo`=? 
WHERE `seller_sid`=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $bdata['cover_photo'],
    $_SESSION['seller']['seller_sid']
]);
if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['resultCode'] = 200;
    $result['errorMsg'] = '修改成功';
} else {
    $result['resultCode'] = 408;
    $result['errorMsg'] = '修改失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);