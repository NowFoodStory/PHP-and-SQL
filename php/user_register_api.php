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
    //empty 空值
    !empty($_POST['user_email'])
    // !empty($_POST['user_phone']) and
    // !empty($_POST['user_password'])
    ){
        $result['postData'] =$_POST;
//result 結果
        $sql = "INSERT INTO `user_data`(
            `user_name`,`user_phone`,`user_email`,`user_password`,
            `user_photo`,`user_status`,`user_create_time`)
            VALUES(
                ?,
                ?,
                ?,
                ?,
                0,
                0,
              NOW()
          )";
try{
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        //$stmt 宣告的變數
        //execute執行
        $_POST['user_name'],
        $_POST['user_phone'],
        $_POST['user_email'],
        $_POST['user_password'],
    ]);
    $result['success'] = true;
    $result['resultCode'] =200;
    $result['errorMsg'] ='';
    //result結果
}catch(PDOException $ex){
    //抓到另一支php檔案
    $result['resultCode'] = 402;
    $result['errorMsg'] = $ex->getMessage();
}
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);