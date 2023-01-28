<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header("Content-type: application/json; charset=UTF-8");
$json = file_get_contents('php://input');
$postedData = json_decode($json, true);

$userId = $postedData['userId'];
$postedToken = $postedData['token'];
$postedISBN = $postedData['isbn'];
$postedImpression = $postedData['impression'];

// データベースから持ってくる
//isbnとuserIdをキーにして状態の書き換え
// 感想を書いた日付保存
$token = "tokenA";
if (strcmp($token, $postedToken) == 0){
  $isVerified = true;
}else{
  $isVerified = false;
}
//データベースにbook登録
$data = array(
  "isVerified" => $isVerified,
  // isbnはテスト用最終的にはいらない
  "isbn" => $postedISBN
);
if(json_last_error() == JSON_ERROR_NONE){
    echo json_encode($data);
}
else{
    http_response_code(500);
}
?>