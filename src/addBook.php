<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header("Content-type: application/json; charset=UTF-8");
require_once("connection.php");

$json = file_get_contents('php://input');
$postedData = json_decode($json, true);

$userId = $postedData['userId'];
$postedToken = $postedData['token'];

$book = $postedData['newBook'];
// データベースから持ってくる
$isVerified = verify_token($pdo, $userId, $postedToken);
$sql = "INSERT IGNORE INTO book_master (isbn, title, author, img_url) VALUES(?,?,?,?)";
$stmt = $pdo->prepare($sql);
$flag = $stmt->execute(array($book['isbn'], $book['title'], $book['author'], $book['img_url']));

$isVerified = $isVerified && $flag; 
$sql = "INSERT IGNORE INTO history (isbn, user_id) VALUES(?,?)";
$stmt = $pdo->prepare($sql);
$flag = $stmt->execute(array($book['isbn'], $userId));

$isVerified = $isVerified && $flag; 
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