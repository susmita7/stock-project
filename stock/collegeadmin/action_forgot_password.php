<?php require "../config/config.php";
//start session
session_start();

//check if super admin already logged in
if (!isset($_SESSION['is_ca_login'])) {   
    //keep on the login page
}else{
    //redirect to dashboard
    header("Location: home");
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





/**************************************** Send otp **************************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sendotp'])) {

  if (!empty($_POST['clg_admin_email'])) {
  
    $clg_admin_email     = mysqli_real_escape_string($con,trim($_POST['clg_admin_email']));
  
    $query = "SELECT * FROM college_admin WHERE clg_admin_email ='$clg_admin_email' ";
    $fire  = mysqli_query($con,$query) or die("can not show data from database. ".mysqli_error($con));
    $row   = mysqli_fetch_assoc($fire);

    if ($fire) {
      //check valid email id
      if (mysqli_num_rows($fire) == 1) {

        $clg_admin_id=$row['clg_admin_id'];

        $full_name=$row['clg_admin_first_name']." ".$row['clg_admin_last_name'];
        
        //generate otp

        $otp = rand(100000,999999);

        //send otp using email

        $mail_status = send_email($clg_admin_email,$full_name,$otp);

        if ($mail_status==1) {

          //insert in otp expiry table

          $created_at= date("Y-m-d H:i:s");

          $query = "UPDATE `college_admin` SET `created_at`='$created_at',`otp`='$otp',`is_expired`=0 WHERE clg_admin_id='$clg_admin_id'";

          //$query = "INSERT INTO `clg_admin_otp_expiry`(`created_at`, `otp`, `clg_admin_id`) VALUES ('$created_at','$otp','$clg_admin_id')";

          $fire  = mysqli_query($con,$query) or die("can not show data from database. ".mysqli_error($con));

          //get the inserted id
          //$current_id= mysqli_insert_id($con);

          if (!empty($clg_admin_id)) {
            //$msg = array("icon"=>"success", "currentid"=>"".$current_id, "value"=>"".$otp);
            $msg = array("icon"=>"success", "currentid"=>"".$clg_admin_id, "value"=>"".$otp);    
            echo json_encode($msg);
          }else{
            $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
            echo json_encode($msg);
          }
        }else{
          $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"OTP could not sent!");    
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
    $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Email ID cannot be empty!");
    echo json_encode($msg);
  }
}






/*________________________________________ match otp __________________________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['otp'])) {

  if (!empty($_POST['otp_id']) && !empty($_POST['otp_val'])) {
  
    $otp_id    = mysqli_real_escape_string($con,trim($_POST['otp_id']));
    $otp_val   = mysqli_real_escape_string($con,trim($_POST['otp_val']));

    $query = "SELECT * FROM `college_admin` WHERE clg_admin_id ='$otp_id' AND is_expired !=1 AND NOW() <= DATE_ADD(created_at, INTERVAL 10 MINUTE)";
    $fire  = mysqli_query($con,$query) or die("can not show data from database. ".mysqli_error($con));
    $row   = mysqli_fetch_assoc($fire);

    if ($fire) {

      if (mysqli_num_rows($fire) == 1) {

        if($row['otp']==$otp_val && $row['is_expired']==0) {
                      
          $clg_admin_id=$row['clg_admin_id'];
                      
          $query = "UPDATE `college_admin` SET is_expired= 1 WHERE clg_admin_id='$otp_id'";

          $fire = mysqli_query($con,$query) or die("can not update data. ".mysqli_error($con));

          if ($fire) {
            $msg = array("icon"=>"success", "id"=>"".$clg_admin_id, "text"=>"OTP successfully matched!");    
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




/**************************************** Reset password **************************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['resetpassword'])) {

  if (!empty($_POST['clg_admin_id']) && !empty($_POST['clg_admin_password'])) {
  
    $clg_admin_id        = mysqli_real_escape_string($con,trim($_POST['clg_admin_id']));
    $clg_admin_password  = mysqli_real_escape_string($con,trim($_POST['clg_admin_password']));

    $query = "SELECT * FROM college_admin WHERE clg_admin_id='$clg_admin_id' ";
    $fire  = mysqli_query($con,$query) or die("can not show data from database. ".mysqli_error($con));

    if ($fire) {

      if (mysqli_num_rows($fire) == 1) {

        if(strlen($clg_admin_password)>=4) {
                      
          $clg_admin_password=md5($clg_admin_password);
                      
          $query = "UPDATE college_admin SET clg_admin_password='$clg_admin_password' WHERE clg_admin_id='$clg_admin_id'";

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
    $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Password cannot be empty!");
    echo json_encode($msg);
  }
}