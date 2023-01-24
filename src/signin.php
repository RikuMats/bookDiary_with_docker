<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header("Content-type: application/json; charset=UTF-8");
// idとパスワード受け取ってtokenも
// https://qiita.com/wakahara3/items/792943c1e0ed7a87e1ef

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$userId = $data['userId'];
$password = $data['password'];
$hashed_password = password_hash('passwo', PASSWORD_DEFAULT);
if (password_verify($password, $hashed_password)){
  $token = "tokenA";
  // データベースに登録する
  $isVerified = true;
}else{
  $isVerified = false;
}
$data = array(
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