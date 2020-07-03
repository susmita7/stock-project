<?php require "../config/config.php"; 
session_start();
  
// check if dept admin logged in or not
if ($_SESSION['is_da_login']) {  
  //keep user on page
}else{
  //redirect on loginpage
  header("Location: ../choose");
}

extract($_POST);

date_default_timezone_set("Asia/kolkata");


/*________________________________  Get Profile pic and name  ______________________________*/
/*
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['info'])) {

  $dept_admin_id=mysqli_real_escape_string($con,trim($_SESSION["dept_admin_id"]));

  $query = "SELECT * FROM department_admin WHERE dept_admin_id=$dept_admin_id";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

    $infos = mysqli_fetch_assoc($fire);

    if (!isset($infos['dept_admin_img_link']) || !file_exists($infos['dept_admin_img_link'])) {
      $infos['dept_admin_img_link']="../uploads/default_image.png";
    }


      $reads = '<div class="heading_pro">
                        <h1>YOUR PROFILE</h1>
                        <img src="'.$infos['dept_admin_img_link'].'" class="pro_pic">
                    </div>

                    <div class="details">
                        <div class="left_content">
                            <h3>Name :</h3>
                            <h3>Email ID :</h3>
                        </div>
                        <div class="right_content">
                            <h3>'.$infos['dept_admin_first_name'].'&nbsp'.$infos['dept_admin_last_name'].'</h3>
                            <h3>'.$infos['dept_admin_email'].'</h3>
                        </div>
                    </div>

                    <div class="up_re_btn">
                        <a id="up_pro" type="button" onclick="getProfile('.$infos['dept_admin_id'].')">Edit Profile</a>
                        <a id="re_pass" type="button" onclick="getForgot('.$infos['dept_admin_id'].')">Reset Password</a>
                    </div>';    
  }
  echo $reads;
}
*/




/*________________________________  Get Profile box (new)  ______________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['info'])) {

  $dept_admin_id=mysqli_real_escape_string($con,trim($_SESSION["dept_admin_id"]));

  $query = "SELECT * FROM department_admin WHERE dept_admin_id=$dept_admin_id";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

    $infos = mysqli_fetch_assoc($fire);

    if (!isset($infos['dept_admin_img_link']) || !file_exists($infos['dept_admin_img_link'])) {
      $infos['dept_admin_img_link']="../uploads/default_image.png";
    }


      $reads = '<div class="left_side">

                  <!-------------------------- left side ------------------------>
                  
                  <div class="heading">  
                    <h3>YOUR PROFILE</h3>
                    <div class="pic">
                      <img src="'.$infos['dept_admin_img_link'].'" class="pro_pic">
                    </div>
                  </div>
                        
                  <div class="icons">
                    <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.instagram.com/?hl=en"  target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://twitter.com/explore"  target="_blank"><i class="fab fa-twitter"></i></a>
                  </div>

                </div>
                    
                <div class="middle">
                  <!----------------------- middle ------------------------>
                </div>

                <div class="right_side">

                  <!------------------------ right side ------------------------>

                  <div class="info">
                  
                    <h4>Name : '.$infos['dept_admin_first_name'].'&nbsp'.$infos['dept_admin_last_name'].'</h4>
                    <h4>Email Id : '.$infos['dept_admin_email'].'</h4>';

                    if ($infos['dept_admin_mobile']==null) {
                      $reads .='<h4>Phone No. : Not available</h4>';
                    }else{
                      $reads .='<h4>Phone No. : '.$infos['dept_admin_mobile'].'</h4>';
                    }
                    
                  $reads .='</div>

                  <div class="up_re_btn">
                    <a id="up_pro" type="button" onclick="getProfile('.$infos['dept_admin_id'].')">Edit Profile</a>
                    <a id="re_pass" type="button" onclick="getForgot('.$infos['dept_admin_id'].')">Reset Password</a>
                  </div>
                </div>';    
  }
  echo $reads;
}






/*____________________________ Get dept admin id nd send details ______________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    
  $id=mysqli_real_escape_string($con,trim($_POST['id']));

  $query = "SELECT * FROM department_admin WHERE dept_admin_id ='$id'";
  $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

  if ($fire) {
        
    $response= array();

    if (mysqli_num_rows($fire) > 0) {
      while ($row = mysqli_fetch_assoc($fire)) {
        if (!isset($row['dept_admin_img_link']) || !file_exists($row['dept_admin_img_link'])) {
          $row['dept_admin_img_link']="../uploads/default_image.png";
        }
        $response = $row;
      }
    }else{
      $response['status']=200;
      $response['message']="Data Not Found!";
    }
  }
  echo json_encode($response);
}else{
  $response['status']=200;
  $response['message']="Invalid Request!";
}





/**********************________ Get dept admin id nd send details __________*************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['forgotid'])) {
    
  $forgotid=mysqli_real_escape_string($con,trim($_POST['forgotid']));

  $query = "SELECT * FROM department_admin WHERE dept_admin_id ='$forgotid'";
  $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

  if ($fire) {
        
    $responses= array();

    if (mysqli_num_rows($fire) > 0) {
      while ($row = mysqli_fetch_assoc($fire)) {
        if (!isset($row['dept_admin_img_link']) || !file_exists($row['dept_admin_img_link'])) {
          $row['dept_admin_img_link']="../uploads/default_image.png";
        }
      $responses = $row;
      }
    }else{
      $responses['status']=200;
      $responses['message']="Data Not Found!";
    }
  }
  echo json_encode($responses);
}else{
  $responses['status']=200;
  $responses['message']="Invalid Request!";
}





/**************************************** Reset password **************************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset'])) {

  if (isset($_POST['dept_admin_email']) && isset($_POST['dept_admin_password']) && isset($_POST['dept_admin_password2'])) {
        
    $dept_admin_id        = mysqli_real_escape_string($con,trim($_POST['dept_admin_id']));
    $dept_admin_email     = mysqli_real_escape_string($con,trim($_POST['dept_admin_email']));
    $dept_admin_password  = mysqli_real_escape_string($con,trim($_POST['dept_admin_password']));
    $dept_admin_password2 = mysqli_real_escape_string($con,trim($_POST['dept_admin_password2']));

    $query = "SELECT * FROM department_admin WHERE dept_admin_email ='$dept_admin_email' AND dept_admin_id='$dept_admin_id' ";
    $fire  = mysqli_query($con,$query) or die("can not show data from database. ".mysqli_error($con));

    if ($fire) {

      if (mysqli_num_rows($fire) == 1) {

        if($dept_admin_password == $dept_admin_password2 && strlen($dept_admin_password)>=4) {
                      
          $dept_admin_password=md5($dept_admin_password);
                      
          $query = "UPDATE department_admin SET dept_admin_password='$dept_admin_password' WHERE dept_admin_id='$dept_admin_id' AND dept_admin_email='$dept_admin_email'";

          $fire = mysqli_query($con,$query) or die("can not update data. ".mysqli_error($con));

          if ($fire) {

            $created_at= date("Y-m-d H:i:s");
            $activity_type= "password";
            $activity_body= "You have changed your password.";
            $dept_admin_id=$_SESSION['dept_admin_id'];

            $query_n = "INSERT INTO `dept_admin_activity`(`created_at`, `activity_type`, `activity_body`, `dept_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$dept_admin_id')";

            $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

            if ($fire_n) {
              $msg = array("icon"=>"success", "title"=>"Done", "text"=>"Password successfully set!");    
              echo json_encode($msg);
            }else{
              $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
              echo json_encode($msg);
            }              
          }else{
            $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
            echo json_encode($msg);
          }
        }else{
          $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Password mismatched or password length is too short!");    
          echo json_encode($msg);
        }
      }else{
        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Invalid Email ID!");    
        echo json_encode($msg);
      }
    }else{
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
      echo json_encode($msg);
    }
  }else{
    $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Password or Email cannot be empty!");
    echo json_encode($msg);
  }
}