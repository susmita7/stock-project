<?php require "../config/config.php"; 
  session_start();
  
  // check if super admin logged in or not
  if ($_SESSION['is_da_login']) {  
    //keep user on page
  }else{
    //redirect on loginpage
    header("Location: ../choose") ;
  }

extract($_POST);

date_default_timezone_set("Asia/kolkata");



/*_________________________________ Get all notifications _______________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readallnotifications'])) {

  $query = "SELECT * FROM dept_admin_notify WHERE dept_id='".$_SESSION['dept_id']."' ORDER BY notify_id DESC";

  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

    while ($notification = mysqli_fetch_assoc($fire)) {

      /*----------------------------------- first portion -----------------------------------*/

      $records = '<div class="base_notofication" id="mydiv">
                    <div class="from">';

      //check if notification is from expert_user or clg_admin

      if ($notification['notify_from']==0) {
                  
        //get the dept name to show

        $query_new = "SELECT * FROM department WHERE dept_id='".$_SESSION['dept_id']."'";

        $fire_new  = mysqli_query($con,$query_new) or die("can not show data from database".mysqli_error($con));

        $dn = mysqli_fetch_assoc($fire_new);

        $records .='<h5>'.$dn['dept_name'].'</h5>';
      }else{

        //get the clg name to show

        $id = $notification['notify_from'];
        $q  = "SELECT clg_name FROM college WHERE clg_id= '$id'";
        $f  = mysqli_query($con,$q) or die("can not show data from database".mysqli_error($con));
        $noti = mysqli_fetch_array($f);

        $records .='<h5>'.$noti['clg_name'].'</h5>';
      }

      /*------------------------------------- middle portion -------------------------------------*/

      $records .='</div>
                    <div class="description">
                        
                      <div class="title">
                        <i class="fas fa-bell"></i>
                        <h6>'.$notification['notify_title'].'</h6>
                      </div>

                      <p>'.$notification['notify_message'].'</p>';

      if ($notification['notify_from']==0) {
                        
        $records .='<p>Requirements : '.$notification['notify_quantity'].' '.$notification['notify_unit'].' of '.$notification['notify_item'].'</p>';
      }

                      

      $records .='<div class="time_date">';

       if ($notification['correct']==1) {
        $records .='<h5>Status : Edited</h5>';
       }else{
        $records .='<h5></h5>';
       }

                $formatInput = 'Y-m-j H:i:s'; //database date format
                $dateInput = $notification['created_at']; //date from database

                $formatOut = 'jS F Y, h:i A';

                //$formatOut = 'j-m-Y h:i:s'; // convert to this format
                $dateOut = DateTime::createFromFormat($formatInput, $dateInput)->format($formatOut);

      $records .='<h4>'.$dateOut.'</h4>
                    </div>
                  </div>';

      /*------------------------------- last portion ---------------------------------*/

      if ($notification['approve']==-1 && $notification['verify']==0 && $notification['forward']==0) {
          
        $records .='<div class="status">
                      <i class="fa fa-ban"></i>
                      <h5>Denied</h5>
                    </div>';
          
      }else if ($notification['approve']==1 && $notification['verify']==0 && $notification['forward']==0) {
          
        $records .='<div class="status">
                      <i class="fas fa-check-square"></i>
                      <h5>Approved</h5>
                    </div>';  
      
      }else if ($notification['verify']==-1 && $notification['forward']==0 && $notification['approve']==0) {

        $records .='<div class="status">
                    <i class="far fa-window-close"></i>
                      <h5>Cancelled</h5>
                    </div>';

      }else if ($notification['verify']==1 && $notification['forward']==0 && $notification['approve']==0) {
          
        $records .='<div class="btns">
                      <a type="button" class="noti_btn4" onclick="getForward('.$notification['notify_id'].')">Forward</a>
                    </div>';
        
      }else if ($notification['verify']==1 && $notification['forward']==1 && $notification['approve']==0) {
                        
        $records .='<div class="status">
                      <i class="fa fa-check-circle"></i>
                      <h5>Forwarded</h5>
                    </div>';
        
      }else if ($notification['verify']==0 && $notification['forward']==0 && $notification['approve']==0) {

        $records .='<div class="btns">
                      <a type="button" class="noti_btn1" onclick="getVerify('.$notification['notify_id'].')">Verify</a>

                      <a type="button" class="noti_btn2" onclick="getEdit('.$notification['notify_id'].')">Edit</a>
                        
                      <a type="button" class="noti_btn3" onclick="getCancel('.$notification['notify_id'].')">Cancel</a>
                    </div>';
      }

      $records .='</div>';

      echo $records;

    } // end of while loop
  }else{
    // if no notifications available
    $records = '<div class="base_notofication">
                  <div class="description">
                    <center>No Notifications Available</center>
                  </div>
                </div>';
      echo $records;
  } 
}





/*_______________________________________   request cancellation  __________________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancel'])){

  $cancelid = mysqli_real_escape_string($con,trim($_POST['cancelid']));

  $q="SELECT * FROM dept_admin_notify WHERE notify_id='$cancelid'";
  $f=mysqli_query($con,$q) or die("can not access data .".mysqli_error($con));

  if ($f) {
      
    if (mysqli_num_rows($f)>0) {
    
      $query ="UPDATE `dept_admin_notify` SET `status`=1,`verify`=-1 WHERE `notify_id`='$cancelid'";

      $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

      if ($fire) {

        $query_n ="SELECT * FROM `dept_admin_notify` WHERE `notify_id`='$cancelid'";
        $fire_n = mysqli_query($con,$query_n) or die("can not update data .".mysqli_error($con));

        if ($fire_n) {
              
          $nt=mysqli_fetch_assoc($fire_n);  
          
          $created_at=date("Y-m-j H:i:s");
          $notify_title= "Request cancellation";
          $notify_title= ucwords(strtolower($notify_title));

          $notify_message="Your request for stock to order ".$nt['notify_quantity']." ".$nt['notify_unit']." of ".$nt['notify_item']." has been cancelled by Department Admin of ".$_SESSION['dept_name']." department";

          $notify_item=$nt['notify_item'];
          $notify_unit=$nt['notify_unit'];
          $notify_quantity=$nt['notify_quantity'];

          $correct=$nt['correct'];
          $action=$nt['verify'];

          $notify_type=1;
          $dept_id=$_SESSION['dept_id'];

          $query_new = "INSERT INTO `expert_user_notify`(`created_at`, `notify_title`, `notify_message`, `notify_item`, `notify_unit`, `notify_quantity`, `notify_type`, `correct`, `action`, `dept_id`) VALUES ('$created_at','$notify_title','$notify_message','$notify_item','$notify_unit','$notify_quantity','$notify_type','$correct','$action','$dept_id')";

          $fire_new = mysqli_query($con,$query_new) or die("can not insert data into database. ".mysqli_error($con));

          if ($fire_new) {

            //add to activity

            $created_at= date("Y-m-d H:i:s");
            $activity_type= "notification";
            $activity_body= "You have Cancelled the request for stock to order  ".$notify_quantity." ".$notify_unit." of ".$notify_item." from Expert User : ".$_SESSION['dept_name'].".";
              
            $dept_admin_id=$_SESSION['dept_admin_id'];

            $query_n = "INSERT INTO `dept_admin_activity`(`created_at`, `activity_type`, `activity_body`, `dept_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$dept_admin_id')";

            $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

            if ($fire_n) {
              $m = array("icon"=>"success", "title"=>"Done", "text"=>"Request has been cancelled!");
              echo json_encode($m);
            }else{
              $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
              echo json_encode($m);
            }  
          }else{
            $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
            echo json_encode($m);
          }
        }else{
          $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
          echo json_encode($m);
        }  
      }else{
        $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
        echo json_encode($m);
      }
    }else{
      $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Data not found!");
      echo json_encode($m);
    }
  }else{
    $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");
    echo json_encode($m);
  }  
}





/*******************************______ get request id nd send details _____*******************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eid'])){

  if (!empty($_POST['eid'])) {
    
    $eid=mysqli_real_escape_string($con,trim($_POST['eid']));

    $query = "SELECT * FROM dept_admin_notify WHERE notify_id ='$eid'";

    $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

    if ($fire) {
        
      $response= array();

      if (mysqli_num_rows($fire) > 0) {
        while ($row = mysqli_fetch_assoc($fire)) {
          $response = $row;
        }
      }else{
        $response['status']=200;
        $response['message']="Data Not Found!";
      }
    }
    echo json_encode($response);
  }else{
    $response['status']=200;
    $response['message']="Invalid Request!";
  }
}else{
  $response['status']=200;
  $response['message']="Invalid Request!";
}



/*****************____________________   request edit  __________________*****************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])){

  $edit_id = mysqli_real_escape_string($con,trim($_POST['edit_id']));
  $edit_quantity = mysqli_real_escape_string($con,trim($_POST['edit_quantity']));

  $q="SELECT * FROM dept_admin_notify WHERE notify_id='$edit_id'";
  $f=mysqli_query($con,$q) or die("can not access data .".mysqli_error($con));

  if ($f) {
      
    if (mysqli_num_rows($f)>0) {

      $ed=mysqli_fetch_assoc($f);
    
      $query ="UPDATE `dept_admin_notify` SET `status`=1,`correct`=1,`notify_quantity`='$edit_quantity' WHERE `notify_id`='$edit_id'";

      $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

      if ($fire) {

        //add to activity

        $created_at= date("Y-m-d H:i:s");
        $activity_type= "notification";
        $activity_body= "You have Edited the request for stock to order ".$ed['notify_quantity']." ".$ed['notify_unit']." of ".$ed['notify_item']." to : ".$edit_quantity." ".$ed['notify_unit']." of ".$ed['notify_item'].".";
              
        $dept_admin_id=$_SESSION['dept_admin_id'];

        $query_n = "INSERT INTO `dept_admin_activity`(`created_at`, `activity_type`, `activity_body`, `dept_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$dept_admin_id')";

        $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

        if ($fire_n) {
          $m = array("icon"=>"success", "title"=>"Done", "text"=>"Request has been successfully edited!");
          echo json_encode($m);
        }else{
          $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
        echo json_encode($m);
        }  
      }else{
        $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
        echo json_encode($m);
      }  
    }else{
      $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Data not found!");
      echo json_encode($m);
    }
  }else{
    $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");
    echo json_encode($m);
  }  
}





/*****************____________________   request verify  __________________*****************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verify'])){

  $verify_id = mysqli_real_escape_string($con,trim($_POST['verify_id']));

  $q="SELECT * FROM dept_admin_notify WHERE notify_id='$verify_id'";
  $f=mysqli_query($con,$q) or die("can not access data .".mysqli_error($con));

  if ($f) {
      
    if (mysqli_num_rows($f)>0) {
    
      $query ="UPDATE `dept_admin_notify` SET `status`=1,`verify`=1 WHERE `notify_id`='$verify_id'";

      $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

      if ($fire) {

        $query_n ="SELECT * FROM `dept_admin_notify` WHERE `notify_id`='$verify_id'";

        $fire_n = mysqli_query($con,$query_n) or die("can not update data .".mysqli_error($con));

        if ($fire_n) {
              
          $v=mysqli_fetch_assoc($fire_n);

          $created_at=date("Y-m-j H:i:s");

          $notify_title= "Request Verified";
          $notify_title= ucwords(strtolower($notify_title));

          $notify_message="Your request for stock to order ".$v['notify_quantity']." ".$v['notify_unit']." of ".$v['notify_item']." has been verified by Department Admin of ".$_SESSION['dept_name']." department. The request will be forwarded to the College Admin by the Department Admin very soon!";

          $notify_item=$v['notify_item'];
          $notify_unit=$v['notify_unit'];
          $notify_quantity=$v['notify_quantity'];

          $correct=$v['correct'];
          $action=$v['verify'];

          $notify_type=1;
          $dept_id=$_SESSION['dept_id'];

          $query_new = "INSERT INTO `expert_user_notify`(`created_at`, `notify_title`, `notify_message`, `notify_item`, `notify_unit`, `notify_quantity`, `notify_type`, `correct`, `action`, `dept_id`) VALUES ('$created_at','$notify_title','$notify_message','$notify_item','$notify_unit','$notify_quantity','$notify_type','$correct','$action','$dept_id')";

          $fire_new = mysqli_query($con,$query_new) or die("can not insert data into database. ".mysqli_error($con));

          if ($fire_new) {

            //add to activity

            $created_at= date("Y-m-d H:i:s");
            $activity_type= "notification";
            $activity_body= "You have Verified the request for stock to order  ".$notify_quantity." ".$notify_unit." of ".$notify_item." from Expert User : ".$_SESSION['dept_name'].".";
              
            $dept_admin_id=$_SESSION['dept_admin_id'];

            $query_n = "INSERT INTO `dept_admin_activity`(`created_at`, `activity_type`, `activity_body`, `dept_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$dept_admin_id')";

            $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

            if ($fire_n) {
              $m = array("icon"=>"success", "title"=>"Done", "text"=>"Request has been verified!");
              echo json_encode($m);
            }else{
              $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
              echo json_encode($m);
            }  
          }else{
            $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
            echo json_encode($m);
          }
        }else{
          $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
          echo json_encode($m);
        }
      }else{
        $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
        echo json_encode($m);
      }  
    }else{
      $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Data not found!");
      echo json_encode($m);
    }
  }else{
    $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");
    echo json_encode($m);
  }  
}





/*************____________________   forward the verified request  __________________*****************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['forward'])){

  $forward_id = mysqli_real_escape_string($con,trim($_POST['forward_id']));

  $q="SELECT * FROM dept_admin_notify WHERE notify_id='$forward_id'";
  $f=mysqli_query($con,$q) or die("can not access data .".mysqli_error($con));

  if ($f) {
      
    if (mysqli_num_rows($f)>0) {

      $fr=mysqli_fetch_assoc($f);
    
      $query ="UPDATE `dept_admin_notify` SET `forward`=1 WHERE `notify_id`='$forward_id'";

      $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

      if ($fire) {

        $created_at=date("Y-m-j H:i:s");

        $notify_title= "Request For Approval";
        $notify_title= ucwords(strtolower($notify_title));

        $notify_message=$fr['notify_message'];

        $notify_item=$fr['notify_item'];
        $notify_unit=$fr['notify_unit'];
        $notify_quantity=$fr['notify_quantity'];

        $verify=$fr['verify'];

        $notify_type=1;
        $clg_id=$_SESSION['clg_id'];
        $notify_from=$_SESSION['dept_id'];

        $query_new = "INSERT INTO `clg_admin_notify`(`created_at`, `notify_title`, `notify_message`, `notify_item`, `notify_unit`, `notify_quantity`, `notify_from`, `notify_type`, `verify`, `clg_id`) VALUES ('$created_at','$notify_title','$notify_message','$notify_item','$notify_unit','$notify_quantity','$notify_from','$notify_type','$verify','$clg_id')";

        $fire_new = mysqli_query($con,$query_new) or die("can not insert data.".mysqli_error($con));

        if ($fire_new) {

          //add to activity

          $created_at= date("Y-m-d H:i:s");
          $activity_type= "notification";
          $activity_body= "You have Forwarded the request from Expert User for stock to order : ".$notify_quantity." ".$notify_unit." of ".$notify_item.".";
              
          $dept_admin_id=$_SESSION['dept_admin_id'];

          $query_n = "INSERT INTO `dept_admin_activity`(`created_at`, `activity_type`, `activity_body`, `dept_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$dept_admin_id')";

          $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

          if ($fire_n) {
            $m = array("icon"=>"success", "title"=>"Done", "text"=>"Request has been forwarded!");
            echo json_encode($m);
          }else{
            $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
            echo json_encode($m);
          }
        }else{
          $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
          echo json_encode($m);
        }
      }else{
        $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
        echo json_encode($m);
      }  
    }else{
      $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Data not found!");
      echo json_encode($m);
    }
  }else{
    $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");
    echo json_encode($m);
  }  
}