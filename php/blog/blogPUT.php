<?php
$entityBody = file_get_contents('php://input');
$bdata = json_decode($entityBody, true);
$result['blog'] = $bdata;

$sql="UPDATE `blog` (`blog_title`, `blog_author`, `blog_photo`, `blog_content`)
 VALUES (?,?,?,?) WHERE `blog_sid`=?";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $bdata['blog_title'],
    $bdata['blog_author'],
    $bdata['blog_photo'],
    $bdata['blog_content']
]);
if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['resultCode'] = 200;
    $result['errorMsg'] = '上傳文章成功';
} else {
    $result['resultCode'] = 406;
    $result['errorMsg'] = '上傳文章失敗';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);