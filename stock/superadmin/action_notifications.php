<?php require "../config/config.php"; 
  session_start();
  
  // check if super admin logged in or not
  if ($_SESSION['is_sa_login']) {  
    //keep user on page
  }else{
    //redirect on loginpage
    header("Location: login");
    die();
  }

extract($_POST);

date_default_timezone_set("Asia/kolkata");


/******************************_____Get all notifications________**************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readallnotifications'])) {

  //$query = "SELECT * FROM sup_admin_notify ORDER BY notify_id DESC";

  $query = "SELECT * FROM sup_admin_notify INNER JOIN college ON sup_admin_notify.notify_from=college.clg_id ORDER BY notify_id DESC";

  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

    while ($notification = mysqli_fetch_assoc($fire)) {

      /*----------------------------------- first portion -----------------------------------*/

      $records = '<div class="base_notofication" id="mydiv">
                    <div class="from">';

      $records .='<h5>'.$notification['clg_name'].'</h5>';

      //check if notification is from which college

      /*if ($notification['notify_from']!=0) {
                  
        get the dept name to show

        $query_new = "SELECT * FROM college WHERE clg_id='".$notification['notify_from']."'";

        $fire_new  = mysqli_query($con,$query_new) or die("can not show data from database".mysqli_error($con));

        $cn = mysqli_fetch_assoc($fire_new);

        $records .='<h5>'.$cn['clg_name'].'</h5>';
       
      }*/

      /*------------------------------------- middle portion -------------------------------------*/

      $records .='</div>
                    <div class="description">
                        
                      <div class="title">
                        <i class="fas fa-bell"></i>
                        <h6>'.$notification['notify_title'].'</h6>
                      </div>

                      <p>'.$notification['notify_message'].'.</p>

                      <div class="time_date">
                      
                      <h5><h5>';
        
               
              $formatInput = 'Y-m-j H:i:s'; //database date format
              $dateInput = $notification['created_at']; //date from database

              $formatOut = 'jS F Y, h:i A';
              //$formatOut = 'j-m-Y h:i:s'; // convert to this format
              $dateOut = DateTime::createFromFormat($formatInput, $dateInput)->format($formatOut);

      $records .='<h4>'.$dateOut.'</h4>
                    </div>
                  </div>';

      /*------------------------------- last portion ---------------------------------*/

      if ($notification['status']==1) {

        $records .='<div class="status">
                        <i class="fa fa-eye"></i>
                        <h5>Read</h5>
                    </div>';
      
      }else if ($notification['status']==0) {
                        
        $records .='<div class="status">
                        <i class="fa fa-eye-slash"></i>
                        <h5>Unread</h5>
                    </div>';
      }

      $records .='</div>';

      echo $records;
    } // end of while loop
  }else{
    // no notifications available
    $records = '<div class="base_notofication">
                  <div class="description">
                    <center>No Notifications Available</center>
                  </div>
                </div>';
    echo $records;
  } 
}





/***************************_______send  notifications________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send'])){
    
  $notify_title     = mysqli_real_escape_string($con,trim($_POST['notify_title']));
  $notify_title     = ucwords(strtolower($notify_title));

  $notify_message   = mysqli_real_escape_string($con,trim($_POST['notify_message']));
  
  $clg_id           = mysqli_real_escape_string($con,trim($_POST['clg_id']));

  // check if name only contains letters and whitespace
  if (preg_match("/^[a-zA-Z ]*$/",$notify_title)) {

    $created_at       = date("Y-m-d H:i:s");
 
    $query = "INSERT INTO clg_admin_notify(created_at,notify_title,notify_message,clg_id) VALUES('$created_at','$notify_title','$notify_message','$clg_id')";

    $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));

    if ($fire) {

      $q="SELECT * FROM college WHERE clg_id='$clg_id'";
      $f= mysqli_query($con,$q) or die("can not show data from database. ".mysqli_error($con));
      $row=mysqli_fetch_assoc($f);

      $created_at= date("Y-m-d H:i:s");
      $activity_type= "notification";
      $activity_body= "You have sent notification to College Admin : ".$row['clg_name'].".";

      //$other="Message : ".$notify_title.". ".$notify_message;

      $other="Title : ".$notify_title.". Message : ".$notify_message;

      $sup_admin_id=$_SESSION['sup_admin_id'];

      $query_n = "INSERT INTO `sup_admin_activity`(`created_at`, `activity_type`, `activity_body`, `other`, `sup_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$other','$sup_admin_id')";

      $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

      if ($fire_n) {
        $msg = array("icon"=>"success", "title"=>"Done", "text"=>"Notification successfully sent!");   
        echo json_encode($msg);
      }else{
        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");   
        echo json_encode($msg);
      }
    }else{
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");   
      echo json_encode($msg);
    }
  }else{
    $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Only letters allowed in title!");
    echo json_encode($msg);
  }
}