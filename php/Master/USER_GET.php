<?php

$sql="SELECT `user_id`,`user_name`,`user_phone`,`user_email`,`user_photo`,`user_status`
 FROM `user_data` WHERE 1 and `type`=1 ORDER BY `user_data`.`user_status` ASC";
$stmt = $pdo->query($sql);
$user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);



echo json_encode($user_data,JSON_UNESCAPED_UNICODE);