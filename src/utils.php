<?php
function connect_db(){
  //ホスト名、データベース名、文字コードの３つを定義する
  $host = 'mysql';
  $db = 'book_diary';
  $charset = 'utf8';
  $port = '3306';
  $dsn = "mysql:host=$host; port=$port; dbname=$db; charset=$charset";

  //ユーザー名、パスワード
  $user = "usr";
  $pass = "pass";

  //オプション
  $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
  ];
  try{

      //上のデータを引数に入れて、PDOインスタンスを作成
      $pdo = new PDO($dsn, $user, $pass, $options);
  }catch(PDOException $e){
      echo $e->getMessage();
  }

  //PDOインスタンスを返す
  return $pdo;
}

function verify_token($pdo, $userId, $token) {
    $sql = "SELECT * FROM users 
WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute(array($userId));
$result = $stmt->fetch();

return strcmp($result['token'], $token) == 0;
}

function makeToken($len = 6) {
    $token = chr(mt_rand(65, 90));
    for ($i = 0; $i < $len - 1; $i++) {
      $token .= chr(mt_rand(65, 90));
      
    }
    return $token;
  }
  
?>