<?php require "../config/config.php"; 
  session_start();
  
  // check if super admin logged in or not
  if ($_SESSION['is_sa_login']) {  
    //keep user on page
  }else{
    //redirect on loginpage
    header("Location: login");
    die();
  }

extract($_POST);

date_default_timezone_set("Asia/kolkata");


/*____________________________________ Get Profile  ___________________________________*/
/*
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['info'])) {

  $sup_admin_id=mysqli_real_escape_string($con,trim($_SESSION["sup_admin_id"]));

  $query = "SELECT * FROM super_admin WHERE sup_admin_id=$sup_admin_id";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

      $infos = mysqli_fetch_assoc($fire);

      if (!isset($infos['sup_admin_img_link']) || !file_exists($infos['sup_admin_img_link'])) {
        $infos['sup_admin_img_link']="../uploads/default_image.png";
      }


      $reads = '<div class="heading_pro">
                        <h1>YOUR PROFILE</h1>
                        <img src="'.$infos['sup_admin_img_link'].'" class="pro_pic">
                    </div>

                    <div class="details">
                        <div class="left_content">
                            <h3>Name :</h3>
                            <h3>Email ID :</h3>
                        </div>
                        <div class="right_content">
                            <h3>'.$infos['sup_admin_first_name'].'&nbsp'.$infos['sup_admin_last_name'].'</h3>
                            <h3>'.$infos['sup_admin_email'].'</h3>
                        </div>
                    </div>

                    <div class="up_re_btn">
                        <a id="up_pro" type="button" onclick="getProfile('.$infos['sup_admin_id'].')">Edit Profile</a>
                        <a id="re_pass" type="button" onclick="getForgot('.$infos['sup_admin_id'].')">Reset Password</a>
                    </div>';    
  }
  echo $reads;
}
*/



/*____________________________________ get profile box ( new ) ___________________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['info'])) {

  $sup_admin_id=mysqli_real_escape_string($con,trim($_SESSION["sup_admin_id"]));

  $query = "SELECT * FROM super_admin WHERE sup_admin_id=$sup_admin_id";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

      $infos = mysqli_fetch_assoc($fire);

      if (!isset($infos['sup_admin_img_link']) || !file_exists($infos['sup_admin_img_link'])) {
        $infos['sup_admin_img_link']="../uploads/default_image.png";
      }


      $reads = '<div class="left_side">

                  <!---------------------- left side of profile box ------------------->

                  <div class="heading">
                    <h3>YOUR PROFILE</h3>
                    <div class="pic">
                      <img src="'.$infos['sup_admin_img_link'].'">
                    </div>
                  </div>

                  <div class="icons">
                    <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.instagram.com/?hl=en"  target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://twitter.com/explore"  target="_blank"><i class="fab fa-twitter"></i></a>
                  </div>

                </div>
                
                <div class="middle">
                  <!------------------------ middle ----------------------->
                </div>
                  
                <div class="right_side">
                  
                  <!------------------------- right side of profile box --------------------->
                  
                  <div class="info">
                    <h4>Name : '.$infos['sup_admin_first_name'].'&nbsp'.$infos['sup_admin_last_name'].'</h4>
                    <h4>Email ID : '.$infos['sup_admin_email'].'</h4>
                  </div>

                  <div class="up_re_btn">
                    <a id="up_pro" type="button" onclick="getProfile('.$infos['sup_admin_id'].')">Edit Profile</a>
                    <a id="re_pass" type="button" onclick="getForgot('.$infos['sup_admin_id'].')">Reset Password</a>
                  </div>
                </div>';    
  }
  echo $reads;
}






/*__________________________ Get super_admin id nd send details __________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    
    $id=mysqli_real_escape_string($con,trim($_POST['id']));

    $query = "SELECT * FROM super_admin WHERE sup_admin_id ='$id'";
    $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

    if ($fire) {
        
      $response= array();

      if (mysqli_num_rows($fire) > 0) {
        while ($row = mysqli_fetch_assoc($fire)) {
          if (!isset($row['sup_admin_img_link']) || !file_exists($row['sup_admin_img_link'])) {
            $row['sup_admin_img_link']="../uploads/default_image.png";
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






/*____________________________update super admin__________________________________*/
/*
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upd'])){

  if (isset($_POST['sup_admin_first_name']) && isset($_POST['sup_admin_last_name']) && isset($_POST['sup_admin_email'])) {

    $sup_admin_id          = mysqli_real_escape_string($con,trim($_POST['sup_admin_id']));
    $sup_admin_first_name  = mysqli_real_escape_string($con,trim($_POST['sup_admin_first_name']));
    $sup_admin_first_name  = ucwords(strtolower($sup_admin_first_name));
    $sup_admin_last_name   = mysqli_real_escape_string($con,trim($_POST['sup_admin_last_name']));
    $sup_admin_last_name   = ucwords(strtolower($sup_admin_last_name));
    $sup_admin_email       = mysqli_real_escape_string($con,trim($_POST['sup_admin_email']));

    if (preg_match("/^[a-zA-Z ]*$/",$sup_admin_first_name) && preg_match("/^[a-zA-Z ]*$/",$sup_admin_last_name)) {


      if ($_FILES["file"]["name"] != '') {
          $test = explode(".", $_FILES["file"]["name"]);
          $extension = end($test);
          $name=rand(100,999) . '.' . $extension;
          $location='../uploads/'.$name;

          move_uploaded_file($_FILES["file"]["tmp_name"], $location);

          $query ="UPDATE super_admin SET sup_admin_first_name = '$sup_admin_first_name',sup_admin_last_name = '$sup_admin_last_name',sup_admin_email = '$sup_admin_email',sup_admin_img_link = '$location' WHERE sup_admin_id='$sup_admin_id'";

          $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

          if ($fire) {
              $ms = array("icon"=>"success", "title"=>"Done", "text"=>"Super Admin Successfully Updated!");
              echo json_encode($ms);
          }else{
              $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
              echo json_encode($ms);
          }
      }else{

          $query ="UPDATE super_admin SET sup_admin_first_name = '$sup_admin_first_name',sup_admin_last_name = '$sup_admin_last_name',sup_admin_email = '$sup_admin_email' WHERE sup_admin_id='$sup_admin_id'";

          $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

          if ($fire) {
              $ms = array("icon"=>"success", "title"=>"Done", "text"=>"Super Admin Successfully Updated!");
              echo json_encode($ms);
          }else{
              $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
              echo json_encode($ms);
          }
      }
    }else{  
      $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Only letters and white space allowed!");    
      echo json_encode($ms); 
    }  
  }else{
    $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Name or Email cannot be Empty!");
    echo json_encode($ms);
  }
}
*/




/*______________________________ Get super_admin id nd send details _________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['forgotid'])) {
    
  $forgotid=mysqli_real_escape_string($con,trim($_POST['forgotid']));

  $query = "SELECT * FROM super_admin WHERE sup_admin_id ='$forgotid'";
  $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

    if ($fire) {
        
      $responses= array();

      if (mysqli_num_rows($fire) > 0) {
        while ($row = mysqli_fetch_assoc($fire)) {
          if (!isset($row['sup_admin_img_link']) || !file_exists($row['sup_admin_img_link'])) {
            $row['sup_admin_img_link']="../uploads/default_image.png";
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





/*_______________________________________ Reset password ____________________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset'])) {

  if (isset($_POST['sup_admin_email']) && isset($_POST['sup_admin_password']) && isset($_POST['sup_admin_password2'])) {
        
    $sup_admin_id        = mysqli_real_escape_string($con,trim($_POST['sup_admin_id']));
    $sup_admin_email     = mysqli_real_escape_string($con,trim($_POST['sup_admin_email']));
    $sup_admin_password  = mysqli_real_escape_string($con,trim($_POST['sup_admin_password']));
    $sup_admin_password2 = mysqli_real_escape_string($con,trim($_POST['sup_admin_password2']));

    $query = "SELECT * FROM super_admin WHERE sup_admin_email ='$sup_admin_email' ";
    $fire  = mysqli_query($con,$query) or die("can not show data from database. ".mysqli_error($con));

    if ($fire) {

      if (mysqli_num_rows($fire) == 1) {

        if($sup_admin_password == $sup_admin_password2 && strlen($sup_admin_password)>=4) {
          
          $sup_admin_password=md5($sup_admin_password);
                      
          $query = "UPDATE super_admin SET sup_admin_password='$sup_admin_password' WHERE sup_admin_id='$sup_admin_id' AND sup_admin_email='$sup_admin_email'";

          $fire = mysqli_query($con,$query) or die("can not update data. ".mysqli_error($con));

          if ($fire) {

            $created_at= date("Y-m-d H:i:s");
            $activity_type= "password";
            $activity_body= "You have changed your password.";
            $sup_admin_id=$_SESSION['sup_admin_id'];

            $query_n = "INSERT INTO `sup_admin_activity`(`created_at`, `activity_type`, `activity_body`, `sup_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$sup_admin_id')";

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
        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Invalid Email!");    
        echo json_encode($msg);
      }
    }else{
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
      echo json_encode($msg);
    }
  }else{
    $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Password or Email cannot be Empty!");
    echo json_encode($msg);
  }
}