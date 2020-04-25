<?php require "../config/config.php";
session_start();

//check if super admin already logged in
if (!isset($_SESSION['is_ca_login'])) {   
    //keep on the login page
}else{
    header("Location: home");
}
?>
<?php
extract($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
  
    if (isset($_POST['clg_admin_email']) && isset($_POST['clg_admin_password'])) {
          
        $clg_admin_email     = mysqli_real_escape_string($con,trim($_POST['clg_admin_email']));
        $clg_admin_password  = mysqli_real_escape_string($con,md5(trim($_POST['clg_admin_password'])));

        $query = "SELECT * FROM college_admin WHERE clg_admin_email ='$clg_admin_email' AND clg_admin_password ='$clg_admin_password'";
        $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

        if ($fire) {
            
          if (mysqli_num_rows($fire) == 1) {

            if ($_POST['testing']==0) {
                $cookie_name = "clg_email";
                $cookie_value = $clg_admin_email;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
            }else if ($_POST['testing']==1) {
                $cookie_name = "clg_email";
                $cookie_value = "";
                setcookie($cookie_name, $cookie_value, time() - (86400 * 30), "/"); // 86400 = 1 day
            }

            $_SESSION['is_ca_login']  = true;
            
            $row = mysqli_fetch_assoc($fire);
    
            $_SESSION['clg_admin_id']         = $row['clg_admin_id'];
            $_SESSION['clg_admin_first_name'] = $row['clg_admin_first_name'];
            $_SESSION['clg_admin_last_name']  = $row['clg_admin_last_name'];
            $_SESSION['clg_admin_email']      = $row['clg_admin_email'];
            $_SESSION['clg_admin_mobile']     = $row['clg_admin_mobile'];
            $_SESSION['clg_admin_img_link']   = $row['clg_admin_img_link'];
            $_SESSION['clg_id']               = $row['clg_id'];

            $query = "SELECT * FROM college WHERE clg_id='".$_SESSION['clg_id']."'";
            $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

            if (mysqli_num_rows($fire)>0) {
                $clg = mysqli_fetch_assoc($fire);
                $_SESSION['clg_name'] = $clg['clg_name'];
            }

            $m = array("icon"=>"success", "title"=>"Done", "text"=>"You Are Successfully Logged In!");    
            echo json_encode($m);
          }else{
              $m = array("icon"=>"error", "title"=>"Oops", "timer"=>1500, "text"=>"Invalid Email or Password!");    
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