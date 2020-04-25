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


/***************************_______Get Departments Table________*********************************/

if (isset($_POST['readdept'])) {
  
  $record = '<table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="align-middle" scope="col">SL No.</th>
                        <th class="align-middle" scope="col">Department Name</th>
                        <th class="align-middle" scope="col">College Name</th>
                        <th class="align-middle" scope="col">Action</th>
                    </tr>
                </thead>
            <tbody id="myTable">';
  
  $query = "SELECT * FROM department INNER JOIN college ON department.clg_id = college.clg_id AND department.clg_id= '".$_SESSION['clg_id']."'";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      $no=1;
      while ($dept = mysqli_fetch_assoc($fire)) {

      $record .='<tr>    
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
    $record .='<tr>
                <td class="align-middle" scope="col" colspan="4">No records availble</td>
              </tr>';
  }
  $record .='</tbody>
            </table>';
  echo $record;
}


/***************************_______add department________*********************************/

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
              $msg = array("icon"=>"success", "title"=>"Done", "text"=>"Department Name Successfully Added!");    
              echo json_encode($msg);
            }else{
              $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Sorry, Something Went Wrong!");    
              echo json_encode($msg); 
            }
          }else{    
            $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Sorry, Department Name Already Exist!");
            echo json_encode($msg);
          }
      }else{
        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Sorry, Something Went Wrong!");    
        echo json_encode($msg);
      }
    }else{
        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Only letters and white space allowed!");   
        echo json_encode($msg);
    }
  }else{
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Department Name Cannot Be Empty!");    
      echo json_encode($msg);
  }
}

/***************************_______update department________*********************************/

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

          $query = "UPDATE department SET dept_name ='$name_dept' WHERE dept_id=$id_dept";
          $fire  = mysqli_query($con,$query) or die("can not update data in database. ".mysqli_error($con));

          if ($fire) {
          
            $msgs = array("icon"=>"success", "title"=>"Done", "text"=>"Department Name Successfully Updated!");
            echo json_encode($msgs);

          }else{  
        
            $msgs = array("icon"=>"error", "title"=>"Oops", "text"=>"Sorry, Something Went Wrong!");    
            echo json_encode($msgs); 
          }
        
        }else{    
            
          $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Sorry, Department Name Already Exist!");
          echo json_encode($msg);
        }
        
      }else{
        
        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Sorry, Something Went Wrong!");    
        echo json_encode($msg);
      }
    }else{
        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Only letters and white space allowed!");   
        echo json_encode($msg);
    }
  }else{
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Department Name Cannot Be Empty!");    
      echo json_encode($msg);
  }
}

/******************************___ get dept id nd send details __*************************/
if (isset($_POST['id'])) {
    
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