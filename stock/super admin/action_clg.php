<?php require "../config/config.php"; 
  session_start();
  
  // check if super admin logged in or not
  if ($_SESSION['is_sa_login']) {  
    //keep user on page
  }else{
    //redirect on loginpage
    header("Location: login");
  }

extract($_POST);


/***************************_______Get College Table________*********************************/

if (isset($_POST['readclg'])) {
  
  $record = '<table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="align-middle" scope="col">SL No.</th>
                    <th class="align-middle" scope="col">College Name</th>
                    <th class="align-middle" scope="col">Faculty Name</th>
                    <th class="align-middle" scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="myTable">';
  $query = "SELECT * FROM college INNER JOIN faculty ON college.faculty_id = faculty.faculty_id ORDER BY clg_id ASC";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      $no=1;
      while ($clg = mysqli_fetch_assoc($fire)) {

        $record .='<tr>    
                      <td class="align-middle">'.$no.'</td>
                      <td class="align-middle">'.$clg['clg_name'].'</td>
                      <td class="align-middle">'.$clg['faculty_name'].'</td>
                      <td class="align-middle">
                          <a type="button" id="up_clg" class="editbtn" onclick="getClg('.$clg['clg_id'].')">Update</a>
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


/***************************_______add college________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])){
  
  if (!empty($_POST['clg_name']) && !empty($_POST['faculty_id'])) {

    $faculty_id   = mysqli_real_escape_string($con,trim($_POST['faculty_id']));
    $clg_name     = mysqli_real_escape_string($con,trim($_POST['clg_name']));
    $clg_name     = ucwords(strtolower($clg_name));

    // check if name only contains letters and whitespace
    if (preg_match("/^[a-zA-Z ]*$/",$clg_name)) {
 
      $query = "SELECT * FROM college WHERE clg_name ='$clg_name'";
      $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

      if ($fire) {
          if (mysqli_num_rows($fire) == 0) {

            $query = "INSERT INTO college(clg_name,faculty_id) VALUES ('$clg_name','$faculty_id')";
            $fire  = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));
              
            if ($fire) {
              $msg = array("icon"=>"success", "title"=>"Done", "text"=>"College Name Added Successfully!");    
              echo json_encode($msg);

            }else{
            
              $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Sorry, Something Went Wrong!");    
              echo json_encode($msg); 
            }
        
          }else{    
            $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Sorry, College Name Already Exist!");
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
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"College Name Cannot Be Empty!");    
      echo json_encode($msg);
  }
}

/***************************_______update college________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name_clg'])){
  
  if (!empty($_POST['name_clg']) && !empty($_POST['id_clg'])) {
    
    $id_clg       = mysqli_real_escape_string($con,trim($_POST['id_clg']));
    $name_clg     = mysqli_real_escape_string($con,trim($_POST['name_clg']));
    $name_clg     = ucwords(strtolower($name_clg));

    // check if name only contains letters and whitespace
    if (preg_match("/^[a-zA-Z ]*$/",$name_clg)) {

      $query = "SELECT * FROM college WHERE clg_name ='$name_clg'";
      $fire  = mysqli_query($con,$query) or die("can not fetch data from database. ".mysqli_error($con));

      if ($fire) {
        
        if (mysqli_num_rows($fire) == 0) {

          $query = "UPDATE college SET clg_name ='$name_clg' WHERE clg_id=$id_clg";
          $fire  = mysqli_query($con,$query) or die("can not update data in database. ".mysqli_error($con));

          if ($fire) {
          
            $msgs = array("icon"=>"success", "title"=>"Done", "text"=>"College Name Successfully Updated!");
            echo json_encode($msgs);

          }else{  
        
            $msgs = array("icon"=>"error", "title"=>"Oops", "text"=>"Sorry, Something Went Wrong!");    
            echo json_encode($msgs); 
          }
        
        }else{    
            
          $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Sorry, College Name Already Exist!");
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
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"College Name Cannot Be Empty!");    
      echo json_encode($msg);
  }
}

/******************************___ get clg id nd send details __*************************/
if (isset($_POST['id'])) {
    
    $id=mysqli_real_escape_string($con,trim($_POST['id']));


    $query = "SELECT * FROM college INNER JOIN faculty ON college.faculty_id = faculty.faculty_id WHERE clg_id ='$id'";

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