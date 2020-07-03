<?php require "../config/config.php"; 
  session_start();
  
  // check if EU logged in or not
  if ($_SESSION['is_eu_login']) {  
    //keep user on page
  }else{
    //redirect on loginpage
    header("Location: ../choose") ;
  }

date_default_timezone_set("Asia/kolkata");

extract($_POST);

function time_ago($timestamp)  
 {  
      $time_ago = strtotime($timestamp);  
      $current_time = time();  
      $time_difference = $current_time - $time_ago;  
      $seconds = $time_difference;
      //$seconds = $seconds-43200;  
      $minutes      = round($seconds / 60 );           // value 60 is seconds  
      $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
      $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
      $weeks          = round($seconds / 604800);          // 7*24*60*60;  
      $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
      $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
      if($seconds <= 60)  
      {  
     return "Just Now";  
   }  
      else if($minutes <=60)  
      {  
     if($minutes==1)  
           {  
       return "one minute ago";  
     }  
     else  
           {  
       return "$minutes minutes ago";  
     }  
   }  
      else if($hours <=24)  
      {  
     if($hours==1)  
           {  
       return "an hour ago";  
     }  
           else  
           {  
       return "$hours hrs ago";  
     }  
   }  
      else if($days <= 7)  
      {  
     if($days==1)  
           {  
       return "yesterday";  
     }  
           else  
           {  
       return "$days days ago";  
     }  
   }  
      else if($weeks <= 4.3) //4.3 == 52/12  
      {  
     if($weeks==1)  
           {  
       return "a week ago";  
     }  
           else  
           {  
       return "$weeks weeks ago";  
     }  
   }  
       else if($months <=12)  
      {  
     if($months==1)  
           {  
       return "a month ago";  
     }  
           else  
           {  
       return "$months months ago";  
     }  
   }  
      else  
      {  
     if($years==1)  
           {  
       return "one year ago";  
     }  
           else  
           {  
       return "$years years ago";  
     }  
   }  
 }  





/***************************_______checking admin id exist or not ________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['check'])) {

  $eu_id=mysqli_real_escape_string($con,trim($_SESSION["eu_id"]));

  $query = "SELECT * FROM expert_user WHERE eu_id=$eu_id";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
    $checking = 1;      
  }else{
    $checking = 0;  
  }
  echo $checking;
}





/***************************_______Get Profile pic and name ________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
  
  $eu_id=mysqli_real_escape_string($con,trim($_SESSION["eu_id"]));
  
  $query = "SELECT * FROM expert_user WHERE eu_id=$eu_id";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

      $datas = mysqli_fetch_assoc($fire);

      if (!isset($datas['eu_img_link']) || !file_exists($datas['eu_img_link'])) {
        $datas['eu_img_link']="../uploads/default_image.png";
      }

      $reads = '<img src="'.$datas['eu_img_link'].'">
                <h4>Welcome '.$datas['eu_first_name'].'</h4>';      
  }
  $reads .='<a href="profile">View Profile</a>';
  echo $reads;
}





/************************************__ get count __*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readcount'])) {

  $query = "SELECT * FROM expert_user_notify WHERE status=0 AND dept_id='".$_SESSION['dept_id']."'";

  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  $counts = mysqli_num_rows($fire);

  if ($counts!=0) {

    $reads = '<span class="counter_side_noti">
                <p>'.$counts.'</p>
              </span>';
    echo $reads;
  }
}





/*************************************_____Get notifications________**************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readnotify'])) {

  $query_new = "SELECT * FROM expert_user_notify WHERE status=0 AND dept_id='".$_SESSION['dept_id']."'";

  $fire_new  = mysqli_query($con,$query_new) or die("can not show data from database".mysqli_error($con));

  $count = mysqli_num_rows($fire_new);

  if ($count==0) {
    $records = '<i class="fas fa-bell" class="noti_bell" onclick="show_notification()"></i>

              <div class="drop_noti" id="notification">
                <div class="noti_heading_btn">
                  <h6>Notifications</h6>
                </div>';
    
  }else{
    $records = '<span class="counter">
                <p>'.$count.'</p>
              </span>
              <i class="fas fa-bell" class="noti_bell" onclick="show_notification()"></i>

              <div class="drop_noti" id="notification">
                <div class="noti_heading_btn">
                  <h6>Notifications</h6>
                  <a type="button" onclick="readAll()">Read all</a>
                </div>';

  }
  
  

  $query = "SELECT * FROM expert_user_notify WHERE dept_id='".$_SESSION['dept_id']."' ORDER BY notify_id DESC LIMIT 3";

  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

      while ($notify = mysqli_fetch_assoc($fire)) {

        $time=time_ago($notify['created_at']);
        
        if ($notify['notify_from']==0) {

          $records .='<div onclick="markRead('.$notify['notify_id'].')" class="notification">
                                <div class="alert_icon">  
                                    <i class="noti_side_icon fa fa-user"></i>
                                    <h3>'.$notify['notify_title'].'..</h3>
                                </div>
                                <div class="noti_content">
                                    <h5>From Department Admin</h5>
                                    <p>'.$notify['notify_message'].'</p>
                                    <div class="alert-time">'.$time.'</div>
                                </div>
                      </div>
                      <hr>';
        }else{
          //$id = $notify['notify_from'];
          //$q  = "SELECT clg_name FROM college WHERE clg_id= '$id'";
          //$f  = mysqli_query($con,$q) or die("can not show data from database".mysqli_error($con));
          //$noti = mysqli_fetch_array($f);
            
          $records .='<div onclick="markRead('.$notify['notify_id'].')" class="notification">
                        <div class="alert_icon">  
                          <i class="noti_side_icon fa fa-user"></i>
                          <h3>'.$notify['notify_title'].'...</h3>
                        </div>
                        <div class="noti_content">
                          
                          <h5>From College Admin</h5>
                          <p>'.$notify['notify_message'].'</p>
                          <div class="alert-time">'.$time.'</div>
                        </div>
                      </div>
                      <hr>';
        }
    }
  }else{
    $records .='<div class="notification">
                        <div class="alert_icon">
                          <i class="noti_side_icon fa fa-frown"></i>
                          <h3>Oops</h3>
                          </div>
                          <div class="noti_content">
                            <p>No Notifications Available</p>
                          </div>
                      </div>
                      <hr>';
  }
  $records .='<a href="notifications">View all notifications</a>

                </div>';
  echo $records;
}






/***************************_______ Read All Notifications ________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readall'])) {

  $query = "SELECT * FROM expert_user_notify WHERE status=0 AND dept_id='".$_SESSION['dept_id']."'";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

    $query ="UPDATE expert_user_notify SET status=1 WHERE status=0 AND dept_id='".$_SESSION['dept_id']."'";

    $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

      if ($fire) {          
        $ms = array("icon"=>"success", "title"=>"Done", "text"=>"Successfully read all notifications !");
        echo json_encode($ms);
      }else{    
        $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong !");    
        echo json_encode($ms);
      }
  }else{         
    $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"No notifications available to read !");
    echo json_encode($ms);
  }
}





/***************************_______Mark as Read ________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['markread'])) {

  if (isset($_POST['id'])) {

    $id=mysqli_real_escape_string($con,trim($_POST['id']));

    $query = "SELECT * FROM expert_user_notify WHERE notify_id='$id' AND dept_id='".$_SESSION['dept_id']."'";
    $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

    if (mysqli_num_rows($fire)>0) {

      $row = mysqli_fetch_assoc($fire);

      if ($row['status']==0) {

        $query ="UPDATE expert_user_notify SET status=1 WHERE notify_id='$id' AND dept_id='".$_SESSION['dept_id']."'";

        $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

          if ($fire) {
            $response['status']=200;
            $response['message']="Request completed!";           
            echo json_encode($response);
          }else{
            $response['status']=200;
            $response['message']="Something went wrong!";               
            echo json_encode($response);
          }
      }
    
    }else{
      $response['status']=200;
      $response['message']="Invalid Request!";
      echo json_encode($response);         
    }
  }else{
    $response['status']=200;
    $response['message']="Invalid Request!";
    echo json_encode($response);
  }
}