<?php
  $str = "Hello"; 
  $cipher= openssl_encrypt(json_encode($str), "AES-128-ECB");
  echo $cipher;

?>