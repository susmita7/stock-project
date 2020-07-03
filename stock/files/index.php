<?php require "../config/config.php"; ?>
<?php
    session_start();
    if ($_SESSION['is_eu_login']) {
      header("Location: ../expertuser/home") ;
      //keep user on this page
    } elseif ($_SESSION['is_da_login']) {
      //keep on this the page
      header("Location: ../expertuser/home") ;
    }
    else{
      //redirect to login page
      header("Location: ../choose") ;
    }  
?>