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


/***************************_______Get firms Table________*********************************/

if (isset($_POST['readfirms'])) {
  
  $record = '<table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="align-middle" scope="col">Sl No.</th>
                                    <th class="align-middle" scope="col">Firms Name</th>
                                    <th class="align-middle" scope="col">Owners Name</th>
                                    <th class="align-middle" scope="col">Email Id</th>
                                    <th class="align-middle" scope="col">Phone No</th>
                                    <th class="align-middle" scope="col">Address</th>
                                    <th class="align-middle" scope="col"  colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">';
  
  $query = "SELECT * FROM firm WHERE clg_id= '".$_SESSION['clg_id']."'";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      $no=1;
      while ($firm = mysqli_fetch_assoc($fire)) {

      $record .='<tr>    
                    <td class="align-middle">'.$no.'</td>
                    <td class="align-middle">'.$firm['firm_name'].'</td>
                    <td class="align-middle">'.$firm['owner_name'].'</td>
                    <td class="align-middle">'.$firm['firm_email'].'</td>
                    <td class="align-middle">'.$firm['firm_mobile'].'</td>
                    <td class="align-middle">'.$firm['firm_address'].'</td>
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
    $record .='<tr>
                <td class="align-middle" scope="col" colspan="7">No records availble</td>
              </tr>';
  }
  $record .='</tbody>
            </table>';
  echo $record;
}


/***************************_______add firm________*********************************/

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

    // check if name only contains letters and whitespace
    if (preg_match("/^[a-zA-Z& ]*$/",$firm_name) && preg_match("/^[a-zA-Z ]*$/",$owner_name)) {
 
      $query = "SELECT * FROM firm WHERE firm_name = '$firm_name' AND clg_id='$clg_id' ";
      $fire  = mysqli_query($con,$query);

      if ($fire) {
        
        if (mysqli_num_rows($fire) == 0) {

          $query = "INSERT INTO firm(firm_name,owner_name,firm_email,firm_mobile,firm_address,clg_id) VALUES('$firm_name','$owner_name','$firm_email','$firm_mobile','$firm_address','$clg_id')";

          $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));

          if ($fire) {

            $msg = array("icon"=>"success", "title"=>"Done", "text"=>"Firm Successfully Added!");   
            echo json_encode($msg);
          }
          else{
            $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");   
            echo json_encode($msg);
          }
        }
        else{
            $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Sorry, Firm Name Already Exist!");   
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


/******************************___ get firm id nd send details __*************************/
if (isset($_POST['id'])) {
    
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






/***************************_______update firm________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upd'])){

  if (!empty($_POST['name_firm']) && !empty($_POST['name_owner']) && !empty($_POST['address_firm'])) {

    $firm_id               = mysqli_real_escape_string($con,trim($_POST['firm_id']));
    $name_firm             = mysqli_real_escape_string($con,trim($_POST['name_firm']));
    $name_firm             = ucwords(strtolower($name_firm));
    $name_owner            = mysqli_real_escape_string($con,trim($_POST['name_owner']));
    $name_owner            = ucwords(strtolower($name_owner));
    $email_firm            = mysqli_real_escape_string($con,trim($_POST['email_firm']));
    $mobile_firm           = mysqli_real_escape_string($con,trim($_POST['mobile_firm']));
    $address_firm          = mysqli_real_escape_string($con,trim($_POST['address_firm']));
    $address_firm          = ucwords(strtolower($address_firm));

    if (preg_match("/^[a-zA-Z& ]*$/",$name_firm) && preg_match("/^[a-zA-Z ]*$/",$name_owner)) {

            $query ="UPDATE firm SET firm_name = '$name_firm',owner_name = '$name_owner',firm_email = '$email_firm',firm_mobile = '$mobile_firm',firm_address = '$address_firm' WHERE firm_id=$firm_id";

            $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

            if ($fire) {          
              $ms = array("icon"=>"success", "title"=>"Done", "text"=>"Firm Updated Successfully!");
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

/***************************_______delete firm________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['del'])){

  if (!empty($_POST['delid'])) {

    $delid = mysqli_real_escape_string($con,trim($_POST['delid']));
    
    $query ="DELETE FROM firm WHERE firm_id='$delid'";

    $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

    if ($fire) {
  
      $m = array("icon"=>"success", "title"=>"Done", "text"=>"Firm has been deleted successfully!");
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