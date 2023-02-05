<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header("Content-type: application/json; charset=UTF-8");
require_once("connection.php");
require_once("utils.php");
// idとパスワード受け取ってtokenも
// https://qiita.com/wakahara3/items/792943c1e0ed7a87e1ef

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$userId = $data['userId'];
$password = $data['password'];

$sql = "SELECT password, name FROM users WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute(array($userId));
$result = $stmt->fetch();

$isVerified =password_verify($password, $result['password']);
//データベースに登録　アップデート 
if ($isVerified) {
  $token = makeToken();
  $sql = "UPDATE users SET   token=?";
  $stmt = $pdo->prepare($sql);
  $isVerified = $stmt->execute(array($token));
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