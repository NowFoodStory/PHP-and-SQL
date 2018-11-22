<?php
require __DIR__.'./__connect_db.php';

header('Content-Type: application/json');

if(! isset($_SESSION['shelves'])){
    $_SESSION['shelves']=[''];
}

$method = $_SERVER['REQUEST_METHOD'];

$result=[
    'success'=>false,
    'result' =>400,
    'error' =>'',
    'cart' =>null,
];

$from_shelves = true;
// $body = file_get_contents('php://');
$body = json_decode($body,true);

switch ($method){
    case 'GET':
    require __DIR__.'/shelves-get.php';
    exit;
}