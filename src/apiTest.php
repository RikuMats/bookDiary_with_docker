<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
    $url = "https://www.googleapis.com/books/v1/volumes?q=吾輩は猫である&filter=ebooks";
    $options = array(
      // HTTPコンテキストオプションをセット
      'http' => array(
          'method'=> 'GET',
          'header'=> 'Content-type: application/json; charset=UTF-8' //JSON形式で表示
      )
    );
    
    // ストリームコンテキストの作成
    $context = stream_context_create($options);
    
    $raw_data = file_get_contents($url, false,$context);
    
    // debug
    // var_dump($raw_data);
    
    // json の内容を連想配列として $data に格納する
    $data = json_decode($raw_data,true);
    $item = $data["items"][0];
    $volume_info = $item["volumeInfo"];
    $i = 0;
    foreach($data["items"] as $item) {
      $volume_info = $item["volumeInfo"];
      $title = $volume_info["title"];
      $author = $volume_info["authors"][0];
      $publisher = $volume_info["publisher"];
      $image_link = $volume_info["imageLinks"]["thumbnail"];

      print("$i:$title, $author, $publisher, $image_link");
    }
    // $title = $volume_info["title"];
    // $author = $volume_info["authors"][0];
    // $publisher = $volume_info["publisher"];
    // $image_link = $volume_info["imageLinks"]["thumbnail"];
    // print($title);
    // print($author);
    // print($publisher);
    // print($image_link);
    // $image_links = $volume_info["imageLinks"];
    // var_dump($image_links);

  ?>
</body>
</html>