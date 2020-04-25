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


/***************************_______Get College Admin Table________*********************************/

if (isset($_POST['readclgadmin'])) {
  
  $records = '<table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col" class="align-middle">SL No.</th>
                    <th scope="col" class="align-middle">Profile</th>
                    <th scope="col" class="align-middle">College Admin Name</th>
                    <th scope="col" class="align-middle">College Admin Email</th>
                    <th scope="col" class="align-middle">College Admin Ph.No</th>
                    <th scope="col" class="align-middle">College Name</th>
                    <th scope="col" colspan="2" class="align-middle">Action</th>
                  </tr>
                </thead>
              <tbody id="mTable">';

  $query = "SELECT * FROM college_admin INNER JOIN college ON college_admin.clg_id = college.clg_id";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      $no=1;
      while ($clg_admin = mysqli_fetch_assoc($fire)) {

        if (!isset($clg_admin['clg_admin_img_link'])) {
          $clg_admin['clg_admin_img_link']="../uploads/default_image.png";
        }

      $records .='<tr>    
                    <td class="align-middle">'.$no.'</td>
                    
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
                  $no++;
      }
    }else{
    $record .='<tr>
                <td class="align-middle" scope="col" colspan="7">No records availble</td>
              </tr>';
    }
  $records .='</tbody>
            </table>';
  echo $records;
}

/*****************************___ end of college admin table __****************************/






/***************************_______add college admin________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['clg_admin_first_name']) && isset($_POST['clg_admin_last_name']) && isset($_POST['clg_admin_email']) && isset($_POST['clg_admin_password']) && isset($_POST['clg_admin_password2']) && isset($_POST['clg_id'])){

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
      $fire  = mysqli_query($con,$query);

      if ($fire) {
        
        if (mysqli_num_rows($fire) == 0) {

              if($clg_admin_password == $clg_admin_password2 && strlen($clg_admin_password)>=4)
              {
                $clg_admin_password=md5($clg_admin_password);

                $query = "INSERT INTO college_admin(clg_admin_first_name,clg_admin_last_name,clg_admin_email,clg_admin_password,clg_id) VALUES('$clg_admin_first_name','$clg_admin_last_name','$clg_admin_email','$clg_admin_password','$clg_id')";

                $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));

                if ($fire) {

                      $msg = array("icon"=>"success", "title"=>"Done", "text"=>"College Admin Successfully Added!");   
                      echo json_encode($msg);
                }
                else{
                      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");   
                      echo json_encode($msg);
                }
              }
              else{
                $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Password Missmatched or Password length is too short!");   
                echo json_encode($msg);
              }
        }
        else{
            $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"College Admin for This College Already Exist!");   
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


/******************************___ get clgadmin id nd send details __*************************/
if (isset($_POST['id'])) {
    
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

      $query ="UPDATE college_admin SET clg_admin_first_name = '$clg_admin_first_name',clg_admin_last_name = '$clg_admin_last_name',clg_admin_email = '$clg_admin_email' WHERE clg_admin_id=$clg_admin_id";

      $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

      if ($fire) {
          
          $ms = array("icon"=>"success", "title"=>"Done", "text"=>"College Admin Successfully Updated!");
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
    
    $query ="DELETE FROM college_admin WHERE clg_admin_id='$delid'";

    $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

    if ($fire) {
          
      $m = array("icon"=>"success", "title"=>"Done", "text"=>"College Admin Deleted Successfully!");
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