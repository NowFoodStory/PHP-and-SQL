<?php
$entityBody = file_get_contents('php://input');
$bdata = json_decode($entityBody, true);
$result['blog'] = $bdata;

$sql="DELETE FROM `blog` WHERE `blog_sid` = ? ";

$stmt = $pdo->prepare($sql);
$stmt->execute([$bdata['blog_sid']]);
if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['resultCode'] = 200;
    $result['errorMsg'] = '文章刪除成功';
} else {
    $result['resultCode'] = 406;
    $result['errorMsg'] = '文章刪除失敗';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);