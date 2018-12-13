<?php
require __DIR__ . '/__connect_db.php';

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
    'user_email',
    'user_password'
];
foreach ($reuire_fields as $rf) {
    if (empty($bdata[$rf])) {
        $result['resultCode'] = 405;
        $result['errorMsg'] = $rf . '為必要欄位';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
}
$sql = "SELECT `user_id`,`user_name`,`user_phone`,
`user_email`,`user_password`,`user_photo`,`user_status`,`type`
   FROM `user_data` WHERE `user_email`=? AND `user_password`=?";


$stmt = $pdo->prepare($sql);

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $bdata['user_email'],
        $bdata['user_password'],
    ]);
    if ($stmt->rowCount() == 1) {
        $_SESSION['user'] = $stmt->fetch(PDO::FETCH_ASSOC);
        $result['success'] = true;
        $result['resultCode'] = 200;
        $result['errorMsg'] = '';
        $result['user'] = $_SESSION['user'];
    }else{
        $result['resultCode'] = 404;
        $result['errorMsg'] = '帳號或密碼錯誤';
    }
} catch (PDOException $ex) {
    $result['resultCode'] = 402;
    $result['errorMsg'] = $ex->getMessage();
}if (isset($_SESSION['user']['user_status']) && ($_SESSION['user']['user_status'] == 1) ) {
    $result['resultCode'] = 444;
    $result['errorMsg'] = '該用戶已被停權';
    unset($_SESSION['user']);
} 


echo json_encode($result, JSON_UNESCAPED_UNICODE);