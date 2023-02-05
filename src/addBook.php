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
$isVerified = verify_token($pdo, $userId, $postedToken);
$sql = "INSERT IGNORE INTO book_master (isbn, title, author, img_url) VALUES(?,?,?,?)";
$stmt = $pdo->prepare($sql);
$flag = $stmt->execute(array($book['isbn'], $book['title'], $book['author'], $book['img_url']));

$isVerified = $isVerified && $flag; 
$date = new DateTimeImmutable();
$date_str = $date->format("Y-m-d H:i:s");
// dateも加える
$sql = "INSERT IGNORE INTO history (isbn, user_id,updated_date,is_red) VALUES(?,?,?,?)";
$stmt = $pdo->prepare($sql);
$flag = $stmt->execute(array($book['isbn'], $userId, $date_str, false));

$isVerified = $isVerified && $flag; 
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