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


/***************************______________Get Profile pic and name ____________*******************************/

if (isset($_POST['info'])) {

  $eu_id=$_SESSION["eu_id"];

  $query = "SELECT * FROM expert_user WHERE eu_id=$eu_id";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

      $infos = mysqli_fetch_assoc($fire);

      if (!isset($infos['eu_img_link'])) {
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


/******************************___________ Get EU id nd send details __________*************************/
if (isset($_POST['id'])) {
    
    $id=mysqli_real_escape_string($con,trim($_POST['id']));

    $query = "SELECT * FROM expert_user WHERE eu_id ='$id'";
    $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

    if ($fire) {
        
        $response= array();

        if (mysqli_num_rows($fire) > 0) {
          while ($row = mysqli_fetch_assoc($fire)) {
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
if (isset($_POST['forgotid'])) {
    
    $forgotid=mysqli_real_escape_string($con,trim($_POST['forgotid']));

    $query = "SELECT * FROM expert_user WHERE eu_id ='$forgotid'";
    $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

    if ($fire) {
        
        $responses= array();

        if (mysqli_num_rows($fire) > 0) {
          while ($row = mysqli_fetch_assoc($fire)) {
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

        $query = "SELECT * FROM expert_user WHERE eu_email ='$eu_email' ";
        $fire  = mysqli_query($con,$query) or die("can not show data from database. ".mysqli_error($con));

          if ($fire) {

            if (mysqli_num_rows($fire) == 1) {

                if($eu_password == $eu_password2 && strlen($eu_password)>=4)
                  {
                      $eu_password=md5($eu_password);
                      
                      $query = "UPDATE expert_user SET eu_password='$eu_password' WHERE eu_id='$eu_id' AND eu_email='$eu_email'";

                      $fire = mysqli_query($con,$query) or die("can not update data. ".mysqli_error($con));

                      if ($fire) {
                        $msg = array("icon"=>"success", "title"=>"Done", "text"=>"Password Successfully Set!");    
                        echo json_encode($msg);            
                      }else{
                        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
                        echo json_encode($msg);
                      }
                }else{
                    $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Password Mismatched or Password Length is too Short!");    
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