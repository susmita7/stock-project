<?php require "../config/config.php"; 
  session_start();
  
  // check if super admin logged in or not
  if ($_SESSION['is_ca_login']) {  
    //keep user on page
  }else{
    //redirect on loginpage
    header("Location: login");
    die();
  }

extract($_POST);

date_default_timezone_set("Asia/kolkata");



/*________________________________ get counter contents of home ______________________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readcounts'])) {

  $clg_id=mysqli_real_escape_string($con,trim($_SESSION["clg_id"]));


  $reads = '<div class="con_details">
              <img src="images/dept.png" class="dept">
              <h4>Departments</h4>';

  $query ="SELECT * FROM `department` WHERE clg_id='$clg_id'";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
  	$d_counter=mysqli_num_rows($fire);      
  }else{
    $d_counter = 0;  
  }

  $reads .='<h2>'.$d_counter.'</h2>
            </div>
            <div class="con_details">
              <img src="images/Group 9.png" class="ad">
              <h4>Department admin</h4>';
     
  	$query ="SELECT * FROM `department_admin` INNER JOIN department ON department_admin.dept_id=department.dept_id WHERE clg_id=$clg_id";

  	$fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  	if (mysqli_num_rows($fire)>0) {
  		$da_counter=mysqli_num_rows($fire);      
  	}else{
    	$da_counter = 0;  
  	}

  	$reads .='<h2>'.$da_counter.'</h2>
            </div>

            <div class="con_details">
              <img src="images/firm2.png" class="firm">
              <h4>Firm details</h4>';

   	$query ="SELECT * FROM `firm` WHERE clg_id=$clg_id";
    $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  	if (mysqli_num_rows($fire)>0) {
  		$f_counter=mysqli_num_rows($fire);      
  	}else{
    	$f_counter = 0;  
  	}

  	$reads .='<h2>'.$f_counter.'</h2>
            </div>

            <div class="con_details">
              <img src="images/noti.png" class="notify">
              <h4>Notifications</h4>';

    $query ="SELECT * FROM `clg_admin_notify` WHERE clg_id=$clg_id";
    $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  	if (mysqli_num_rows($fire)>0) {
  		$n_counter=mysqli_num_rows($fire);      
  	}else{
    	$n_counter = 0;  
  	}

    $reads .='<h2>'.$n_counter.'</h2>
                    </div>';

    echo $reads;
}