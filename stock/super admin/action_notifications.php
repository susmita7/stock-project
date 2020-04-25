<?php require "../config/config.php"; 
  session_start();
  
  // check if super admin logged in or not
  if ($_SESSION['is_sa_login']) {  
    //keep user on page
  }else{
    //redirect on loginpage
    header("Location: login");
  }

extract($_POST);


/***************************_______add notifications________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])){

    $type  = mysqli_real_escape_string($con,trim($_POST['type']));
    
    $notify_title     = mysqli_real_escape_string($con,trim($_POST['notify_title']));
    $notify_title     = ucwords(strtolower($notify_title));

    $notify_message   = mysqli_real_escape_string($con,trim($_POST['notify_message']));
    $notify_message   = ucwords(strtolower($notify_message));
  
    $clg_id           = mysqli_real_escape_string($con,trim($_POST['clg_id']));

    // check if name only contains letters and whitespace
    if (preg_match("/^[a-zA-Z ]*$/",$notify_title)) {
 
      $query = "INSERT INTO clg_admin_notify(notify_title,notify_message,type,clg_id) VALUES('$notify_title','$notify_message','$type','$clg_id')";

      $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));

        if ($fire) {
          $msg = array("icon"=>"success", "title"=>"Done", "text"=>"Notification Successfully Sent!");   
          echo json_encode($msg);
        }
        else{
          $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");   
          echo json_encode($msg);
        }
    }
    else{
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Only letters allowed!");
      echo json_encode($msg);
    }
}