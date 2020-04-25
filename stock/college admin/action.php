<?php require "../config/config.php"; 
  session_start();
  
  // check if super admin logged in or not
  if ($_SESSION['is_ca_login']) {  
    //keep user on page
  }else{
    //redirect on loginpage
    header("Location: login");
  }

extract($_POST);


/***************************_______Get Profile pic and name ________*********************************/

if (isset($_POST['read'])) {
  $clg_admin_id=$_SESSION["clg_admin_id"];
  $query = "SELECT * FROM college_admin WHERE clg_admin_id=$clg_admin_id";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

      $datas = mysqli_fetch_assoc($fire);

      if (!isset($datas['clg_admin_img_link'])) {
        $datas['clg_admin_img_link']="../uploads/default_image.png";
      }

      $reads = '<img src="'.$datas['clg_admin_img_link'].'">
                <h4>Welcome '.$datas['clg_admin_first_name'].'</h4>';      
  }
  $reads .='<a href="profile">View Profile</a>';
  echo $reads;
}