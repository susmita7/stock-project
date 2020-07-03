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


/***************************_______Get Departments Table________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readdept'])) {
  
  $record = '<table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="align-middle" scope="col">SL No.</th>
                        <th class="align-middle" scope="col">Department Name</th>
                        <th class="align-middle" scope="col">College Name</th>
                        <th class="align-middle" scope="col">Action</th>
                    </tr>
                </thead>';
  
  $query = "SELECT * FROM department INNER JOIN college ON department.clg_id = college.clg_id AND department.clg_id= '".$_SESSION['clg_id']."'";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      $no=1;
      while ($dept = mysqli_fetch_assoc($fire)) {

      $record .='<tbody id="myTable">
                  <tr>    
                    <td class="align-middle">'.$no.'</td>
                    <td class="align-middle">'.$dept['dept_name'].'</td>
                    <td class="align-middle">'.$dept['clg_name'].'</td>
                    <td class="align-middle">
                      <a type="button" id="up_clg" class="editbtn" onclick="getDept('.$dept['dept_id'].')">Update</a>
                    </td>
                  </tr>';
                  $no++;
      }
  }else{
    $record .='<tbody>
              <tr>
                <td class="align-middle" scope="col" colspan="4">No Records Available</td>
              </tr>';
  }
  $record .='</tbody>
            </table>';
  echo $record;
}





/****************************_______  add department  ________*************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])){
  
  if (!empty($_POST['dept_name'])) {

    $dept_name     = mysqli_real_escape_string($con,trim($_POST['dept_name']));
    $dept_name     = ucwords(strtolower($dept_name));
    $clg_id        = mysqli_real_escape_string($con,trim($_POST['clg_id']));

    // check if name only contains letters and whitespace
    if (preg_match("/^[a-zA-Z& ]*$/",$dept_name)) {
 
      $query = "SELECT * FROM department WHERE dept_name ='$dept_name'";
      $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

      if ($fire) {
        
        if (mysqli_num_rows($fire) == 0) {

          $query = "INSERT INTO department(dept_name,clg_id) VALUES ('$dept_name','$clg_id')";
          $fire  = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));
              
          if ($fire) {

            $created_at= date("Y-m-d H:i:s");
            $activity_type= "department";
            $activity_body= "You have added department : ".$dept_name.".";
            $clg_admin_id=$_SESSION['clg_admin_id'];

            $query_n = "INSERT INTO `clg_admin_activity`(`created_at`, `activity_type`, `activity_body`, `clg_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$clg_admin_id')";

            $fire_n = mysqli_query($con,$query_n) or die("can not update data. ".mysqli_error($con));

            if($fire_n){ 
              $msg = array("icon"=>"success", "title"=>"Done", "text"=>"Department successfully added!");    
              echo json_encode($msg);               
            }else{
              $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
              echo json_encode($msg);
            }  
          }else{
            $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Sorry, something went wrong!");    
            echo json_encode($msg); 
          }
        }else{    
          $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Department already exist!");
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
  }else{
    $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Department name cannot be empty!");    
    echo json_encode($msg);
  }
}





/*******************************_______  get dept id nd send details  _____********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    
    $id=mysqli_real_escape_string($con,trim($_POST['id']));

    $query = "SELECT * FROM department INNER JOIN college ON department.clg_id = college.clg_id WHERE dept_id ='$id'";
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





/*******************************_______  update department  ________***********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upd'])){
  
  if (isset($_POST['name_dept']) && isset($_POST['id_dept'])) {
    
    $id_dept       = mysqli_real_escape_string($con,trim($_POST['id_dept']));
    $name_dept     = mysqli_real_escape_string($con,trim($_POST['name_dept']));
    $name_dept     = ucwords(strtolower($name_dept));

    // check if name only contains letters and whitespace
    if (preg_match("/^[a-zA-Z& ]*$/",$name_dept)) {

      $query = "SELECT * FROM department WHERE dept_name ='$name_dept'";
      $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

      if ($fire) {
        
        if (mysqli_num_rows($fire) == 0) {

          $q="SELECT * FROM department WHERE dept_id='$id_dept'";
          $f=mysqli_query($con,$q) or die("can not show data from database. ".mysqli_error($con));
          $row=mysqli_fetch_assoc($f);

          $query = "UPDATE department SET dept_name ='$name_dept' WHERE dept_id=$id_dept";
          $fire  = mysqli_query($con,$query) or die("can not update data in database. ".mysqli_error($con));

          if ($fire) {

            $created_at= date("Y-m-d H:i:s");
            $activity_type= "department";
            $activity_body= "You have updated department : ".$row['dept_name']." to ".$name_dept.".";
            $clg_admin_id=$_SESSION['clg_admin_id'];

            $query_n = "INSERT INTO `clg_admin_activity`(`created_at`, `activity_type`, `activity_body`, `clg_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$clg_admin_id')";

            $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

            if ($fire_n) {
              $msgs = array("icon"=>"success", "title"=>"Done", "text"=>"Department updated successfully!");
              echo json_encode($msgs);
            }else{
              $msgs = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
              echo json_encode($msgs);
            }
          }else{  
            $msgs = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
            echo json_encode($msgs); 
          }
        }else{     
          $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Department already exist!");
          echo json_encode($msg);
        }
      }else{
        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Sorry, something went wrong!");    
        echo json_encode($msg);
      }
    }else{
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Only letters and white space allowed!");   
      echo json_encode($msg);
    }
  }else{
    $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Department name cannot be empty!");    
    echo json_encode($msg);
  }
}