<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header("Content-type: application/json; charset=UTF-8");
require_once("connection.php");

$json = file_get_contents('php://input');
$postedData = json_decode($json, true);

$userId = $postedData['userId'];
$postedToken = $postedData['token'];
$postedISBN = $postedData['isbn'];
$postedImpression = $postedData['impression'];

$isVerified = verify_token($pdo, $userId, $postedToken);
// データベースから持ってくる
//isbnとuserIdをキーにして状態の書き換え

$date = new DateTimeImmutable();
$date_str = $date->format("Y-m-d H:i:s");
if($isVerified) {
  $sql = "UPDATE history SET impression=?, updated_date=?, is_red=?";
  $stmt = $pdo->prepare($sql);
  $isVerified = $stmt->execute(array($postedImpression, $date_str,true));
}

// 感想を書いた日付保存
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