<?php
require __DIR__.'/__connect_db.php';

$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '資料不足',
];

$entityBody = file_get_contents('php://input');

$bdata = json_decode($entityBody, true);

// print_r($bdata);


$result['data_from'] = $bdata;

$reuire_fields = [
    'seller_email',
    'seller_password'
];
foreach ($reuire_fields as $rf) {
    if (empty($bdata[$rf])) {
        $result['resultCode'] = 405;
        $result['errorMsg'] = $rf . '為必要欄位';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
}
$sql = "SELECT `seller_sid`, `seller_name`,`seller_email`,`seller_password`,`principal`, `seller_phone`,`seller_EIN`,
`seller_address`,`seller_status`,`type`,`logo_photo`
   FROM `seller_initial` WHERE `seller_email`=? AND `seller_password`=?";


$stmt = $pdo->prepare($sql);

try{
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $bdata['seller_email'],
        $bdata['seller_password']
    ]);
    if($stmt->rowCount()==1){
        $_SESSION['seller'] = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $result['success'] = true;
        $result['resultCode'] = 200;
        $result['errorMsg'] = '';

        $result['seller'] = $_SESSION['seller'];
    }else{
        $result['resultCode']=404;
        $result['errorMsg'] = '帳號或密碼錯誤';
    } 
}catch(PDOException $ex){
    $result['resultCode'] = 402;
    $result['errorMsg'] = $ex->getMessage();
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);