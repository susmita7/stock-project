<?php require "../config/config.php"; 
  session_start();
  
  // check if clg admin logged in or not
  if ($_SESSION['is_ca_login']) {  
    //keep user on page
  }else{
    //redirect on loginpage
    header("Location: login") ;
  }

extract($_POST);

date_default_timezone_set("Asia/kolkata");



/************************_____Get all notifications________*********************************/

if (isset($_POST['readallnotifications'])) {

  $query = "SELECT * FROM clg_admin_notify WHERE clg_id='".$_SESSION['clg_id']."' ORDER BY notify_id DESC";

  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

    while ($notification = mysqli_fetch_assoc($fire)) {

      /*----------------------------------- first portion -----------------------------------*/

      $records = '<div class="base_notofication" id="mydiv">
                    <div class="from">';

      //check if notification is from department or sup_admin

      if ($notification['notify_from']!=0) {
                  
        //get the dept name to show

        $query_new = "SELECT * FROM department WHERE dept_id='".$notification['notify_from']."'";

        $fire_new  = mysqli_query($con,$query_new) or die("can not show data from database".mysqli_error($con));

        $cn = mysqli_fetch_assoc($fire_new);

        $records .='<h5>'.$cn['dept_name'].'</h5>';
        
      }else{

        //get the sup name to show

        $records .='<h5>Super Admin</h5>';
      }

      /*------------------------------------- middle portion -------------------------------------*/

      $records .='</div>
                    <div class="description">
                        
                      <div class="title">
                        <i class="fas fa-bell"></i>
                        <h6>'.$notification['notify_title'].'</h6>
                      </div>

                      <p>'.$notification['notify_message'].'.</p>';

        if ($notification['notify_from']!=0) {

      $records .='<p>Requirements : '.$notification['notify_quantity'].' '.$notification['notify_unit'].' of '.$notification['notify_item'].'</p>';
        }

      $records .='<div class="time_date">';

        if ($notification['correct']==1 && $notification['verify']==1) {
          $records .='<h5>Status : Verified (Edited)<h5>';
        }else if ($notification['correct']==0 && $notification['verify']==1) {
          $records .='<h6>Status : Verified <h6>';
        }elseif ($notification['correct']==1 && $notification['verify']==0) {
          $records .='<h5>Status : Edited<h5>'; 
        }else{
          $records .='<h5><h5>';
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

      if ($notification['approve']==-1) {

        $records .='<div class="status">
                      <i class="fas fa-window-close"></i>
                      <h5>Denied</h5>
                    </div>';
      
      }else if ($notification['approve']==1) {
                        
        $records .='<div class="status">
                      <i class="fas fa-check-square"></i>
                      <h5>Approved</h5>
                    </div>';
      }else if ($notification['approve']==0 && $notification['notify_from']!=0) {

        $records .='<div class="btns">
                      <a type="button" class="noti_btn1" onclick="getApprove('.$notification['notify_id'].')">Approve</a>

                      <a type="button" class="noti_btn2" onclick="getEdit('.$notification['notify_id'].')">Edit</a>
                        
                      <a type="button" class="noti_btn3" onclick="getDeny('.$notification['notify_id'].')">Deny</a>
                    </div>';
      }else{

        if ($notification['status']==0) {
          $records .='<div class="status">
                      <i class="fa fa-eye-slash"></i>
                      <h5>Unread</h5>
                    </div>';
        }else{
          $records .='<div class="status">
                      <i class="fa fa-eye"></i>
                      <h5>Read</h5>
                    </div>';
        }
        
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





/*****************____________________   request denial  __________________*****************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deny'])){


  $denyid = mysqli_real_escape_string($con,trim($_POST['denyid']));

  $q="SELECT * FROM clg_admin_notify WHERE notify_id='$denyid'";
  $f=mysqli_query($con,$q) or die("can not access data .".mysqli_error($con));

  if ($f) {
      
    if (mysqli_num_rows($f)>0) {
    
      $query ="UPDATE `clg_admin_notify` SET `status`=1,`approve`=-1 WHERE `notify_id`='$denyid'";

      $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

      if ($fire) {

        $query_ne="SELECT * FROM clg_admin_notify WHERE notify_id='$denyid'";
        $fire_ne=mysqli_query($con,$query_ne) or die("can not access data .".mysqli_error($con));

        if ($fire_ne) {

          $nt=mysqli_fetch_assoc($fire_ne);

          $created_at=date("Y-m-j H:i:s");

          $notify_title= "Request Denied";
          $notify_title= ucwords(strtolower($notify_title));

          $notify_message="Your verified request for stock to order ".$nt['notify_quantity']." ".$nt['notify_unit']." of ".$nt['notify_item']." has been denied by College Admin of ".$_SESSION['clg_name'].".";

          $notify_item=$nt['notify_item'];
          $notify_unit=$nt['notify_unit'];
          $notify_quantity=$nt['notify_quantity'];

          $correct=$nt['correct'];
          $approve=$nt['approve'];

          $notify_type=1;
          $dept_id=$nt['notify_from'];
          $notify_from=$_SESSION['clg_id'];

          $query_new = "INSERT INTO `expert_user_notify`(`created_at`, `notify_title`, `notify_message`, `notify_item`, `notify_unit`, `notify_quantity`, `notify_type`, `notify_from`, `correct`, `approve`, `dept_id`) VALUES ('$created_at','$notify_title','$notify_message','$notify_item','$notify_unit','$notify_quantity','$notify_type','$notify_from','$correct','$approve','$dept_id')";

          $fire_new = mysqli_query($con,$query_new) or die("can not insert data into database. ".mysqli_error($con));


          $query_n = "INSERT INTO `dept_admin_notify`(`created_at`, `notify_title`, `notify_message`, `notify_item`, `notify_unit`, `notify_quantity`, `notify_type`, `notify_from`, `correct`, `approve`, `dept_id`) VALUES ('$created_at','$notify_title','$notify_message','$notify_item','$notify_unit','$notify_quantity','$notify_type','$notify_from','$correct','$approve','$dept_id')";

          $fire_n = mysqli_query($con,$query_n) or die("can not insert data into database. ".mysqli_error($con));

          if ($fire_n) {

            $query ="SELECT * FROM `department` WHERE `dept_id`=$dept_id";
            $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));
            $dept = mysqli_fetch_assoc($fire);

            //add to history

            $created_at= date("Y-m-d H:i:s");
            $activity_type= "notification";
            $activity_body= "You have Denied the request from department : ".$dept['dept_name']." for stock to order ".$notify_quantity." ".$notify_unit." of ".$notify_item.".";
  
            $clg_admin_id=$_SESSION['clg_admin_id'];

            $q = "INSERT INTO `clg_admin_activity`(`created_at`, `activity_type`, `activity_body`, `clg_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$clg_admin_id')";

            $f = mysqli_query($con,$q) or die("can not insert data. ".mysqli_error($con));

            if ($f) {
              $m = array("icon"=>"success", "title"=>"Done", "text"=>"Request has been denied!");
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
      $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Invalid request!");
      echo json_encode($m);
    }
  }else{
    $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");
    echo json_encode($m);
  }  
}





/********************______ get request id nd send details _____***********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eid'])) {

  if (!empty($_POST['eid'])) {
  
    $eid=mysqli_real_escape_string($con,trim($_POST['eid']));

    $query = "SELECT * FROM clg_admin_notify WHERE notify_id ='$eid'";

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

  $q="SELECT * FROM clg_admin_notify WHERE notify_id='$edit_id'";
  $f=mysqli_query($con,$q) or die("can not access data .".mysqli_error($con));
    
  if (mysqli_num_rows($f)>0) {

    $ed=mysqli_fetch_assoc($f);
    
    $query ="UPDATE `clg_admin_notify` SET `status`=1,`correct`=1,`notify_quantity`='$edit_quantity' WHERE `notify_id`='$edit_id'";

    $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

    if ($fire) {

      $dept_id = $ed['notify_from'];

      $query ="SELECT * FROM `department` WHERE `dept_id`=$dept_id";
      $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));
      $dept = mysqli_fetch_assoc($fire);

      //add to history

      $created_at= date("Y-m-d H:i:s");
      $activity_type= "notification";
      $activity_body= "You have Edited the request from department : ".$dept['dept_name']." to order ".$ed['notify_quantity']." ".$ed['notify_unit']." of ".$ed['notify_item']." to : ".$edit_quantity." ".$ed['notify_unit']." of ".$ed['notify_item'].".";
  
      $clg_admin_id=$_SESSION['clg_admin_id'];

      $q = "INSERT INTO `clg_admin_activity`(`created_at`, `activity_type`, `activity_body`, `clg_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$clg_admin_id')";

      $f = mysqli_query($con,$q) or die("can not insert data. ".mysqli_error($con));

      if ($f) {
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
}





/*****************____________________   request approve  __________________*****************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['approve'])){


  $approve_id = mysqli_real_escape_string($con,trim($_POST['approve_id']));

  $q="SELECT * FROM clg_admin_notify WHERE notify_id='$approve_id'";
  $f=mysqli_query($con,$q) or die("can not access data .".mysqli_error($con));

     
  if (mysqli_num_rows($f)>0) {
  
    $query ="UPDATE `clg_admin_notify` SET `status`=1,`approve`=1 WHERE `notify_id`='$approve_id'";

    $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

    if ($fire) {

      $query_ne="SELECT * FROM clg_admin_notify WHERE notify_id='$approve_id'";
      $fire_ne=mysqli_query($con,$query_ne) or die("can not access data .".mysqli_error($con));

      if ($fire_ne) {

        $v=mysqli_fetch_assoc($fire_ne);
        $dept_id=$v['notify_from'];

        //get Id for file upload
        $x = 1;

        do {
          //get an approve id from random function
          $order_id = mt_rand(100000,999999);

          //check if that id is exist 

          $query="SELECT * FROM file_details WHERE approved_id='$order_id' AND dept_id='$dept_id'";
          $fire=mysqli_query($con,$query);
          if (mysqli_num_rows($fire)>0) {
            $x=0;
          }else{
            $x=1;
          }
        } while ($x == 0);

        //add to activity

        $created_at=date("Y-m-j H:i:s");

        $notify_title= "Request Approval";
        $notify_title= ucwords(strtolower($notify_title));

        $notify_message="Your verified request for stock to order ".$v['notify_quantity']." ".$v['notify_unit']." of ".$v['notify_item']." has been approved by College Admin of ".$_SESSION['clg_name'].". Your Approved ID is : ".$order_id." .";

        $notify_item=$v['notify_item'];
        $notify_unit=$v['notify_unit'];
        $notify_quantity=$v['notify_quantity'];

        $correct=$v['correct'];
        $approve=$v['approve'];

        $notify_type=1;
        //$dept_id=$v['notify_from'];
        $notify_from=$_SESSION['clg_id'];

        //file table
        $query_news="INSERT INTO `file_details`(`created_at`, `approved_id`, `dept_id`) VALUES ('$created_at','$order_id','$dept_id')";

        $fire_news = mysqli_query($con,$query_news) or die("can not insert data into database. ".mysqli_error($con));

        if ($fire_news) {

          //send to EU
          $created_at=date("Y-m-j H:i:s");

          $query_new = "INSERT INTO `expert_user_notify`(`created_at`, `notify_title`, `notify_message`, `notify_item`, `notify_unit`, `notify_quantity`, `notify_type`, `notify_from`, `correct`, `approve`, `dept_id`) VALUES ('$created_at','$notify_title','$notify_message','$notify_item','$notify_unit','$notify_quantity','$notify_type','$notify_from','$correct','$approve','$dept_id')";

          $fire_new = mysqli_query($con,$query_new) or die("can not insert data into database. ".mysqli_error($con));

          
          //send to DA
          $created_at=date("Y-m-j H:i:s");

          $query_n = "INSERT INTO `dept_admin_notify`(`created_at`, `notify_title`, `notify_message`, `notify_item`, `notify_unit`, `notify_quantity`, `notify_type`, `notify_from`, `correct`, `approve`, `dept_id`) VALUES ('$created_at','$notify_title','$notify_message','$notify_item','$notify_unit','$notify_quantity','$notify_type','$notify_from','$correct','$approve','$dept_id')";

          $fire_n = mysqli_query($con,$query_n) or die("can not insert data into database. ".mysqli_error($con));

          if ($fire_n) {

            $query ="SELECT * FROM `department` WHERE `dept_id`=$dept_id";
            $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));
            $dept = mysqli_fetch_assoc($fire);

            //add to history

            $created_at= date("Y-m-d H:i:s");
            $activity_type= "notification";
            $activity_body= "You have Approved the request from department : ".$dept['dept_name']." for stock to order ".$notify_quantity." ".$notify_unit." of ".$notify_item.".";
  
            $clg_admin_id=$_SESSION['clg_admin_id'];

            $q = "INSERT INTO `clg_admin_activity`(`created_at`, `activity_type`, `activity_body`, `clg_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$clg_admin_id')";

            $f = mysqli_query($con,$q) or die("can not insert data. ".mysqli_error($con));

            if ($f) {
              $m = array("icon"=>"success", "title"=>"Done", "text"=>"Request has been successfully approved!");
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
      $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
      echo json_encode($m);
    }  
  }else{
    $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Data not found!");
    echo json_encode($m);
  }
}





/*****************____________________   send to super admin  __________________*****************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send'])){

  if (!empty($_POST['notify_from'])) {

    $notify_from = mysqli_real_escape_string($con,trim($_POST['notify_from']));
    $notify_title = mysqli_real_escape_string($con,trim($_POST['notify_title']));
    $notify_title = ucwords(strtolower($notify_title));
    $notify_message = mysqli_real_escape_string($con,trim($_POST['notify_message']));

    $createat=date('Y-m-j H:i:s');
    
    $query ="INSERT INTO `sup_admin_notify`(`created_at`, `notify_title`, `notify_message`, `notify_from`) VALUES ('$createat','$notify_title','$notify_message','$notify_from')";

    $fire = mysqli_query($con,$query) or die("can not insert data .".mysqli_error($con));

    if ($fire) {

      //add to history

      $created_at= date("Y-m-d H:i:s");
      $activity_type= "notification";
      $activity_body= "You have sent notification to Super Admin.";
      $other ="Title : ".$notify_title.". Message : ".$notify_message;
      $clg_admin_id=$_SESSION['clg_admin_id'];

      $query_n = "INSERT INTO `clg_admin_activity`(`created_at`, `activity_type`, `activity_body`, `other`, `clg_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$other','$clg_admin_id')";

      $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

      if ($fire_n) {
        $m = array("icon"=>"success", "title"=>"Done", "text"=>"Notification sent!");
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
}
