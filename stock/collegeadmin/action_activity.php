<?php require "../config/config.php"; 
  session_start();
  
  // check if clg admin logged in or not
  if ($_SESSION['is_ca_login']) {  
    //keep user on page
  }else{
    //redirect on loginpage
    header("Location: login");
  }

extract($_POST);

date_default_timezone_set("Asia/kolkata");


/*************************************________  Get all activities  ________****************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readactivities'])) {

  $query = "SELECT * FROM clg_admin_activity WHERE clg_admin_id='".$_SESSION['clg_admin_id']."' ORDER BY activity_id DESC";

  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

    while ($activity = mysqli_fetch_assoc($fire)) {

      /*----------------------------------- first portion -----------------------------------*/

      $records = '<div class="base_ac" id="mydiv">
                    <div class="suc_icon">';

      //check activity is of which type

      if ($activity['activity_type']=="profile") {
        $records .='<i class="fas fa-user"></i>';
      }elseif ($activity['activity_type']=="deptadmin") {
        $records .='<i class="fas fa-user-lock"></i>';
      }elseif ($activity['activity_type']=="firm") {
        $records .='<i class="fa fa-building"></i>';
      }elseif ($activity['activity_type']=="department") {
        $records .='<i class="fas fa-book"></i>';
      }elseif ($activity['activity_type']=="password") {
        $records .='<i class="fas fa-unlock-alt"></i>';
      }elseif ($activity['activity_type']=="notification") {
        $records .='<i class="fa fa-bell"></i>';
      }

      /*------------------------------------- middle portion -------------------------------------*/

      $records .='</div>
                  
                  <div class="ac">
                    <p>'.$activity['activity_body'].'</p>';

                    if ($activity['other']!=null) {
                      $records .='<p>'.$activity['other'].'</p>';
                    }
      $records .='<div class="time_date">';
               
      $formatInput = 'Y-m-j H:i:s'; //database date format
      $dateInput = $activity['created_at']; //date from database

      $formatOut = 'jS F Y, h:i A';
      //$formatOut = 'j-m-Y h:i:s'; // convert to this format
      $dateOut = DateTime::createFromFormat($formatInput, $dateInput)->format($formatOut);

      $records .='<h4><i class="far fa-clock"></i> '.$dateOut.'</h4>
                    </div>
                  </div>';

      /*------------------------------- last portion ---------------------------------*/

      $records .='<div class="ac_del">
                    <a id="del" type="button" onclick="getClear('.$activity['activity_id'].')">Clear</a>
                  </div>
                </div>';
      echo $records;
    }
  }else{

    // no activities available
    $records = '<div class="base_ac">
                  <div class="ac">
                    <center>No Activities Available</center>
                  </div>
                </div>';
    echo $records;
  } 
}





/***************************************________  clear activity  ________***********************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['clear'])){

  if (!empty($_POST['delid'])) {

    $delid = mysqli_real_escape_string($con,trim($_POST['delid']));
    
    $query ="DELETE FROM clg_admin_activity WHERE activity_id='$delid'";

    $fire = mysqli_query($con,$query) or die("can not delete data .".mysqli_error($con));

    if ($fire) {
      $m = array("icon"=>"success", "title"=>"Done", "text"=>"Activity cleared successfully!");
      echo json_encode($m);
    }else{
      $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
      echo json_encode($m);
    }  
  }else{
    $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Id cannot be empty!");
    echo json_encode($m);
  }
}





/********************************________  clear All Activities  ________**************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['clearall'])) {

  $clg_admin_id=mysqli_real_escape_string($con,trim($_SESSION['clg_admin_id']));

  $query = "SELECT * FROM clg_admin_activity WHERE clg_admin_id='$clg_admin_id'";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

    $query ="DELETE FROM clg_admin_activity WHERE clg_admin_id='$clg_admin_id'";

    $fire = mysqli_query($con,$query) or die("can not delete data .".mysqli_error($con));

    if ($fire) {          
        $ms = array("icon"=>"success", "title"=>"Done", "text"=>"Successfully cleared all activities!");
        echo json_encode($ms);
    }else{    
        $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
        echo json_encode($ms);
    }
  }else{         
    $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"No activities available!");
    echo json_encode($ms);
  }
}