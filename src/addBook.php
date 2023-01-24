<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header("Content-type: application/json; charset=UTF-8");
// idとパスワード受け取ってtokenも
// https://qiita.com/wakahara3/items/792943c1e0ed7a87e1ef

$json = file_get_contents('php://input');
$postedData = json_decode($json, true);

$userId = $postedData['userId'];
$postedToken = $postedData['token'];

$book = $postedData['newBook'];
// データベースから持ってくる
$token = "tokenA";
if (strcmp($token, $postedToken) == 0){
  $isVerified = true;
}else{
  $isVerified = false;
}
//データベースにbook登録
$data = array(
  "isVerified" => $isVerified,
  "book" => $book
);
if(json_last_error() == JSON_ERROR_NONE){
    echo json_encode($data);
}
else{
    http_response_code(500);
}
?>