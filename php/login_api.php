<?php
require __DIR__.'/__connect_db.php';

$result =[
    'success' =>false,
    'resultCode'=>400,
    'errorMsg'=>'註冊資料不足',
    'postData'=>'',
];

if(
    !empty($_POST['user_email'])and
    !empty($_POST['user_password'])
){
    $sql = "SELECT `user_id`, `user_name`, `user_phone`, `user_photo`,
     `user_status` 
        FROM `user_data` WHERE `user_email`=? AND `user_password`=? AND`user_status`=1";
}
try{
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_GET['user_status'==1],
        $_POST['user_email'],
        sha1($_POST['user_password']),
    ]);
    if($stmt->rowCount()==1){
        $_SESSION['user'] = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $result['success'] = true;
        $result['resultCode'] = 200;
        $result['errorMsg'] = '';

        $result['user'] = $_SESSION['user'];
    }else{
        $result['resultCode']=404;
        $result['errorMsg'] = '帳號或密碼錯誤';
    }
}catch(PDOException $ex){
    $result['resultCode'] = 402;
    $result['errorMsg'] = $ex->getMessage();
}
}echo json_encode($result,JSON_UNESCAPED_UNICODE);