<?php
$db_host = 'localhost';
$db_name = 'foodstory';
$db_user = 'root';
$db_pass = '';

$dsn = sprintf('mysql:dbname=%s;host=%s', $db_name, $db_host);

// 不是預設的 3306 請設定 port number
// mysql:host=localhost;port=3307;dbname=testdb
try {
    $pdo = new PDO($dsn, $db_user, $db_pass);
    // 連線使用的編碼設定
    $pdo->query("SET NAMES utf8");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo 'Connection failed:' . $ex->getMessage();
}

if (!isset($_SESSION)) {
    session_start(); // 啟用 session 功能
}
// setcookie("user_cookie", "", time()+3600);

// header('Access-Control-Allow-Origin: http://localhost:3000');
// header('Access-Control-Allow-Credentials: true');
// header('')
header('Access-Control-Allow-Origin: http://localhost:3000');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');