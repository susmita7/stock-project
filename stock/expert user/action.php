<?php require "../config/config.php"; 
  session_start();
  
  // check if super admin logged in or not
  if ($_SESSION['is_eu_login']) {  
    //keep user on page
  }else{
    //redirect on loginpage
    header("Location: ../choose") ;
  }

extract($_POST);

/***************************_______Get Profile pic and name ________*********************************/

if (isset($_POST['read'])) {
  $eu_id=$_SESSION["eu_id"];
  $query = "SELECT * FROM expert_user WHERE eu_id=$eu_id";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

      $datas = mysqli_fetch_assoc($fire);

      if (!isset($datas['eu_img_link'])) {
        $datas['eu_img_link']="../uploads/default_image.png";
      }

      $reads = '<img src="'.$datas['eu_img_link'].'">
                <h4>Welcome '.$datas['eu_first_name'].'</h4>';      
  }
  $reads .='<a href="profile">View Profile</a>';
  echo $reads;
}