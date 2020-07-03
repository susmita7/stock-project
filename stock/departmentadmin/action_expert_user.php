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


/*************************************_____Get EU Table________**************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readexpertuser'])) {
  
  $records = '<table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col" class="align-middle">Profile</th>
                    <th scope="col" class="align-middle">Expert User Name</th>
                    <th scope="col" class="align-middle">Expert User Email</th>
                    <th scope="col" class="align-middle">Phone No</th>
                    <th scope="col" class="align-middle">Department Name</th>
                    <th scope="col" colspan="2" class="align-middle">Action</th>
                  </tr>
                </thead>';

  $query = "SELECT * FROM expert_user INNER JOIN department ON expert_user.dept_id = department.dept_id AND expert_user.dept_id='".$_SESSION['dept_id']."'";

  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      //$no=1;
      while ($expert_user = mysqli_fetch_assoc($fire)) {

        if (!isset($expert_user['eu_img_link']) || !file_exists($expert_user['eu_img_link'])) {
          $expert_user['eu_img_link']="../uploads/default_image.png";
        }

      $records .='<tbody id="myTable">
                  <tr>

                    <td class="align-middle">
                        <img class=" table_img" src="'.$expert_user['eu_img_link'].'">
                    </td>

                    <td class="align-middle">'.$expert_user['eu_first_name'].'&nbsp'.$expert_user['eu_last_name'].'</td>
                    <td class="align-middle">'.$expert_user['eu_email'].'</td>
                    <td class="align-middle">'.$expert_user['eu_mobile'].'</td>
                    <td class="align-middle">'.$expert_user['dept_name'].'</td>
                    <td class="align-middle">
                      <a type="button" id="up_clg" class="editbtn" onclick="getExpertuser('.$expert_user['eu_id'].')">Update</a>
                    </td>
                    <td class="align-middle">
                      <a type="button" id="del_ad" onclick="getDeluser('.$expert_user['eu_id'].')">Delete</a></td>
                  </tr>';
                  //$no++;
      }
  }else{
    $records .='<tbody>
              <tr>
                <td class="align-middle" scope="col" colspan="6">No Records Available</td>
              </tr>';
  }
  $records .='</tbody>
            </table>';
  echo $records;
}





/*****************************___ sending email to CA when SA added CA __****************************/

function send_email($email,$pass,$name,$dept){
  
  //template file
  $template_file="./template.php";

  //basic email info
  $email_to = $email;
  $subject = "Congratulations! You are added as Expert User";

  //create swap variables array
  $swap_var = array(
    "{EMAIL_NAME}" => $name ,
    "{EMAIL_DEPT}" => $dept ,
    "{EMAIL_EID}" => $email ,
    "{EMAIL_PASS}" => $pass
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

  mail($email_to, $subject, $message, $headers);
}





/**************************************_______add EU________*****************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])){

  $eu_first_name  = mysqli_real_escape_string($con,trim($_POST['eu_first_name']));
  $eu_first_name  = ucwords(strtolower($eu_first_name));
  
  $eu_last_name   = mysqli_real_escape_string($con,trim($_POST['eu_last_name']));
  $eu_last_name   = ucwords(strtolower($eu_last_name));
  
  $eu_email       = mysqli_real_escape_string($con,trim($_POST['eu_email']));
  $eu_password    = mysqli_real_escape_string($con,trim($_POST['eu_password']));
  $eu_password2   = mysqli_real_escape_string($con,trim($_POST['eu_password2']));
  $dept_id        = mysqli_real_escape_string($con,trim($_POST['dept_id']));


  // check if name only contains letters and whitespace
  if (preg_match("/^[a-zA-Z ]*$/",$eu_first_name) && preg_match("/^[a-zA-Z ]*$/",$eu_last_name)) {
 
    $query = "SELECT * FROM expert_user WHERE dept_id = '$dept_id' ";
    $fire  = mysqli_query($con,$query) or die("can not show data. ".mysqli_error($con));

    if ($fire) {
        
      if (mysqli_num_rows($fire) == 0) {

        $query = "SELECT * FROM expert_user WHERE eu_email = '$eu_email' ";
        $fire  = mysqli_query($con,$query) or die("can not show data. ".mysqli_error($con));

        if (mysqli_num_rows($fire) == 0) {

          if($eu_password == $eu_password2 && strlen($eu_password)>=4) {

            $pass = $eu_password;
                
            $eu_password=md5($eu_password);

            $query = "INSERT INTO expert_user(eu_first_name,eu_last_name,eu_email,eu_password,dept_id) VALUES('$eu_first_name','$eu_last_name','$eu_email','$eu_password','$dept_id')";

            $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));

            if ($fire) {

              $full_name=$eu_first_name." ".$eu_last_name;

              //send mail

              send_email($eu_email,$pass,$full_name,$_SESSION['dept_name']);

              //add to activity

              $created_at= date("Y-m-d H:i:s");
              $activity_type= "expertuser";
              $activity_body= "You have added Expert User for the department : ".$_SESSION['dept_name'].".";
              $dept_admin_id=$_SESSION['dept_admin_id'];

              $query_n = "INSERT INTO `dept_admin_activity`(`created_at`, `activity_type`, `activity_body`, `dept_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$dept_admin_id')";

              $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

              if ($fire_n) {
                $msg = array("icon"=>"success", "title"=>"Done", "text"=>"Expert User added successfully!");   
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
          $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Email Id already exist!");   
          echo json_encode($msg);
        }
      }else{
        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Expert User already exist!");   
        echo json_encode($msg);
      }
    }else{
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");   
      echo json_encode($msg);
    }
  }else{
    $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Only letters and white space allowed!");   
    echo json_encode($msg);
  }
}





/*****************************_______ get Eu id nd send details ______*************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    
    $id=mysqli_real_escape_string($con,trim($_POST['id']));

    $query = "SELECT * FROM expert_user INNER JOIN department ON expert_user.dept_id = department.dept_id WHERE eu_id ='$id'";

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






/************************_______update EU________***************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upd'])){

  if (!empty($_POST['eu_first_name']) && !empty($_POST['eu_last_name']) && !empty($_POST['eu_email'])) {

    $eu_id          = mysqli_real_escape_string($con,trim($_POST['eu_id']));
    $eu_first_name  = mysqli_real_escape_string($con,trim($_POST['eu_first_name']));
    $eu_first_name  = ucwords(strtolower($eu_first_name));

    $eu_last_name   = mysqli_real_escape_string($con,trim($_POST['eu_last_name']));
    $eu_last_name   = ucwords(strtolower($eu_last_name));

    $eu_email       = mysqli_real_escape_string($con,trim($_POST['eu_email']));

    if (preg_match("/^[a-zA-Z ]*$/",$eu_first_name) && preg_match("/^[a-zA-Z ]*$/",$eu_last_name)) {

      $q="SELECT * FROM expert_user WHERE eu_id=$eu_id";
      $f=mysqli_query($con,$q) or die("can not update data .".mysqli_error($con));
      $r=mysqli_fetch_assoc($f);

      $ok=0;

      if ($r['eu_email']!=$eu_email) {
  
        $q="SELECT * FROM expert_user WHERE eu_email='$eu_email'";
        $f = mysqli_query($con,$q) or die("can not get data .".mysqli_error($con));
        if (mysqli_num_rows($f)>0) {
          $ok=1;
        }
      }

      if ($ok ==0) {

        $query ="UPDATE expert_user SET eu_first_name = '$eu_first_name',eu_last_name = '$eu_last_name',eu_email = '$eu_email' WHERE eu_id=$eu_id";

        $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

        if ($fire) {
             
          $created_at= date("Y-m-d H:i:s");
          $activity_type= "expertuser";
          $activity_body= "You have updated Expert User of the department : ".$_SESSION['dept_name'].".";
          $dept_admin_id=$_SESSION['dept_admin_id'];

          $query_n = "INSERT INTO `dept_admin_activity`(`created_at`, `activity_type`, `activity_body`, `dept_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$dept_admin_id')";

          $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

          if ($fire_n) {
            $ms = array("icon"=>"success", "title"=>"Done", "text"=>"Expert User updated successfully!");
            echo json_encode($ms);
          }else{
            $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
            echo json_encode($ms);
          }
        }else{
          $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
          echo json_encode($ms);
        }
      }else{
        $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Duplicate Email Id!");    
        echo json_encode($ms);
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





/***************************_______delete college admin________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['del'])){

  if (!empty($_POST['delid'])) {

    $delid = mysqli_real_escape_string($con,trim($_POST['delid']));

    //get the details

    $q ="SELECT * FROM expert_user WHERE eu_id='$delid'";
    $f = mysqli_query($con,$q) or die("can not fetch data .".mysqli_error($con));
    $row = mysqli_fetch_assoc($f);

    //delete EU
    
    $query ="DELETE FROM expert_user WHERE eu_id='$delid'";
    $fire = mysqli_query($con,$query) or die("can not delete data .".mysqli_error($con));

    if ($fire) {

      //delete pro pic of deleted EU from folder if exist
      if (!empty($row['eu_img_link'])) {
        if (file_exists($row['eu_img_link'])) {
          unlink($row['eu_img_link']);
        }
      }

      //add to activity
      $created_at= date("Y-m-d H:i:s");
      $activity_type= "expertuser";
      $activity_body= "You have deleted Expert User of the department : ".$_SESSION['dept_name'].".";
      $dept_admin_id=$_SESSION['dept_admin_id'];

      $query_n = "INSERT INTO `dept_admin_activity`(`created_at`, `activity_type`, `activity_body`, `dept_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$dept_admin_id')";

      $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

      if ($fire_n) {
        $m = array("icon"=>"success", "title"=>"Done", "text"=>"Expert User deleted successfully!");    
        echo json_encode($m);
      }else{
        $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
        echo json_encode($m);
      } 
    }else{
      $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
      echo json_encode($m);
    }  
  }else{
    $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Id cannot be empty!");
    echo json_encode($m);
  }
}