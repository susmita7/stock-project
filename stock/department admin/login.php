<?php require "../config/config.php";?>
<?php
session_start();

//check if department admin already logged in
if (!isset($_SESSION['is_da_login'])) {   
    //keep on the login page
}else{
    header("Location: home");
}
?>
<?php
extract($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
  
    if (isset($_POST['dept_admin_email']) && isset($_POST['dept_admin_password'])) {
          
        $dept_admin_email     = mysqli_real_escape_string($con,trim($_POST['dept_admin_email']));
        $dept_admin_password  = mysqli_real_escape_string($con,md5(trim($_POST['dept_admin_password'])));

        $query = "SELECT * FROM department_admin WHERE dept_admin_email ='$dept_admin_email' AND dept_admin_password ='$dept_admin_password'";
        $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

        if ($fire) {
            
          if (mysqli_num_rows($fire) == 1) {

            if ($_POST['testing']==0) {
                $cookie_name = "dept_email";
                $cookie_value = $dept_admin_email;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
            }else if ($_POST['testing']==1) {
                $cookie_name = "dept_email";
                $cookie_value = "";
                setcookie($cookie_name, $cookie_value, time() - (86400 * 30), "/"); // 86400 = 1 day
            }

            $_SESSION['is_da_login']  = true;
            
            $row = mysqli_fetch_assoc($fire);
    
            $_SESSION['dept_admin_id']         = $row['dept_admin_id'];
            $_SESSION['dept_admin_first_name'] = $row['dept_admin_first_name'];
            $_SESSION['dept_admin_last_name']  = $row['dept_admin_last_name'];
            $_SESSION['dept_admin_email']      = $row['dept_admin_email'];
            $_SESSION['dept_admin_mobile']     = $row['dept_admin_mobile'];
            $_SESSION['dept_admin_img_link']   = $row['dept_admin_img_link'];
            $_SESSION['clg_id']                = $row['clg_id'];
            $_SESSION['dept_id']               = $row['dept_id'];

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