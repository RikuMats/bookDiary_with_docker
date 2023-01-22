<?php
function connect_db(){
    //ホスト名、データベース名、文字コードの３つを定義する
    $host = 'mysql';
    $db = 'test_project';
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
$sql = 'SELECT * FROM users';
$stmt = $pdo->prepare($sql);

//SQLを実行
$stmt->execute();

//データベースの値を取得
$result = $stmt->fetchall();
$sql = 'SELECT * FROM bookmaster';
$stmt = $pdo->prepare($sql);

//SQLを実行
$stmt->execute();
$result2 = $stmt->fetchall();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
    foreach($result as $r){
      echo 'username: '. $r['name'];
      echo '<br>';
      echo 'email: '. $r['email'];
      echo '<hr>';
    }
    foreach($result2 as $r){
      echo 'title: '. $r['title'];
      echo '<br>';
      echo 'author: '. $r['author'];
      echo '<hr>';
    }
    ?>
</body>
</html>