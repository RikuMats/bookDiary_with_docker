<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header("Content-type: application/json; charset=UTF-8");
// idとパスワード受け取ってtokenも
// https://qiita.com/wakahara3/items/792943c1e0ed7a87e1ef

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$userId = $data['userId'];
$postedToken = $data['token'];
// データベースから持ってくる
$isVerified = verify_token($pod, $userId, $postedToken);

$sql = "SELECT t2.isbn, t2.title, t2.author, t2.img_url,t1.impression, t1.red_date FROM history AS t1
JOIN book_master as t2
ON t1.isbn=t2.isbn AND t1.user_id=?
ORDER BY t1.red_date";
$stmt = $pdo->prepare($sql);
$stmt->execute(array($userId));
$result = $stmt->fetchall();
// 未読と読了の配列作る
$data = [];
foreach($result as $history) {
  $data[] = array(
    "isbn" => $history["isbn"],
    "title" => $history["title"],
    "author" => $history["author"],
    "img_url" => $history["img_url"],
    "impression" => $history["impression"]
  );
}



$data = array(
  "isVerified" => $isVerified,
  "userName" => "default-name",
  "books" => [
    array(
      "isbn" => "9784041117170",
      "title" => "民王シベリアの陰謀",
      "author" => "池井戸潤",
      "img_url" => "http://books.google.com/books/content?id=5IGKzgEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api"
    ),
    array(
      "isbn" => "9784122064492",
      "title" => "花咲舞が黙ってない",
      "author" => "池井戸潤",
      "img_url" => "http://books.google.com/books/content?id=F-2CswEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api"
    ),
    array(
      "isbn" => "9784087716191",
      "title" => "陸王",
      "author" => "池井戸潤",
      "img_url" => "http://books.google.com/books/content?id=5y2DvgAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api"
    )
  ],
  "redBooks" => [
    array( 
      "isbn" => "9784198942304",
      "title" => "アキラとあきら",
      "author" => "池井戸潤",
      "img_url" => "http://books.google.com/books/content?id=jo75swEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api",
      "impression" => "that's interesting"
    ),
    array(
      "isbn" => "9784167110116",
      "title" => "手紙",
      "author" => "東野圭吾",
      "img_url" => "http://books.google.com/books/content?id=_XH4PgAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api",
      "impression" => "that's fun"
    )  
  ]
);

if(json_last_error() == JSON_ERROR_NONE){
    echo json_encode($data);
}
else{
    http_response_code(500);
}
?>