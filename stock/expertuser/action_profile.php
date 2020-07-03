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

date_default_timezone_set("Asia/kolkata");



/*________________________________Get Profile pic and name ______________________________*/
/*
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['info'])) {

  $eu_id=mysqli_real_escape_string($con,trim($_SESSION["eu_id"]));

  $query = "SELECT * FROM expert_user WHERE eu_id=$eu_id";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

      $infos = mysqli_fetch_assoc($fire);

      if (!isset($infos['eu_img_link']) || !file_exists($infos['eu_img_link'])) {
        $infos['eu_img_link']="../uploads/default_image.png";
      }


      $reads = '<div class="heading_pro">
                        <h1>YOUR PROFILE</h1>
                        <img src="'.$infos['eu_img_link'].'" class="pro_pic">
                    </div>

                    <div class="details">
                        <div class="left_content">
                            <h3>Name :</h3>
                            <h3>Email ID :</h3>
                        </div>
                        <div class="right_content">
                            <h3>'.$infos['eu_first_name'].'&nbsp'.$infos['eu_last_name'].'</h3>
                            <h3>'.$infos['eu_email'].'</h3>
                        </div>
                    </div>

                    <div class="up_re_btn">
                        <a id="up_pro" type="button" onclick="getProfile('.$infos['eu_id'].')">Edit Profile</a>
                        <a id="re_pass" type="button" onclick="getForgot('.$infos['eu_id'].')">Reset Password</a>
                    </div>';    
  }
  echo $reads;
}
*/






/*________________________________Get Profile box (new) ______________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['info'])) {

  $eu_id=mysqli_real_escape_string($con,trim($_SESSION["eu_id"]));

  $query = "SELECT * FROM expert_user WHERE eu_id=$eu_id";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

      $infos = mysqli_fetch_assoc($fire);

      if (!isset($infos['eu_img_link']) || !file_exists($infos['eu_img_link'])) {
        $infos['eu_img_link']="../uploads/default_image.png";
      }


      $reads = '<div class="left_side">

                  <div class="heading">
                    <h3>YOUR PROFILE</h3>
                    <div class="pic">
                      <img src="'.$infos['eu_img_link'].'">
                    </div>
                  </div>
                  
                  <div class="icons">      
                    <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.instagram.com/?hl=en"  target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://twitter.com/explore"  target="_blank"><i class="fab fa-twitter"></i></a>
                  </div>
                
                </div>
                    
                <div class="middle"></div>
                    
                <div class="right_side">
                  
                  <div class="info">
                    <h4>Name : '.$infos['eu_first_name'].'&nbsp'.$infos['eu_last_name'].'</h4>
                    <h4>Email ID : '.$infos['eu_email'].'</h4>';

                    if ($infos['eu_mobile']==null) {
                      $reads .='<h4>Phone No. : Not available</h4>';
                    }else{
                      $reads .='<h4>Phone No. : '.$infos['eu_mobile'].'</h4>';
                    }
                    
                  $reads .='</div>

                  <div class="up_re_btn">
                    <a id="up_pro" type="button" onclick="getProfile('.$infos['eu_id'].')">Edit Profile</a>
                    <a id="re_pass" type="button" onclick="getForgot('.$infos['eu_id'].')">Reset Password</a>
                  </div>
                </div>';    
  }
  echo $reads;
}








/******************************___________ Get EU id nd send details __________*************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    
    $id=mysqli_real_escape_string($con,trim($_POST['id']));

    $query = "SELECT * FROM expert_user WHERE eu_id ='$id'";
    $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

    if ($fire) {
        
        $response= array();

        if (mysqli_num_rows($fire) > 0) {
          while ($row = mysqli_fetch_assoc($fire)) {
            if (!isset($row['eu_img_link']) || !file_exists($row['eu_img_link'])) {
              $row['eu_img_link']="../uploads/default_image.png";
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





/******************************___________ Get EU id nd send details __________*************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['forgotid'])) {
    
  $forgotid=mysqli_real_escape_string($con,trim($_POST['forgotid']));

  $query = "SELECT * FROM expert_user WHERE eu_id ='$forgotid'";
  $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

  if ($fire) {
        
    $responses= array();

    if (mysqli_num_rows($fire) > 0) {
      while ($row = mysqli_fetch_assoc($fire)) {
        if (!isset($row['eu_img_link']) || !file_exists($row['eu_img_link'])) {
          $row['eu_img_link']="../uploads/default_image.png";
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

  if (isset($_POST['eu_email']) && isset($_POST['eu_password']) && isset($_POST['eu_password2'])) {
        
    $eu_id        = mysqli_real_escape_string($con,trim($_POST['eu_id']));
    $eu_email     = mysqli_real_escape_string($con,trim($_POST['eu_email']));
    $eu_password  = mysqli_real_escape_string($con,trim($_POST['eu_password']));
    $eu_password2 = mysqli_real_escape_string($con,trim($_POST['eu_password2']));

    $query = "SELECT * FROM expert_user WHERE eu_email ='$eu_email' AND eu_id='$eu_id' ";
    $fire  = mysqli_query($con,$query) or die("can not show data from database. ".mysqli_error($con));

    if ($fire) {

      if (mysqli_num_rows($fire) == 1) {

        if($eu_password == $eu_password2 && strlen($eu_password)>=4) {
                      
          $eu_password=md5($eu_password);
                      
          $query = "UPDATE expert_user SET eu_password='$eu_password' WHERE eu_id='$eu_id' AND eu_email='$eu_email'";

          $fire = mysqli_query($con,$query) or die("can not update data. ".mysqli_error($con));

          if ($fire) {

            $created_at= date("Y-m-d H:i:s");
            $activity_type= "password";
            $activity_body= "You have changed your password.";
            $eu_id=$_SESSION['eu_id'];

            $query_n = "INSERT INTO `expert_user_activity`(`created_at`, `activity_type`, `activity_body`, `eu_id`) VALUES ('$created_at','$activity_type','$activity_body','$eu_id')";

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
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
      echo json_encode($msg);
    }
  }else{
    $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Password or Email cannot be empty!");
    echo json_encode($msg);
  }
}