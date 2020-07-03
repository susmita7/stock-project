<?php require "../config/config.php"; ?>
<?php
    session_start();
    if ($_SESSION['is_eu_login']) {
      //keep user on this page
    }
    else{
      //redirect to login page
      header("Location: ../choose") ;
    }

    $id=isset($_GET['id'])? $_GET['id'] : "";

    $stmt = mysqli_prepare($con,"SELECT * FROM file_details WHERE file_id=?") or die("error .".mysqli_error($con));

    mysqli_stmt_bind_param($stmt, 'i', $id) or die(mysqli_error($con));

    mysqli_stmt_execute($stmt) or die(mysqli_error($con));

    $fire = mysqli_stmt_bind_result($stmt, $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8) or die(mysqli_error($con));

    mysqli_stmt_fetch($stmt) or die(mysqli_error($con));

	  header('Content-Type:'.$col5);
	  echo $col6;