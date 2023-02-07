<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header("Content-type: application/json; charset=UTF-8");
require_once("utils.php");

$json = file_get_contents('php://input');
$postedData = json_decode($json, true);

$userId = $postedData['userId'];
$postedToken = $postedData['token'];
$verificationCode = $postedData['verificationCode'];

$pdo = connect_db();
$sql = "SELECT * FROM users 
WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute(array($userId));
$result = $stmt->fetch();
$isVerified = strcmp($result['token'], $postedToken) == 0 &&
  strcmp($verificationCode, $result['verification_code']) == 0;
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