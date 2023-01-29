<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header("Content-type: application/json; charset=UTF-8");
// idとパスワード受け取ってtokenも
// https://qiita.com/wakahara3/items/792943c1e0ed7a87e1ef

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$userName = $data['userName'];
$password = $data['password'];
$email = $data['email'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$token = "tokenA";
$isVerified = true;

//IDサーバから取得
$userId = "aaaaaa";
// サーバに保存
$oneTimeCode = "1TimeCode";

$data = array(
  "userId" => $userId, 
  "token" => $token,
  "isVerified" => $isVerified
);

if(json_last_error() == JSON_ERROR_NONE){
    echo json_encode($data);
}
else{
    http_response_code(500);
}
?>