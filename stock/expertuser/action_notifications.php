<?php require "../config/config.php"; 
  session_start();
  
  // check if super admin logged in or not
  if ($_SESSION['is_eu_login']) {  
    //keep user on page
  }else{
    //redirect on loginpage
    header("Location: ../choose") ;
  }

extract($_POST);

date_default_timezone_set("Asia/kolkata");

/*************************************_____Get all notifications________**************************************/

if (isset($_POST['readallnotifications'])) {

  $query = "SELECT * FROM expert_user_notify WHERE dept_id='".$_SESSION['dept_id']."' ORDER BY notify_id DESC";

  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

    while ($notification = mysqli_fetch_assoc($fire)) {

      /*------------------------------------- first part -----------------------------------------*/

      $records = '<div class="base_notofication" id="mydiv">
                    <div class="from">';

      //check if notification is from expert user

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
      
      /*--------------------------------------- middle part ------------------------------------------*/

      $records .='</div>
                    <div class="description">
                        
                      <div class="title">
                        <i class="fas fa-bell"></i>
                        <h6>'.$notification['notify_title'].'</h6>
                      </div>

                      <p>'.$notification['notify_message'].'</p>

                      <div class="time_date">';

                      if ($notification['correct']==1) {
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
                  </div>

      <!------------------------------------------ last part ------------------------------------------------->

                  <div class="status">';

                    if ($notification['action']==-1 && $notification['approve']==0) {

                      $records .='<i class="far fa-window-close"></i>
                                    <h5>Cancelled</h5>';
                    }else if ($notification['action']==1 && $notification['approve']==0) {
                         
                      $records .='<i class="fas fa-clipboard-check"></i>
                                    <h5>Verified</h5>';
                    }else if ($notification['approve']==1 && $notification['action']==0) {

                      $records .='<i class="fas fa-check-square"></i>
                                    <h5>Approved</h5>';                      
                    }else if ($notification['approve']==-1 && $notification['action']==0) {

                      //$records .='<i class="fa fa-times"></i>
                      $records .='<i class="fa fa-ban"></i>
                                    <h5>Denied</h5>';
                    }else{

                      $records .='<i class="fa fa-pause"></i>
                                  <h5>Pending</h5>';
                    }
                    
        $records .='</div>
                </div>';
      echo $records;
    } //end of while loop
  }else{
    $records = '<div class="base_notofication">
                  <div class="description">
                    <center>No Notifications Available</center>
                  </div>
                </div>';
    
    echo $records;  
  } //end of if num rows 0
}