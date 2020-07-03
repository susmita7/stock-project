<?php require "../config/config.php";
session_start();

//check if super admin already logged in
if (!isset($_SESSION['is_sa_login'])) {   
    //keep on the login page
}else{
    //echo '<script type="text/javascript"> window.location.href = "super_admin_home.php";</script>';
    header("Location: home");
    die();
}


extract($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
  
    if (isset($_POST['sup_admin_email']) && isset($_POST['sup_admin_password'])) {
          
        $sup_admin_email     = mysqli_real_escape_string($con,trim($_POST['sup_admin_email']));
        $sup_admin_password  = mysqli_real_escape_string($con,md5(trim($_POST['sup_admin_password'])));

        $query = "SELECT * FROM super_admin WHERE sup_admin_email ='$sup_admin_email' AND sup_admin_password ='$sup_admin_password'";
        $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

        if ($fire) {
            
          if (mysqli_num_rows($fire) == 1) {

            if ($_POST['testing']==0) {
                $cookie_name = "email";
                $cookie_value = $sup_admin_email;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
            }else if ($_POST['testing']==1) {
                $cookie_name = "email";
                $cookie_value = "";
                setcookie($cookie_name, $cookie_value, time() - (86400 * 30), "/"); // 86400 = 1 day
            }

            $_SESSION['is_sa_login']  = true;
            
            $row = mysqli_fetch_assoc($fire);
    
            $_SESSION['sup_admin_id']         = $row['sup_admin_id'];
            $_SESSION['sup_admin_first_name'] = $row['sup_admin_first_name'];
            $_SESSION['sup_admin_last_name']  = $row['sup_admin_last_name'];
            $_SESSION['sup_admin_email']      = $row['sup_admin_email'];
            $_SESSION['sup_admin_password']   = $row['sup_admin_password'];
            $_SESSION['sup_admin_img_link']   = $row['sup_admin_img_link'];

            $m = array("icon"=>"success", "title"=>"Done", "text"=>"You Are Successfully Logged In!");    
            echo json_encode($m);
          }else{
              $m = array("icon"=>"error", "title"=>"Oops", "timer"=>1500, "text"=>"Invalid email or password!");    
              echo json_encode($m);
          }
        }else{
            $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
            echo json_encode($m);
        }
    }else{
      $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Email ID And Password Cannot Be Empty!");    
      echo json_encode($m);
    } 
}