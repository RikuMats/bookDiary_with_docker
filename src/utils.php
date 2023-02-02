<?php
function makeToken($len = 6) {
  $token = chr(mt_rand(65, 90));
  for ($i = 0; $i < $len - 1; $i++) {
    $token .= chr(mt_rand(65, 90));
    
  }
  return $token;
}
?>