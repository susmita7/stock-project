<?php require "../config/config.php";
//start session
session_start();

//check if super admin already logged in
if (!isset($_SESSION['is_eu_login'])) {   
    //keep on the login page
}else{
    //redirect to dashboard
    header("Location: home");
    die();
}

extract($_POST);

date_default_timezone_set("Asia/kolkata");



/*______________________________ sending otp email _________________________*/

function send_email($email,$name,$otp){

  
  //template file
  $template_file="./template_otp.php";

  //basic email info
  $email_to = $email;
  $subject = "Email verification";
  //$message = "Your verification otp is : ".$otp;

  //create swap variables array
  $swap_var = array(
    "{EMAIL_NAME}" => $name ,
    "{EMAIL_OTP}" => $otp
  );


  //create the email header
  $headers = "From: Stockpile <stockpile52@gmail.com>\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset-ISO-8859-1\r\n";

  if (file_exists($template_file)) {
    $message = file_get_contents($template_file);
  }else{
    return 0;
    die("unable to locate the template file");
  }

  //search replace all the swap_vars
  foreach (array_keys($swap_var) as $key) {
    if (strlen($key) > 2 && trim($key) != "") {
      $message = str_replace($key, $swap_var[$key], $message);
    }
  }

  if (mail($email_to, $subject, $message, $headers)) {
    return 1;
  }else{
    return 0;
  } 
}





/*__________________________________ Send otp __________________________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sendotp'])) {

  if (!empty($_POST['eu_email'])) {
  
    $eu_email     = mysqli_real_escape_string($con,trim($_POST['eu_email']));
  
    $query = "SELECT * FROM expert_user WHERE eu_email ='$eu_email' ";
    $fire  = mysqli_query($con,$query) or die("can not show data from database. ".mysqli_error($con));
    $row   = mysqli_fetch_assoc($fire);

    if ($fire) {

      //check valid email id
      if (mysqli_num_rows($fire) == 1) {

        $eu_id=$row['eu_id'];

        $full_name=$row['eu_first_name']." ".$row['eu_last_name'];
        
        //generate otp

        $otp = rand(100000,999999);

        //send otp using email

        $mail_status = send_email($eu_email,$full_name,$otp);

        if ($mail_status==1) {

          //insert in otp expiry table

          $created_at= date("Y-m-d H:i:s");

          $query = "UPDATE `expert_user` SET `created_at`='$created_at',`otp`='$otp',`is_expired`=0 WHERE eu_id='$eu_id'";

          $fire  = mysqli_query($con,$query) or die("can not show data from database. ".mysqli_error($con));

          //get the inserted id
          //$current_id= mysqli_insert_id($con);

          if (!empty($eu_id)) {
            //$msg = array("icon"=>"success", "currentid"=>"".$current_id, "value"=>"".$otp);
            $msg = array("icon"=>"success", "currentid"=>"".$eu_id, "text"=>"otp successfully sent");
            echo json_encode($msg);
          }else{
            $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
            echo json_encode($msg);
          }
        }else{
          $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"OTP could not sent!");    
          echo json_encode($msg);
        }
      }else{
        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Invalid email address!");    
        echo json_encode($msg);
      }
    }else{
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
      echo json_encode($msg);
    }
  }else{
    $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Email Id cannot be empty!");
    echo json_encode($msg);
  }
}





/*________________________________________ match otp __________________________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['otp'])) {

  if (!empty($_POST['otp_id']) && !empty($_POST['otp_val'])) {
  
    $otp_id    = mysqli_real_escape_string($con,trim($_POST['otp_id']));
    $otp_val   = mysqli_real_escape_string($con,trim($_POST['otp_val']));

    $query = "SELECT * FROM `expert_user` WHERE eu_id ='$otp_id' AND is_expired !=1 AND NOW() <= DATE_ADD(created_at, INTERVAL 10 MINUTE)";
    $fire  = mysqli_query($con,$query) or die("can not show data from database. ".mysqli_error($con));
    $row   = mysqli_fetch_assoc($fire);

    if ($fire) {

      if (mysqli_num_rows($fire) == 1) {

        if($row['otp']==$otp_val && $row['is_expired']==0) {
                      
          $eu_id=$row['eu_id'];
                      
          $query = "UPDATE `expert_user` SET is_expired= 1 WHERE eu_id='$otp_id'";

          $fire = mysqli_query($con,$query) or die("can not update data. ".mysqli_error($con));

          if ($fire) {
            $msg = array("icon"=>"success", "id"=>"".$eu_id, "text"=>"OTP successfully matched!");    
            echo json_encode($msg);
          }else{
            $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
            echo json_encode($msg);
          }                      
        }else{
          $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Incorrect OTP!");    
          echo json_encode($msg);
        }
      }else{
        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Invalid Request!");    
        echo json_encode($msg);
      }
    }else{
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
      echo json_encode($msg);
    }
  }else{
    $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"OTP cannot be empty!");
    echo json_encode($msg);
  }
}









/*_____________________________________ Reset password __________________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['resetpassword'])) {

  if (!empty($_POST['eu_id']) && !empty($_POST['eu_password'])) {
  
    $eu_id        = mysqli_real_escape_string($con,trim($_POST['eu_id']));
    $eu_password  = mysqli_real_escape_string($con,trim($_POST['eu_password']));

    $query = "SELECT * FROM expert_user WHERE eu_id='$eu_id' ";
    $fire  = mysqli_query($con,$query) or die("can not show data from database. ".mysqli_error($con));

    if ($fire) {

      if (mysqli_num_rows($fire) == 1) {

        if(strlen($eu_password)>=4) {
                      
          $eu_password=md5($eu_password);
                      
          $query = "UPDATE expert_user SET eu_password='$eu_password' WHERE eu_id='$eu_id'";

          $fire = mysqli_query($con,$query) or die("can not update data. ".mysqli_error($con));

          if ($fire) {
            $msg = array("icon"=>"success", "title"=>"Done", "text"=>"Password successfully set!");    
            echo json_encode($msg);
          }else{
            $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
            echo json_encode($msg);
          }                      
        }else{
          $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Password length is too short!");    
          echo json_encode($msg);
        }
      }else{
        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Invalid Email Id!");    
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