<?php require "../config/config.php"; 
  session_start();
  
  // check if super admin logged in or not
  if ($_SESSION['is_da_login']) {  
    //keep user on page
  }else{
    //redirect on loginpage
    //header("Location: login");
    header("Location: ../choose") ;
  }

extract($_POST);


/***************************_______Get Profile pic and name ________*********************************/

if (isset($_POST['read'])) {
  $dept_admin_id=$_SESSION["dept_admin_id"];
  $query = "SELECT * FROM department_admin WHERE dept_admin_id=$dept_admin_id";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

      $datas = mysqli_fetch_assoc($fire);

      if (!isset($datas['dept_admin_img_link'])) {
        $datas['dept_admin_img_link']="../uploads/default_image.png";
      }

      $reads = '<img src="'.$datas['dept_admin_img_link'].'">
                <h4>Welcome '.$datas['dept_admin_first_name'].'</h4>';      
  }
  $reads .='<a href="profile">View Profile</a>';
  echo $reads;
}