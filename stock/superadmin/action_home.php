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



/*________________________________ get counter contents of home ______________________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readcounts'])) {

	$sup_admin_id=mysqli_real_escape_string($con,trim($_SESSION["sup_admin_id"]));


  	$reads = '<div class="con_details">
                <img src="images/Group 11.png" class="fac">
                <h4>Faculties</h4>';

    $query ="SELECT * FROM `faculty`";
	//$query = "SELECT * FROM super_admin WHERE sup_admin_id=$sup_admin_id";
  	$fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  	if (mysqli_num_rows($fire)>0) {
  		$f_counter=mysqli_num_rows($fire);      
  	}else{
    	$f_counter = 0;  
  	}

  	$reads .='<h2>'.$f_counter.'</h2>
            </div>
            <div class="con_details">
                <img src="images/dept.png" class="dept">
                <h4>Colleges</h4>';
     
  	$query ="SELECT * FROM `college`";
  	//$query = "SELECT * FROM super_admin WHERE sup_admin_id=$sup_admin_id";
  	$fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  	if (mysqli_num_rows($fire)>0) {
  		$c_counter=mysqli_num_rows($fire);      
  	}else{
    	$c_counter = 0;  
  	}

  	$reads .='<h2>'.$c_counter.'</h2>
            </div>

            <div class="con_details">
                <img src="images/Group 9.png" class="ad">
                <h4>College admins</h4>';

   	$query ="SELECT * FROM `college_admin`";
    $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  	if (mysqli_num_rows($fire)>0) {
  		$ca_counter=mysqli_num_rows($fire);      
  	}else{
    	$ca_counter = 0;  
  	}

  	$reads .='<h2>'.$ca_counter.'</h2>
            </div>
            <div class="con_details">
                <img src="images/noti.png" class="notify">
                <h4>Notifications</h4>';

    $query ="SELECT * FROM `sup_admin_notify`";
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