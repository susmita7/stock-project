<?php require "../config/config.php"; 
  session_start();
  
  // check if super admin logged in or not
  if ($_SESSION['is_sa_login']) {  
    //keep user on page
  }else{
    //redirect on loginpage
    header("Location: login");
  }

extract($_POST);


/***************************_______Get Profile pic and name ________*********************************/

if (isset($_POST['read'])) {
  $sup_admin_id=$_SESSION["sup_admin_id"];
  $query = "SELECT * FROM super_admin WHERE sup_admin_id=$sup_admin_id";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

      $datas = mysqli_fetch_assoc($fire);

      if (!isset($datas['sup_admin_img_link'])) {
        $datas['sup_admin_img_link']="../uploads/default_image.png";
      }

      $reads = '<img src="'.$datas['sup_admin_img_link'].'">
                <h4>Welcome '.$datas['sup_admin_first_name'].'</h4>';      
  }
  $reads .='<a href="profile">View Profile</a>';
  echo $reads;
}