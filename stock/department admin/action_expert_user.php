<?php require "../config/config.php"; 
  session_start();
  
  // check if super admin logged in or not
  if ($_SESSION['is_da_login']) {  
    //keep user on page
  }else{
    //redirect on loginpage
    header("Location: login");
  }

extract($_POST);


/*************************************_____Get dept Admin Table________**************************************/

if (isset($_POST['readexpertuser'])) {
  
  $records = '<table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col" class="align-middle">SL No.</th>
                    <th scope="col" class="align-middle">Profile</th>
                    <th scope="col" class="align-middle">Expert User Name</th>
                    <th scope="col" class="align-middle">Expert User Email</th>
                    <th scope="col" class="align-middle">Phone No</th>
                    <th scope="col" class="align-middle">Department Name</th>
                    <th scope="col" colspan="2" class="align-middle">Action</th>
                  </tr>
                </thead>
              <tbody id="myTable">';

  $query = "SELECT * FROM expert_user INNER JOIN department ON expert_user.dept_id = department.dept_id AND expert_user.dept_id='".$_SESSION['dept_id']."'";

  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      $no=1;
      while ($expert_user = mysqli_fetch_assoc($fire)) {

        if (!isset($expert_user['eu_img_link'])) {
          $expert_user['eu_img_link']="../uploads/default_image.png";
        }

      $records .='<tr>    
                    <td class="align-middle">'.$no.'</td>

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
                  $no++;
      }
  }else{
    $records .='<tr>
                <td class="align-middle" scope="col" colspan="7">No records availble</td>
              </tr>';
  }
  $records .='</tbody>
            </table>';
  echo $records;
}

/**************************************____ end of dept admin table ____*************************************/






/**************************************_______add dept admin________*****************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])){

    $eu_first_name  = mysqli_real_escape_string($con,trim($_POST['eu_first_name']));
    $eu_first_name  = ucwords(strtolower($eu_first_name));
    $eu_last_name   = mysqli_real_escape_string($con,trim($_POST['eu_last_name']));
    $eu_last_name   = ucwords(strtolower($eu_last_name));
    $eu_email       = mysqli_real_escape_string($con,trim($_POST['eu_email']));
    $eu_password    = mysqli_real_escape_string($con,trim($_POST['eu_password']));
    $eu_password2   = mysqli_real_escape_string($con,trim($_POST['eu_password2']));
    $dept_id        = mysqli_real_escape_string($con,trim($_POST['dept_id']));
    $clg_id         = mysqli_real_escape_string($con,trim($_POST['clg_id']));

    // check if name only contains letters and whitespace
    if (preg_match("/^[a-zA-Z ]*$/",$eu_first_name) && preg_match("/^[a-zA-Z ]*$/",$eu_last_name)) {
 
      $query = "SELECT * FROM expert_user WHERE dept_id = '$dept_id' ";
      $fire  = mysqli_query($con,$query);

      if ($fire) {
        
        if (mysqli_num_rows($fire) == 0) {

          if($eu_password == $eu_password2 && strlen($eu_password)>=4)
              {
                $eu_password=md5($eu_password);

                $query = "INSERT INTO expert_user(eu_first_name,eu_last_name,eu_email,eu_password,dept_id,clg_id) VALUES('$eu_first_name','$eu_last_name','$eu_email','$eu_password','$dept_id','$clg_id')";

                $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));

                if ($fire) {
                      $msg = array("icon"=>"success", "title"=>"Done", "text"=>"Expert User Added Successfully!");   
                      echo json_encode($msg);
                }
                else{
                      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");
                      echo json_encode($msg);
                }
          }else{
            $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Password Missmatched or Password length is too short!");   
            echo json_encode($msg);
          }
        }
        else{
            $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Expert User for this department already exist!");   
            echo json_encode($msg);
        }
      }else{
        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");   
        echo json_encode($msg);
      }
    }else{
        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Only letters and white space allowed!");   
        echo json_encode($msg);
    }
}


/***************************************_______ get dept admin id nd send details ______**************************************/
if (isset($_POST['id'])) {
    
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






/*****************************************_______update department admin________***********************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upd'])){

  if (!empty($_POST['eu_first_name']) && !empty($_POST['eu_last_name']) && !empty($_POST['eu_email'])) {

    $eu_id          = mysqli_real_escape_string($con,trim($_POST['eu_id']));
    $eu_first_name  = mysqli_real_escape_string($con,trim($_POST['eu_first_name']));
    $eu_first_name  = ucwords(strtolower($eu_first_name));

    $eu_last_name   = mysqli_real_escape_string($con,trim($_POST['eu_last_name']));
    $eu_last_name   = ucwords(strtolower($eu_last_name));

    $eu_email       = mysqli_real_escape_string($con,trim($_POST['eu_email']));

    if (preg_match("/^[a-zA-Z ]*$/",$eu_first_name) && preg_match("/^[a-zA-Z ]*$/",$eu_last_name)) {

      $query ="UPDATE expert_user SET eu_first_name = '$eu_first_name',eu_last_name = '$eu_last_name',eu_email = '$eu_email' WHERE eu_id=$eu_id";

      $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

      if ($fire) {   
          $ms = array("icon"=>"success", "title"=>"Done", "text"=>"Expert User Updated Successfully!");
          echo json_encode($ms);
      }else{
        
        $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
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
    
    $query ="DELETE FROM expert_user WHERE eu_id='$delid'";

    $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

    if ($fire) {
          
      $m = array("icon"=>"success", "title"=>"Done", "text"=>"Expert User deleted successfully!");
      echo json_encode($m);
      
      }else{
  
        $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
        echo json_encode($m);
      }  
  }else{
    $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Id cannot be Empty!");
    echo json_encode($m);
  }
}