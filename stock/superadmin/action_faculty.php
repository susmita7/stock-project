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


/***************************_______Get Faculty Table________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readfaculty'])) {
  
  $record = '<table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="align-middle" scope="col">SL No.</th>
                    <th class="align-middle" scope="col">Faculty Name</th>
                    <th class="align-middle" scope="col">Action</th>
                  </tr>
                </thead>';

  $query = "SELECT * FROM faculty ORDER BY faculty_id ASC";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      $no=1;
      while ($faculty = mysqli_fetch_assoc($fire)) {

        $record .='<tbody id="myTable">
                  <tr>    
                      <td class="align-middle">'.$no.'</td>
                      <td class="align-middle">'.$faculty['faculty_name'].'</td>
                      <td class="align-middle">
                          <a type="button" id="up_clg" class="editbtn" onclick="getFaculty('.$faculty['faculty_id'].')">Update</a>
                      </td>
                  </tr>';
                  $no++;
      }
  }else{
    $record .='<tbody>
              <tr>
                <td class="align-middle" scope="col" colspan="3">No Records Available</td>
              </tr>';
  }
  $record .='</tbody>
            </table>';
  echo $record;
}





/***************************_______  add Faculty  ________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['faculty_name'])){
  
  if (!empty($_POST['faculty_name'])) {

    $faculty_name     = mysqli_real_escape_string($con,trim($_POST['faculty_name']));
    $faculty_name     = ucwords(strtolower($faculty_name));

    // check if name only contains letters and whitespace
    if (preg_match("/^[a-zA-Z ]*$/",$faculty_name)) {
 
      $query = "SELECT * FROM faculty WHERE faculty_name ='$faculty_name'";
      $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

      if ($fire) {
          
        if (mysqli_num_rows($fire) == 0) {

          $query = "INSERT INTO faculty(faculty_name) VALUES ('$faculty_name')";
          $fire  = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));
              
          if ($fire) {

            $created_at= date("Y-m-d H:i:s");
            $activity_type= "faculty";

            $activity_body= "You have added faculty : ".$faculty_name.".";

            $sup_admin_id=$_SESSION['sup_admin_id'];

            $query_n = "INSERT INTO `sup_admin_activity`(`created_at`, `activity_type`, `activity_body`, `sup_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$sup_admin_id')";

            $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

            if ($fire_n) {
              $msg = array("icon"=>"success", "title"=>"Done", "text"=>"Faculty Added Successfully!");    
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
          $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Faculty already exist!");
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
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Faculty name cannot be empty!");    
      echo json_encode($msg);
  }
}





/******************************___ get faculty id nd send details __*************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    
    $id=mysqli_real_escape_string($con,trim($_POST['id']));

    $query = "SELECT * FROM faculty WHERE faculty_id ='$id'";
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





/***************************_______  update faculty  ________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upd'])){
  
  if (!empty($_POST['name_faculty']) && !empty($_POST['id_faculty'])) {
    
    $id_faculty       = mysqli_real_escape_string($con,trim($_POST['id_faculty']));
    $name_faculty     = mysqli_real_escape_string($con,trim($_POST['name_faculty']));
    $name_faculty     = ucwords(strtolower($name_faculty));

    // check if name only contains letters and whitespace
    if (preg_match("/^[a-zA-Z ]*$/",$name_faculty)) {

      $query = "SELECT * FROM faculty WHERE faculty_name ='$name_faculty'";
      $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

      if ($fire) {
        
        if (mysqli_num_rows($fire) == 0) {

          $q="SELECT * FROM faculty WHERE faculty_id='$id_faculty'";
          $f=mysqli_query($con,$q) or die("can not get data from database. ".mysqli_error($con));
          $row=mysqli_fetch_assoc($f);

          $query = "UPDATE faculty SET faculty_name ='$name_faculty' WHERE faculty_id='$id_faculty'";
          $fire  = mysqli_query($con,$query) or die("can not update data in database. ".mysqli_error($con));

          if ($fire) {

            //$q="SELECT * FROM faculty WHERE faculty_id='$id_faculty'";
            //$f=mysqli_query($con,$q) or die("can not get data from database. ".mysqli_error($con));
            //$r=mysqli_fetch_assoc($f);

            $created_at= date("Y-m-d H:i:s");
            $activity_type= "faculty";

            $activity_body= "You have updated faculty : ".$row['faculty_name']." to ".$name_faculty.".";

            $sup_admin_id=$_SESSION['sup_admin_id'];

            $query_n = "INSERT INTO `sup_admin_activity`(`created_at`, `activity_type`, `activity_body`, `sup_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$sup_admin_id')";

            $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

            if ($fire_n) {
              $msgs = array("icon"=>"success", "title"=>"Done", "text"=>"Faculty updated successfully!");
              echo json_encode($msgs);
            }else{
              $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
              echo json_encode($msg);
            }
          }else{  
            $msgs = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
            echo json_encode($msgs); 
          }
        }else{    
          $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Faculty name already exist!");
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
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Faculty Name Cannot Be Empty!");    
      echo json_encode($msg);
  }
}