<?php
$data = [
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
];
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$data = json_encode($data);
if(json_last_error() == JSON_ERROR_NONE){
    echo $data;
}
else{
    http_response_code(500);
}

?>