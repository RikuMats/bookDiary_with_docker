<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header("Content-type: application/json; charset=UTF-8");
$json = file_get_contents('php://input');
$postedData = json_decode($json, true);

$userId = $postedData['userId'];
$postedToken = $postedData['token'];

$verificationCode = $postedData['verificationCode'];
$token = "tokenA";
if (strcmp($token, $postedToken) == 0){
  $isVerified = true;
}else{
  $isVerified = false;
}
// データベースから持ってくる
if ($isVerified && (strcmp($verificationCode, "code") == 0)){
  $isVerified = true;
} else{
  $isVerified = false;
}
$data = array(
  "isVerified" => $isVerified,
);
if(json_last_error() == JSON_ERROR_NONE){
    echo json_encode($data);
}
else{
    http_response_code(500);
}
?>