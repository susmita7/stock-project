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


/***************************______________Get Profile pic and name ____________*********************************/

if (isset($_POST['info'])) {

  $clg_admin_id=$_SESSION["clg_admin_id"];

  $query = "SELECT * FROM college_admin WHERE clg_admin_id=$clg_admin_id";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {

      $infos = mysqli_fetch_assoc($fire);

      if (!isset($infos['clg_admin_img_link'])) {
        $infos['clg_admin_img_link']="../uploads/default_image.png";
      }


      $reads = '<div class="heading_pro">
                        <h1>YOUR PROFILE</h1>
                        <img src="'.$infos['clg_admin_img_link'].'" class="pro_pic">
                    </div>

                    <div class="details">
                        <div class="left_content">
                            <h3>Name :</h3>
                            <h3>Email ID :</h3>
                        </div>
                        <div class="right_content">
                            <h3>'.$infos['clg_admin_first_name'].'&nbsp'.$infos['clg_admin_last_name'].'</h3>
                            <h3>'.$infos['clg_admin_email'].'</h3>
                        </div>
                    </div>

                    <div class="up_re_btn">
                        <a id="up_pro" type="button" onclick="getProfile('.$infos['clg_admin_id'].')">Edit Profile</a>
                        <a id="re_pass" type="button" onclick="getForgot('.$infos['clg_admin_id'].')">Reset Password</a>
                    </div>';    
  }
  echo $reads;
}


/******************************___________ Get super_admin id nd send details __________*************************/
if (isset($_POST['id'])) {
    
    $id=mysqli_real_escape_string($con,trim($_POST['id']));

    $query = "SELECT * FROM college_admin WHERE clg_admin_id ='$id'";
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



/******************************___________ Get super_admin id nd send email __________*************************/
if (isset($_POST['forgotid'])) {
    
    $forgotid=mysqli_real_escape_string($con,trim($_POST['forgotid']));

    $query = "SELECT * FROM college_admin WHERE clg_admin_id ='$forgotid'";
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

    if (isset($_POST['clg_admin_email']) && isset($_POST['clg_admin_password']) && isset($_POST['clg_admin_password2'])) {
        
      $clg_admin_id        = mysqli_real_escape_string($con,trim($_POST['clg_admin_id']));
      $clg_admin_email     = mysqli_real_escape_string($con,trim($_POST['clg_admin_email']));
      $clg_admin_password  = mysqli_real_escape_string($con,trim($_POST['clg_admin_password']));
      $clg_admin_password2 = mysqli_real_escape_string($con,trim($_POST['clg_admin_password2']));

        $query = "SELECT * FROM college_admin WHERE clg_admin_email ='$clg_admin_email' ";
        $fire  = mysqli_query($con,$query) or die("can not show data from database. ".mysqli_error($con));

          if ($fire) {

            if (mysqli_num_rows($fire) == 1) {

                if($clg_admin_password == $clg_admin_password2 && strlen($clg_admin_password)>=4)
                  {
                      $clg_admin_password=md5($clg_admin_password);
                      
                      $query = "UPDATE college_admin SET clg_admin_password='$clg_admin_password' WHERE clg_admin_id='$clg_admin_id' AND clg_admin_email='$clg_admin_email'";

                      $fire = mysqli_query($con,$query) or die("can not update data. ".mysqli_error($con));

                      if ($fire) {
                        $msg = array("icon"=>"success", "title"=>"Done", "text"=>"Password Successfully Set!");    
                        echo json_encode($msg);            
                      }else{
                        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Invalid Email!");    
                        echo json_encode($msg);
                      }
                }else{
                    $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Password Missmatched or Password Length is too Short!");    
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