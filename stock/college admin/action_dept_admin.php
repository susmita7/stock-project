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


/*************************************_____Get dept Admin Table________**************************************/

if (isset($_POST['readdeptadmin'])) {
  
  $records = '<table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col" class="align-middle">SL No.</th>
                    <th scope="col" class="align-middle">Profile</th>
                    <th scope="col" class="align-middle">Department Admin Name</th>
                    <th scope="col" class="align-middle">Department Admin Email</th>
                    <th scope="col" class="align-middle">Department Admin Ph.No</th>
                    <th scope="col" class="align-middle">Department Name</th>
                    <th scope="col" colspan="2" class="align-middle">Action</th>
                  </tr>
                </thead>
              <tbody id="myTable">';

  $query = "SELECT * FROM department_admin INNER JOIN department ON department_admin.dept_id = department.dept_id AND department_admin.clg_id='".$_SESSION['clg_id']."'";

  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      $no=1;
      while ($dept_admin = mysqli_fetch_assoc($fire)) {

        if (!isset($dept_admin['dept_admin_img_link'])) {
          $dept_admin['dept_admin_img_link']="../uploads/default_image.png";
        }

      $records .='<tr>    
                    <td class="align-middle">'.$no.'</td>

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

    $dept_admin_first_name  = mysqli_real_escape_string($con,trim($_POST['dept_admin_first_name']));
    $dept_admin_first_name  = ucwords(strtolower($dept_admin_first_name));
    $dept_admin_last_name   = mysqli_real_escape_string($con,trim($_POST['dept_admin_last_name']));
    $dept_admin_last_name   = ucwords(strtolower($dept_admin_last_name));
    $dept_admin_email       = mysqli_real_escape_string($con,trim($_POST['dept_admin_email']));
    $dept_admin_password    = mysqli_real_escape_string($con,trim($_POST['dept_admin_password']));
    $dept_admin_password2   = mysqli_real_escape_string($con,trim($_POST['dept_admin_password2']));
    $dept_id                = mysqli_real_escape_string($con,trim($_POST['dept_id']));
    $clg_id                 = mysqli_real_escape_string($con,trim($_POST['clg_id']));

    // check if name only contains letters and whitespace
    if (preg_match("/^[a-zA-Z ]*$/",$dept_admin_first_name) && preg_match("/^[a-zA-Z ]*$/",$dept_admin_last_name)) {
 
      $query = "SELECT * FROM department_admin WHERE dept_id = '$dept_id' ";
      $fire  = mysqli_query($con,$query);

      if ($fire) {
        
        if (mysqli_num_rows($fire) == 0) {

          if($dept_admin_password == $dept_admin_password2 && strlen($dept_admin_password)>=4)
              {
                $dept_admin_password=md5($dept_admin_password);

                $query = "INSERT INTO department_admin(dept_admin_first_name,dept_admin_last_name,dept_admin_email,dept_admin_password,dept_id,clg_id) VALUES('$dept_admin_first_name','$dept_admin_last_name','$dept_admin_email','$dept_admin_password','$dept_id','$clg_id')";

                $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));

                if ($fire) {
                      $msg = array("icon"=>"success", "title"=>"Done", "text"=>"Department Admin Added Successfully!");   
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
            $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Department admin for this department already exist!");   
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






/*****************************************_______update department admin________***********************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upd'])){

  if (!empty($_POST['dept_admin_first_name']) && !empty($_POST['dept_admin_last_name']) && !empty($_POST['dept_admin_email'])) {

    $dept_admin_id          = mysqli_real_escape_string($con,trim($_POST['dept_admin_id']));
    $dept_admin_first_name  = mysqli_real_escape_string($con,trim($_POST['dept_admin_first_name']));
    $dept_admin_first_name  = ucwords(strtolower($dept_admin_first_name));
    $dept_admin_last_name   = mysqli_real_escape_string($con,trim($_POST['dept_admin_last_name']));
    $dept_admin_last_name   = ucwords(strtolower($dept_admin_last_name));
    $dept_admin_email       = mysqli_real_escape_string($con,trim($_POST['dept_admin_email']));

    if (preg_match("/^[a-zA-Z ]*$/",$dept_admin_first_name) && preg_match("/^[a-zA-Z ]*$/",$dept_admin_last_name)) {

      $query ="UPDATE department_admin SET dept_admin_first_name = '$dept_admin_first_name',dept_admin_last_name = '$dept_admin_last_name',dept_admin_email = '$dept_admin_email' WHERE dept_admin_id=$dept_admin_id";

      $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

      if ($fire) {   
          $ms = array("icon"=>"success", "title"=>"Done", "text"=>"Department Admin Updated Successfully!");
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
    
    $query ="DELETE FROM department_admin WHERE dept_admin_id='$delid'";

    $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

    if ($fire) {
          
      $m = array("icon"=>"success", "title"=>"Done", "text"=>"Department admin deleted successfully!");
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