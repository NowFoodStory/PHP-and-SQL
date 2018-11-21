<?php
require __DIR__.'/__connect_db.php';

$result =[
    'success' =>false,
    'resultCode'=>400,
    'errorMsg'=>'註冊資料不足',
    'postData'=>'',
];

if(
    !empty($_POST['seller_email'])and
    !empty($_POST['seller_password'])
){
    $sql = "SELECT `seller_sid`, `seller_name`, `seller_phone`,`seller_EIN`,
     `seller_address`,`seller_status`
        FROM `seller_initial` WHERE `seller_email`=? AND `seller_password`=?";
try{
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['seller_email'],
        $_POST['seller_password'],
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
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);
