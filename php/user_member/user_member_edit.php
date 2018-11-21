<!-- <?php
$result= [
    'success'=>false,
    'resultCode'=>400,
    'errorMsg' =>'資料不足',
];
if(!isset($from_me)){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}


$entityBody = file_get_contents('php://');

$result['data_from'] = $dbdata;

$reuire_fields = [
    'user_id',
    'user_name',
    'user_phone',
];

foreach($reuire_fields as $rf){
    if(empty($bdata[$rf])){
        $result['resultCode'] = 405;
        $result['errorMsg'] = $rf. '為必要欄位';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
}
// $sql = "UPDATE `