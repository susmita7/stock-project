<?php require "../config/config.php"; 
  session_start();
  
  // check if clg admin logged in or not
  if ($_SESSION['is_ca_login']) {  
    //keep user on page
  }else{
    //redirect on loginpage
    header("Location: login");
  }

extract($_POST);


date_default_timezone_set("Asia/kolkata");


/*************************************_____Get dept Admin Table________**************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readdeptadmin'])) {
  
  $records = '<table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col" class="align-middle">Profile</th>
                    <th scope="col" class="align-middle">Department Admin Name</th>
                    <th scope="col" class="align-middle">Department Admin Email</th>
                    <th scope="col" class="align-middle">Department Admin Ph.No</th>
                    <th scope="col" class="align-middle">Department Name</th>
                    <th scope="col" colspan="2" class="align-middle">Action</th>
                  </tr>
                </thead>';

  $query = "SELECT * FROM department_admin INNER JOIN department ON department_admin.dept_id = department.dept_id AND department.clg_id='".$_SESSION['clg_id']."'";

  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      
      while ($dept_admin = mysqli_fetch_assoc($fire)) {

        if (!isset($dept_admin['dept_admin_img_link']) || !file_exists($dept_admin['dept_admin_img_link'])) {
          $dept_admin['dept_admin_img_link']="../uploads/default_image.png";
        }

      $records .='<tbody id="myTable">
                  <tr>

                    <td class="align-middle">
                        <img class=" table_img" src="'.$dept_admin['dept_admin_img_link'].'">
                    </td>

                    <td class="align-middle">'.$dept_admin['dept_admin_first_name'].'&nbsp'.$dept_admin['dept_admin_last_name'].'</td>
                    <td class="align-middle">'.$dept_admin['dept_admin_email'].'</td>
                    <td class="align-middle">'.$dept_admin['dept_admin_mobile'].'</td>
                    <td class="align-middle">'.$dept_admin['dept_name'].'</td>
                    <td class="align-middle">
                      <a type="button" id="up_clg" class="editbtn" onclick="getDeptadmin('.$dept_admin['dept_admin_id'].')">Update</a>
                    </td>
                    <td class="align-middle">
                      <a type="button" id="del_ad" onclick="getDeladmin('.$dept_admin['dept_admin_id'].')">Delete</a></td>
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
  $subject = "Congratulations! You are added as Department Admin";

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






/****************************_______  add dept admin  ________*****************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])){

  $dept_admin_first_name  = mysqli_real_escape_string($con,trim($_POST['dept_admin_first_name']));
  $dept_admin_first_name  = ucwords(strtolower($dept_admin_first_name));
  $dept_admin_last_name   = mysqli_real_escape_string($con,trim($_POST['dept_admin_last_name']));
  $dept_admin_last_name   = ucwords(strtolower($dept_admin_last_name));
  $dept_admin_email       = mysqli_real_escape_string($con,trim($_POST['dept_admin_email']));
  $dept_admin_password    = mysqli_real_escape_string($con,trim($_POST['dept_admin_password']));
  $dept_admin_password2   = mysqli_real_escape_string($con,trim($_POST['dept_admin_password2']));
  $dept_id                = mysqli_real_escape_string($con,trim($_POST['dept_id']));
  //$clg_id                 = mysqli_real_escape_string($con,trim($_POST['clg_id']));

  // check if name only contains letters and whitespace
  if (preg_match("/^[a-zA-Z ]*$/",$dept_admin_first_name) && preg_match("/^[a-zA-Z ]*$/",$dept_admin_last_name)) {
 
    $query = "SELECT * FROM department_admin WHERE dept_id = '$dept_id' ";
    $fire  = mysqli_query($con,$query) or die("can not show data from database. ".mysqli_error($con));

    if ($fire) {
        
      if (mysqli_num_rows($fire) == 0) {

        $query = "SELECT * FROM department_admin WHERE dept_admin_email = '$dept_admin_email' ";
        $fire  = mysqli_query($con,$query) or die("can not fetch data into database. ".mysqli_error($con));

        if (mysqli_num_rows($fire) == 0) {

          if($dept_admin_password == $dept_admin_password2 && strlen($dept_admin_password)>=4) {

            $pass = $dept_admin_password;
                
            $dept_admin_password=md5($dept_admin_password);

            $query = "INSERT INTO department_admin(dept_admin_first_name,dept_admin_last_name,dept_admin_email,dept_admin_password,dept_id) VALUES('$dept_admin_first_name','$dept_admin_last_name','$dept_admin_email','$dept_admin_password','$dept_id')";

            $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));

            if ($fire) {

              $full_name=$dept_admin_first_name." ".$dept_admin_last_name;

              $q = "SELECT * FROM department WHERE dept_id='$dept_id'";
              $f = mysqli_query($con,$q) or die("can not show data from database. ".mysqli_error($con));
              $row=mysqli_fetch_assoc($f);

              //send mail

              send_email($dept_admin_email,$pass,$full_name,$row['dept_name']);

              //add to activity

              $created_at= date("Y-m-d H:i:s");
              $activity_type= "deptadmin";
              $activity_body= "You have added Department Admin for department : ".$row['dept_name'].".";
              $clg_admin_id=$_SESSION['clg_admin_id'];

              $query_n = "INSERT INTO `clg_admin_activity`(`created_at`, `activity_type`, `activity_body`, `clg_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$clg_admin_id')";

              $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

              if ($fire_n) {
                $msg = array("icon"=>"success", "title"=>"Done", "text"=>"Department Admin added successfully!");   
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
        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Department Admin for this department already exist!");   
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





/*____________________________  get dept admin id nd send details  _________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    
  $id=mysqli_real_escape_string($con,trim($_POST['id']));

  $query = "SELECT * FROM department_admin INNER JOIN department ON department_admin.dept_id = department.dept_id WHERE dept_admin_id ='$id'";

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





/*__________________________________  update department admin  ____________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upd'])){

  if (!empty($_POST['dept_admin_first_name']) && !empty($_POST['dept_admin_last_name']) && !empty($_POST['dept_admin_email'])) {

    $dept_admin_id          = mysqli_real_escape_string($con,trim($_POST['dept_admin_id']));
    $dept_admin_first_name  = mysqli_real_escape_string($con,trim($_POST['dept_admin_first_name']));
    $dept_admin_first_name  = ucwords(strtolower($dept_admin_first_name));
    $dept_admin_last_name   = mysqli_real_escape_string($con,trim($_POST['dept_admin_last_name']));
    $dept_admin_last_name   = ucwords(strtolower($dept_admin_last_name));
    $dept_admin_email       = mysqli_real_escape_string($con,trim($_POST['dept_admin_email']));

    if (preg_match("/^[a-zA-Z ]*$/",$dept_admin_first_name) && preg_match("/^[a-zA-Z ]*$/",$dept_admin_last_name)) {

      //get the current id details
      $q = "SELECT * FROM department_admin WHERE dept_admin_id='$dept_admin_id'";
      $f = mysqli_query($con,$q) or die("can not show data from database. ".mysqli_error($con));
      $row=mysqli_fetch_assoc($f);

      $ok=0;

      if ($dept_admin_email!=$row['dept_admin_email']) {
  
        $q="SELECT * FROM department_admin WHERE dept_admin_email='$dept_admin_email'";
        $f = mysqli_query($con,$q) or die("can not get data .".mysqli_error($con));
        if (mysqli_num_rows($f)>0) {
          $ok=1;
        }
      }

      if ($ok ==0) {

        $query ="UPDATE department_admin SET dept_admin_first_name = '$dept_admin_first_name',dept_admin_last_name = '$dept_admin_last_name',dept_admin_email = '$dept_admin_email' WHERE dept_admin_id=$dept_admin_id";

        $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

        if ($fire) {

          $q = "SELECT * FROM department WHERE dept_id='".$row['dept_id']."'";
          $f = mysqli_query($con,$q) or die("can not show data from database. ".mysqli_error($con));
          $r=mysqli_fetch_assoc($f);   
        
          $created_at= date("Y-m-d H:i:s");
          $activity_type= "deptadmin";
          $activity_body= "You have updated Department Admin of department : ".$r['dept_name'].".";
          $clg_admin_id=$_SESSION['clg_admin_id'];

          $query_n = "INSERT INTO `clg_admin_activity`(`created_at`, `activity_type`, `activity_body`, `clg_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$clg_admin_id')";

          $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

          if ($fire_n) {
            $ms = array("icon"=>"success", "title"=>"Done", "text"=>"Department Admin updated successfully!");
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
    $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Name or Email cannot be empty!");
    echo json_encode($ms);
  }
}





/*____________________________  delete college admin  ____________________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['del'])){

  if (!empty($_POST['delid'])) {

    $delid = mysqli_real_escape_string($con,trim($_POST['delid']));

    //get the admins details

    $q = "SELECT * FROM department_admin WHERE dept_admin_id='$delid'";
    $f = mysqli_query($con,$q) or die("can not show data from database. ".mysqli_error($con));
    $row=mysqli_fetch_assoc($f);

    //delete admin
    
    $query ="DELETE FROM department_admin WHERE dept_admin_id='$delid'";
    $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

    if ($fire) {

      //delete pro pic from the folder if exist
      if (!empty($row['dept_admin_img_link'])) {
        if (file_exists($row['dept_admin_img_link'])) {
          unlink($row['dept_admin_img_link']);
        }
      }

      //get the dept

      $q = "SELECT * FROM department WHERE dept_id='".$row['dept_id']."'";
      $f = mysqli_query($con,$q) or die("can not show data from database. ".mysqli_error($con));
      $r=mysqli_fetch_assoc($f);

      //add to activity

      $created_at= date("Y-m-d H:i:s");
      $activity_type= "deptadmin";
      $activity_body= "You have deleted Department Admin of department : ".$r['dept_name'].".";
      $clg_admin_id=$_SESSION['clg_admin_id'];

      $query_n = "INSERT INTO `clg_admin_activity`(`created_at`, `activity_type`, `activity_body`, `clg_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$clg_admin_id')";

      $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

      if ($fire_n) {
        $m = array("icon"=>"success", "title"=>"Done", "text"=>"Department Admin has been deleted successfully!");
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