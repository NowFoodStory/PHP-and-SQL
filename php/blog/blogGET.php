<?php
$sql = "SELECT * FROM `blog` ORDER BY `blog`.`blog_sid` DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$blog = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($blog, JSON_UNESCAPED_UNICODE);