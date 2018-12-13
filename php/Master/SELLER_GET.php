<?php

$sql="SELECT `seller_sid`,`seller_name`,`seller_phone`,`seller_email`,`seller_status`
 FROM `seller_initial` WHERE 1 ORDER BY `seller_initial`.`seller_status` ASC ";
$stmt = $pdo->query($sql);
$seller_data = $stmt->fetchAll(PDO::FETCH_ASSOC);



echo json_encode($seller_data,JSON_UNESCAPED_UNICODE);