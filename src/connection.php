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

//データベースと接続して、PDOインスタンスを取得
$pdo = connect_db();

//実行したいSQLを準備する
// $sql = 'SELECT * FROM users';
// $stmt = $pdo->prepare($sql);

// //SQLを実行
// $stmt->execute();
// $result = $stmt->fetchall();

// //データベースの値を取得
// $sql = 'SELECT * FROM bookmaster';
// $stmt = $pdo->prepare($sql);

// //SQLを実行
// $stmt->execute();
// $result2 = $stmt->fetchall();

?>