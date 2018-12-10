<?php
require __DIR__.'/../__connect_db.php';

$blog_sid = isset($_GET['blog_sid']) ? intval($_GET['blog_sid']) : 1;


$sql ="SELECT * FROM blog WHERE blog_sid = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$blog_sid]);
$blog = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($blog, JSON_UNESCAPED_UNICODE);