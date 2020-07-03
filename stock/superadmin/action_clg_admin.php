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


/***************************_______Get College Admin Table________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readclgadmin'])) {
  
  $records = '<table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col" class="align-middle">Profile</th>
                    <th scope="col" class="align-middle">College Admin Name</th>
                    <th scope="col" class="align-middle">College Admin Email</th>
                    <th scope="col" class="align-middle">College Admin Ph.No</th>
                    <th scope="col" class="align-middle">College Name</th>
                    <th scope="col" colspan="2" class="align-middle">Action</th>
                  </tr>
                </thead>';

  $query = "SELECT * FROM college_admin INNER JOIN college ON college_admin.clg_id = college.clg_id";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      //$no=1;
      while ($clg_admin = mysqli_fetch_assoc($fire)) {

        if (!isset($clg_admin['clg_admin_img_link']) || !file_exists($clg_admin['clg_admin_img_link'])) {
          $clg_admin['clg_admin_img_link']="../uploads/default_image.png";
        }

      $records .='<tbody id="mTable">
                  <tr>    
                    
                    <td class="align-middle">
                        <img class=" table_img" src="'.$clg_admin['clg_admin_img_link'].'">
                    </td>

                    <td class="align-middle">'.$clg_admin['clg_admin_first_name'].'&nbsp'.$clg_admin['clg_admin_last_name'].'</td>
                    <td class="align-middle">'.$clg_admin['clg_admin_email'].'</td>
                    <td class="align-middle">'.$clg_admin['clg_admin_mobile'].'</td>
                    <td class="align-middle">'.$clg_admin['clg_name'].'</td>
                    <td class="align-middle">
                      <a type="button" id="up_clg" class="editbtn" onclick="getClgadmin('.$clg_admin['clg_admin_id'].')">Update</a>
                    </td>
                    <td class="align-middle">
                      <a type="button" id="del_ad" onclick="getDeladmin('.$clg_admin['clg_admin_id'].')">Delete</a>
                    </td>
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

function send_email($email,$pass,$name,$clg){

  
  //template file
  $template_file="./template.php";

  //basic email info
  $email_to = $email;
  $subject = "Congratulations! You are added as College Admin";

  //create swap variables array
  $swap_var = array(
    "{EMAIL_NAME}" => $name ,
    "{EMAIL_CLG}" => $clg ,
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





/***************************_______add college admin________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])){

  $clg_admin_first_name  = mysqli_real_escape_string($con,trim($_POST['clg_admin_first_name']));
  $clg_admin_first_name  = ucwords(strtolower($clg_admin_first_name));
  $clg_admin_last_name   = mysqli_real_escape_string($con,trim($_POST['clg_admin_last_name']));
  $clg_admin_last_name   = ucwords(strtolower($clg_admin_last_name));
  $clg_admin_email       = mysqli_real_escape_string($con,trim($_POST['clg_admin_email']));
  $clg_admin_password    = mysqli_real_escape_string($con,trim($_POST['clg_admin_password']));
  $clg_admin_password2   = mysqli_real_escape_string($con,trim($_POST['clg_admin_password2']));
  $clg_id                = mysqli_real_escape_string($con,trim($_POST['clg_id']));

  // check if name only contains letters and whitespace
  if (preg_match("/^[a-zA-Z ]*$/",$clg_admin_first_name) && preg_match("/^[a-zA-Z ]*$/",$clg_admin_last_name)) {
 
    $query = "SELECT * FROM college_admin WHERE clg_id = '$clg_id' ";
    $fire  = mysqli_query($con,$query) or die("can not fetch data into database. ".mysqli_error($con));

    if ($fire) {   
      
      if (mysqli_num_rows($fire) == 0) {

        $query = "SELECT * FROM college_admin WHERE clg_admin_email = '$clg_admin_email' ";
        $fire  = mysqli_query($con,$query) or die("can not fetch data into database. ".mysqli_error($con));

        if (mysqli_num_rows($fire) == 0) {

          if($clg_admin_password == $clg_admin_password2 && strlen($clg_admin_password)>=4) {

            $pass = $clg_admin_password;
          
            $clg_admin_password=md5($clg_admin_password);

            $query = "INSERT INTO college_admin(clg_admin_first_name, clg_admin_last_name, clg_admin_email, clg_admin_password, clg_id) VALUES('$clg_admin_first_name','$clg_admin_last_name','$clg_admin_email','$clg_admin_password','$clg_id')";

            $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));

            if ($fire) {

              $full_name=$clg_admin_first_name." ".$clg_admin_last_name;


              $q="SELECT * FROM college WHERE clg_id=$clg_id";
              $f = mysqli_query($con,$q) or die("can not fetch data .".mysqli_error($con));
              $rows=mysqli_fetch_assoc($f);

              send_email($clg_admin_email,$pass,$full_name,$rows['clg_name']);

              $created_at= date("Y-m-d H:i:s");
              $activity_type= "clgadmin";

              $activity_body= "You have added College Admin for : ".$rows['clg_name'].".";

              $sup_admin_id=$_SESSION['sup_admin_id'];

              $query_n = "INSERT INTO `sup_admin_activity`(`created_at`, `activity_type`, `activity_body`, `sup_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$sup_admin_id')";

              $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

              if ($fire_n) {
                $msg = array("icon"=>"success", "title"=>"Done", "text"=>"College Admin successfully added!");   
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
        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"College Admin for this college already exist!");   
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





/******************************___ get clgadmin id nd send details __*************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    
    $id=mysqli_real_escape_string($con,trim($_POST['id']));

    $query = "SELECT * FROM college_admin INNER JOIN college ON college_admin.clg_id = college.clg_id WHERE clg_admin_id ='$id'";

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






/***************************_______update college admin________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upd'])){

  if (!empty($_POST['clg_admin_first_name']) && !empty($_POST['clg_admin_last_name']) && !empty($_POST['clg_admin_email'])) {

    $clg_admin_id          = mysqli_real_escape_string($con,trim($_POST['clg_admin_id']));
    $clg_admin_first_name  = mysqli_real_escape_string($con,trim($_POST['clg_admin_first_name']));
    $clg_admin_first_name  = ucwords(strtolower($clg_admin_first_name));
    $clg_admin_last_name   = mysqli_real_escape_string($con,trim($_POST['clg_admin_last_name']));
    $clg_admin_last_name   = ucwords(strtolower($clg_admin_last_name));
    $clg_admin_email       = mysqli_real_escape_string($con,trim($_POST['clg_admin_email']));

    if (preg_match("/^[a-zA-Z ]*$/",$clg_admin_first_name) && preg_match("/^[a-zA-Z ]*$/",$clg_admin_last_name)) {
      
      //get the current id details
      $q="SELECT * FROM college_admin WHERE clg_admin_id=$clg_admin_id";
      $f = mysqli_query($con,$q) or die("can not data .".mysqli_error($con));
      $r=mysqli_fetch_assoc($f);

      $ok=0;

      if ($clg_admin_email!=$r['clg_admin_email']) {
  
        $q="SELECT * FROM college_admin WHERE clg_admin_email='$clg_admin_email'";
        $f = mysqli_query($con,$q) or die("can not get data .".mysqli_error($con));
        if (mysqli_num_rows($f)>0) {
          $ok=1;
        }
      }

      if ($ok ==0) {

        $query ="UPDATE college_admin SET clg_admin_first_name = '$clg_admin_first_name',clg_admin_last_name = '$clg_admin_last_name',clg_admin_email = '$clg_admin_email' WHERE clg_admin_id=$clg_admin_id";

        $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

        if ($fire) {

          //$q="SELECT * FROM college_admin WHERE clg_admin_id=$clg_admin_id";
          //$f = mysqli_query($con,$q) or die("can not fetch data .".mysqli_error($con));
          //$row=mysqli_fetch_assoc($f);
        
          $clg_id=$r['clg_id'];

          $q="SELECT * FROM college WHERE clg_id=$clg_id";
          $f = mysqli_query($con,$q) or die("can not show data .".mysqli_error($con));
          $rows=mysqli_fetch_assoc($f);

          //add to activity
          $created_at= date("Y-m-d H:i:s");
          $activity_type= "clgadmin";

          $activity_body= "You have updated College Admin of : ".$rows['clg_name'].".";

          $sup_admin_id=$_SESSION['sup_admin_id'];

          $query_n = "INSERT INTO `sup_admin_activity`(`created_at`, `activity_type`, `activity_body`, `sup_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$sup_admin_id')";

          $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

          if ($fire_n) {  
            $ms = array("icon"=>"success", "title"=>"Done", "text"=>"College Admin successfully updated!");
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

    //get the admins details

    $q ="SELECT * FROM college_admin WHERE clg_admin_id='$delid'";
    $f = mysqli_query($con,$q) or die("can not fetch data .".mysqli_error($con));
    $row=mysqli_fetch_assoc($f);

    //delete the college admin

    $query ="DELETE FROM college_admin WHERE clg_admin_id='$delid'";
    $fire = mysqli_query($con,$query) or die("can not delete data .".mysqli_error($con));

    if ($fire) {

      //delete admins pro pic from the folder if exist
      
      if (!empty($row['clg_admin_img_link'])) {
        if (file_exists($row['clg_admin_img_link'])) {
          unlink($row['clg_admin_img_link']);
        }
      }

      //get the college name

      $clg_id=$row['clg_id'];

      $q ="SELECT * FROM college WHERE clg_id=$clg_id";
      $f = mysqli_query($con,$q) or die("can not show data .".mysqli_error($con));
      $rows=mysqli_fetch_assoc($f);

      //add to the activity
      $created_at= date("Y-m-d H:i:s");
      $activity_type= "clgadmin";

      $activity_body= "You have deleted College Admin of : ".$rows['clg_name'].".";

      $sup_admin_id=$_SESSION['sup_admin_id'];

      $query_n = "INSERT INTO `sup_admin_activity`(`created_at`, `activity_type`, `activity_body`, `sup_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$sup_admin_id')";

      $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

      if ($fire_n) {
        $m = array("icon"=>"success", "title"=>"Done", "text"=>"College Admin deleted successfully!");
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
    $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Id cannot be Empty!");
    echo json_encode($m);
  }
}