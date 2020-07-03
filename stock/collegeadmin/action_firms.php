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


/************************************_______  Get firms Table  ________*********************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readfirms'])) {
  
  $record = '<table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th class="align-middle" scope="col">Sl No.</th>
                  <th class="align-middle" scope="col">Firm Name</th>
                  <th class="align-middle" scope="col">Owner Name</th>
                  <th class="align-middle" scope="col">Email Id</th>
                  <th class="align-middle" scope="col">Phone No</th>
                  <th class="align-middle" scope="col">Address</th>
                  <th class="align-middle" scope="col" colspan="3">Action</th>
                </tr>
              </thead>';
  
  $query = "SELECT * FROM firm WHERE clg_id= '".$_SESSION['clg_id']."'";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      $no=1;
      while ($firm = mysqli_fetch_assoc($fire)) {

      $record .='<tbody id="myTable">
                  <tr>    
                    <td class="align-middle">'.$no.'</td>
                    <td class="align-middle">'.$firm['firm_name'].'</td>
                    <td class="align-middle">'.$firm['owner_name'].'</td>
                    <td class="align-middle">'.$firm['firm_email'].'</td>
                    <td class="align-middle">'.$firm['firm_mobile'].'</td>
                    <td class="align-middle">'.$firm['firm_address'].'</td>

                    <td class="align-middle">
                      <a id="email" type="button" onclick="getMail('.$firm['firm_id'].')">Contact</a>
                    </td>
                    <td class="align-middle">
                      <a type="button" id="up_clg" class="editbtn" onclick="getFirm('.$firm['firm_id'].')">Update</a>
                    </td>
                    <td class="align-middle">
                      <a id="del_ad" type="button" onclick="delFirm('.$firm['firm_id'].')">Delete</a></td>
                    </td>
                  </tr>';
                  $no++;
      }
  }else{
    $record .='<tbody>
              <tr>
                <td class="align-middle" scope="col" colspan="8">No Records Available</td>
              </tr>';
  }
  $record .='</tbody>
            </table>';
  echo $record;
}





/*****************************___ sending email to CA when SA added CA __****************************/

function send_email($email,$fname,$sub,$msg,$name,$clg){

  
  //template file
  $template_file="./template_firm.php";

  //basic email info
  $email_to = $email;
  $subject = "Notification for tender";

  //create swap variables array
  $swap_var = array(
    "{EMAIL_FIRM}" => $fname ,
    "{EMAIL_TITLE}" => $sub ,
    "{EMAIL_MSG}" => $msg ,
    "{EMAIL_NAME}" => $name ,
    "{EMAIL_CLG}" => $clg
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
    return true;
  }else{
    return false;
  }
}





/***********************************_______  add firm  ________**********************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])){

  $firm_name    = mysqli_real_escape_string($con,trim($_POST['firm_name']));
  $firm_name    = ucwords(strtolower($firm_name));
  $owner_name   = mysqli_real_escape_string($con,trim($_POST['owner_name']));
  $owner_name   = ucwords(strtolower($owner_name));
  $firm_email   = mysqli_real_escape_string($con,trim($_POST['firm_email']));
  $firm_mobile  = mysqli_real_escape_string($con,trim($_POST['firm_mobile']));
  $firm_address = mysqli_real_escape_string($con,trim($_POST['firm_address']));
  $firm_address = ucwords(strtolower($firm_address));
  $clg_id       = mysqli_real_escape_string($con,trim($_POST['clg_id']));

 
  $query = "SELECT * FROM firm WHERE firm_name = '$firm_name' AND clg_id='$clg_id' ";
  $fire  = mysqli_query($con,$query) or die("can not show data. ".mysqli_error($con));

  if ($fire) {
        
    if (mysqli_num_rows($fire) == 0) {

      $query = "INSERT INTO firm(firm_name,owner_name,firm_email,firm_mobile,firm_address,clg_id) VALUES('$firm_name','$owner_name','$firm_email','$firm_mobile','$firm_address','$clg_id')";

      $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));

      if ($fire) {

        //add to history
        $created_at= date("Y-m-d H:i:s");
        $activity_type= "firm";
        $activity_body= "You have added Firm : " ;
        $other ="Name : ".$firm_name.". Mobile no. : ".$firm_mobile.". Email : ".$firm_email;
        $clg_admin_id=$_SESSION['clg_admin_id'];

        $query_n = "INSERT INTO `clg_admin_activity`(`created_at`, `activity_type`, `activity_body`, `other`, `clg_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$other','$clg_admin_id')";

        $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

        if ($fire_n) {
          $msg = array("icon"=>"success", "title"=>"Done", "text"=>"Firm successfully added!");   
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
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Sorry, firm already exist!");   
      echo json_encode($msg);
    }
  }else{
    $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");   
    echo json_encode($msg);
  }
}





/**********************************_____  get firm id nd send details  _____**********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    
    $id=mysqli_real_escape_string($con,trim($_POST['id']));

    $query = "SELECT * FROM firm WHERE firm_id ='$id'";

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





/**********************************_________  update firm  ________**********************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upd'])){

  
  $firm_id               = mysqli_real_escape_string($con,trim($_POST['firm_id']));
  $name_firm             = mysqli_real_escape_string($con,trim($_POST['name_firm']));
  $name_firm             = ucwords(strtolower($name_firm));
  $name_owner            = mysqli_real_escape_string($con,trim($_POST['name_owner']));
  $name_owner            = ucwords(strtolower($name_owner));
  $email_firm            = mysqli_real_escape_string($con,trim($_POST['email_firm']));
  $mobile_firm           = mysqli_real_escape_string($con,trim($_POST['mobile_firm']));
  $address_firm          = mysqli_real_escape_string($con,trim($_POST['address_firm']));
  $address_firm          = ucwords(strtolower($address_firm));


  $q="SELECT * FROM firm WHERE firm_id='$firm_id'";
  $f=mysqli_query($con,$q) or die("can not show data .".mysqli_error($con));
  $row=mysqli_fetch_assoc($f);

  $ok=0;

  if ($name_firm!=$row['firm_name']) {

    $clg_id=$row['clg_id'];
  
    $q="SELECT * FROM firm WHERE firm_name = '$name_firm' AND clg_id='$clg_id' ";
    $f = mysqli_query($con,$q) or die("can not get data .".mysqli_error($con));
    if (mysqli_num_rows($f)>0) {
      $ok=1;
    }
  }

  if ($ok ==0) {

    $query ="UPDATE firm SET firm_name = '$name_firm',owner_name = '$name_owner',firm_email = '$email_firm',firm_mobile = '$mobile_firm',firm_address = '$address_firm' WHERE firm_id=$firm_id";

    $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

    if ($fire) { 
            
      $created_at= date("Y-m-d H:i:s");
      $activity_type= "firm";
      $activity_body= "You have updated Firm :";
      $other ="Name : ".$name_firm.". Mobile no. : ".$mobile_firm.". Email : ".$email_firm;
      $clg_admin_id=$_SESSION['clg_admin_id'];

      $query_n = "INSERT INTO `clg_admin_activity`(`created_at`, `activity_type`, `activity_body`, `other`, `clg_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$other','$clg_admin_id')";

      $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

      if ($fire_n) {
        $ms = array("icon"=>"success", "title"=>"Done", "text"=>"Firm has been updated successfully!");
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
    $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Firm already exist!");    
    echo json_encode($ms); 
  }
}





/********************************________  delete firm  ________***********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['del'])){

  if (!empty($_POST['delid'])) {

    $delid = mysqli_real_escape_string($con,trim($_POST['delid']));

    $q="SELECT * FROM firm WHERE firm_id='$delid'";
    $f=mysqli_query($con,$q) or die("can not show data .".mysqli_error($con));
    $row=mysqli_fetch_assoc($f);
    
    $query ="DELETE FROM firm WHERE firm_id='$delid'";

    $fire = mysqli_query($con,$query) or die("can not delete data .".mysqli_error($con));

    if ($fire) {

      $created_at= date("Y-m-d H:i:s");
      $activity_type= "firm";
      $activity_body= "You have deleted the Firm named : ".$row['firm_name'];
      $clg_admin_id=$_SESSION['clg_admin_id'];

      $query_n = "INSERT INTO `clg_admin_activity`(`created_at`, `activity_type`, `activity_body`, `clg_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$clg_admin_id')";

      $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

      if ($fire_n) {
        $m = array("icon"=>"success", "title"=>"Done", "text"=>"Firm has been deleted successfully!");
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





/**********************************_______  send mail to firm  ________***************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send'])){

  $our_email  = mysqli_real_escape_string($con,trim($_POST['our_email']));
  
  $to_email   = mysqli_real_escape_string($con,trim($_POST['to_email']));

  $subject    = mysqli_real_escape_string($con,trim($_POST['subject']));
  $subject    = ucwords(strtolower($subject));

  $body       = mysqli_real_escape_string($con,trim($_POST['body']));
  //$body       = ucwords($body);

  $clg_name   = mysqli_real_escape_string($con,trim($_SESSION['clg_name']));
  $first_name = mysqli_real_escape_string($con,trim($_SESSION['clg_admin_first_name']));
  $last_name  = mysqli_real_escape_string($con,trim($_SESSION['clg_admin_last_name']));

  $name=$first_name." ".$last_name;

  //$headers = "From: stockpile52@gmail.com";

  $firm_name =mysqli_real_escape_string($con,trim($_POST['firm_name']));

  //send email
  $result = send_email($to_email,$firm_name,$subject,$body,$name,$clg_name);

  if ($result==true) {

    //add to history
    $created_at= date("Y-m-d H:i:s");
    $activity_type= "firm";
    $activity_body= "You have sent email to the Firm email : ".$to_email.".";
    $other = "Subject : ".$subject.". Message : ".$body;
    $clg_admin_id=$_SESSION['clg_admin_id'];

    $query_n = "INSERT INTO `clg_admin_activity`(`created_at`, `activity_type`, `activity_body`, `other`, `clg_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$other','$clg_admin_id')";

    $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

    if ($fire_n) {
      $msg = array("icon"=>"success", "title"=>"Done", "text"=>"Email successfully sent!");   
      echo json_encode($msg);
    }else{
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");   
      echo json_encode($msg);
    }
  }else{
    $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");   
    echo json_encode($msg);
  }
}