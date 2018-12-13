<?php

$sql="SELECT `user_name`,`user_phone`,`user_email`,`user_photo`,`user_status`
 FROM `user_data` WHERE 1";
$stmt = $pdo->query($sql);
$user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);



echo json_encode($user_data,JSON_UNESCAPED_UNICODE);