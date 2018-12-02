<?php
require __DIR__.'/__connect_db.php';
//require 這支php
$result = [
    'success' => false,
    'resultCode' => 400,
    'errorMsg' => '註冊資料不足',
    'postData' => '',
];
//
if(
    // !empty 空值
    !empty($_POST['seller_name'])
    // !empty($_POST['seller_phone']) and
    // !empty($_POST['seller_EIN'])and
    // !empty($_POST['seller_address']) and
    // !empty($_POST['seller_email']) and
    // !empty($_POST['seller_password'])
    ){
        $result['postData'] =$_POST;
//result 結果
        $sql = "INSERT INTO `seller_initial`(
            `seller_name`,`seller_phone`,`seller_EIN`,
            `seller_address`,`seller_email`,
            `seller_password`,`seller_status`,
            `seller_create_at`,`logo_photo`)
            VALUES(
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                0,
                NOW(),
                'user.svg'
                )";
try{
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        //$stmt 宣告的變數
        //execute執行
        $_POST['seller_name'],
        $_POST['seller_phone'],
        $_POST['seller_EIN'],
        $_POST['seller_address'],
        $_POST['seller_email'],
        $_POST['seller_password'],
    ]);
    $result['success'] = true;
    $result['resultCode'] =200;
    $result['errorMsg'] ='';
    //result結果
}catch(PDOException $ex){
    $result['resultCode'] = 402;
    $result['errorMsg'] = $ex->getMessage();
}
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);