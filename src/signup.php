<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header("Content-type: application/json; charset=UTF-8");
require_once("utils.php");
function makeId() {
  //あとでuuid使う
  $today = time();
  $y = idate("Y", $today);
  $m = idate("m", $today);
  $d = idate("d", $today);
  $h = idate("H", $today);
  $i = idate("i", $today);
  $s = idate("s", $today);
  return 
  chr(65 + intdiv($y,100)).
  ((string)($y%100)).
  chr(65 + $m).
  chr(65 + intdiv($d, 10)).
  chr(65 + $d % 10).
  chr(65 + $h).
  chr(65 + intdiv($i, 10)).
  chr(65 + $i % 10).
  chr(65 + intdiv($s, 10)).
  chr(65 + $s % 10).
  chr(mt_rand(65,90))
  ;

}
// idとパスワード受け取ってtokenも
// https://qiita.com/wakahara3/items/792943c1e0ed7a87e1ef

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$userName = $data['userName'];
$password = $data['password'];
$email = $data['email'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
//トークンはランダム生成
// idはユニークに生成
$token = makeToken();

//IDサーバから取得
$userId = makeId();
// サーバに保存
$oneTimeCode = "code00";
$pdo = connect_db();
$sql = "INSERT INTO users (id,name,password, email,verification_code, token) VALUES(?,?,?,?,?,?)";
$stmt = $pdo->prepare($sql);
$flag = $stmt->execute(array($userId, $userName, $hashed_password, $email, $oneTimeCode, $token));

// idの重複もした方がいい
$isVerified = $flag;
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