<?php require "../config/config.php";?>
<?php
session_start();

//check if department admin already logged in
if (!isset($_SESSION['is_eu_login'])) {   
    //keep on the login page
}else{
    header("Location: home");
}
?>
<?php
extract($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
  
    if (isset($_POST['eu_email']) && isset($_POST['eu_password'])) {
          
        $eu_email     = mysqli_real_escape_string($con,trim($_POST['eu_email']));
        $eu_password  = mysqli_real_escape_string($con,md5(trim($_POST['eu_password'])));

        $query = "SELECT * FROM expert_user WHERE eu_email ='$eu_email' AND eu_password ='$eu_password'";
        $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

        if ($fire) {
            
          if (mysqli_num_rows($fire) == 1) {

            if ($_POST['test']==0) {
                $cookie_name = "exprt_email";
                $cookie_value = $eu_email;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
            }else if ($_POST['test']==1) {
                $cookie_name = "exprt_email";
                $cookie_value = "";
                setcookie($cookie_name, $cookie_value, time() - (86400 * 30), "/"); // 86400 = 1 day
            }

            $_SESSION['is_eu_login']  = true;
            
            $row = mysqli_fetch_assoc($fire);
    
            $_SESSION['eu_id']         = $row['eu_id'];
            $_SESSION['eu_first_name'] = $row['eu_first_name'];
            $_SESSION['eu_last_name']  = $row['eu_last_name'];
            $_SESSION['eu_email']      = $row['eu_email'];
            $_SESSION['eu_mobile']     = $row['eu_mobile'];
            $_SESSION['eu_img_link']   = $row['eu_img_link'];
            $_SESSION['clg_id']        = $row['clg_id'];
            $_SESSION['dept_id']       = $row['dept_id'];

            $query = "SELECT * FROM college WHERE clg_id='".$_SESSION['clg_id']."'";
            $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

            if (mysqli_num_rows($fire)>0) {
                $clg = mysqli_fetch_assoc($fire);
                $_SESSION['clg_name'] = $clg['clg_name'];
            }

            $query = "SELECT * FROM department WHERE dept_id='".$_SESSION['dept_id']."'";
            $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

            if (mysqli_num_rows($fire)>0) {
                $dept = mysqli_fetch_assoc($fire);
                $_SESSION['dept_name'] = $dept['dept_name'];
            }

            $m = array("icon"=>"success", "title"=>"Done", "text"=>"You Are Successfully Logged In!");    
            echo json_encode($m);
          }else{
              $m = array("icon"=>"error", "title"=>"Oops", "timer"=>1300, "text"=>"Invalid Email or Password!");    
              echo json_encode($m);
          }
        }else{
            $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
            echo json_encode($m);
        }
    }else{
      $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Email ID And Password Cannot Be Empty!");    
      echo json_encode($m);
    } 
}