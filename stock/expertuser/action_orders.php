<?php require "../config/config.php"; ?>
<?php
  session_start();
  if ($_SESSION['is_eu_login']) {
    //keep user on this page
  }
  else{
    //redirect to login page
    header("Location: ../choose") ;
  }

extract($_POST);

date_default_timezone_set("Asia/kolkata");


/*************************************_____Get files Table________**************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readfile'])) {
  
  $records = '<table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="align-middle">Sl No.</th>
                        <th scope="col" class="align-middle">Date</th>
                        <th scope="col" class="align-middle">File Name</th>
                        <th scope="col" class="align-middle">Approved Id</th>
                        <th scope="col" class="align-middle">Action</th>
                    </tr>
                </thead>';

  $query="SELECT * FROM file_details WHERE dept_id = '".$_SESSION['dept_id']."'";
                          
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
        $no=1;
        while ($file = mysqli_fetch_assoc($fire)) {

            if (!isset($file['file_link'])) {

                $records .='<tbody id="myTable">
                  <tr>    
                    <td class="align-middle">'.$no.'</td>
                    <td class="align-middle">'.date('d-m-Y',strtotime(str_replace('-', '/', $file['created_at']))).'</td>
                    <td class="align-middle">Not Available</td>
                    <td class="align-middle">'.$file['approved_id'].'</td>
                    <td class="align-middle">
                        <a id="add_file" type="button" onclick="getFile('.$file['file_id'].')">Upload file</a>
                    </td>
                  </tr>';
            }else{
                $records .='<tbody id="myTable">
                  <tr>    
                    <td class="align-middle">'.$no.'</td>
                    <td class="align-middle">'.date('d-m-Y',strtotime(str_replace('-', '/', $file['created_at']))).'</td>
                    <td class="align-middle">'.$file['file_name'].'</td>
                    <td class="align-middle">'.$file['approved_id'].'</td>
                    <td class="align-middle">
                        <a target="_blank" href="'.$file['file_link'].'" id="view_file" type="button">View file</a>
                    </td>
                  </tr>';
            }
        $no++;
        }
    }else{
            $records .='<tbody>
              <tr>
                <td class="align-middle" scope="col" colspan="5">No File Records Availble</td>
              </tr>';
  }
  $records .='</tbody>
            </table>';
  echo $records;
}





/******************************_____ get file id nd send details ______*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    
    $id=mysqli_real_escape_string($con,trim($_POST['id']));

    $query = "SELECT * FROM file_details WHERE file_id ='$id'";

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





/*******************************_______upload file for existing Id ________**********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['act'])){

    if ($_POST['act']=="update") {

        $file_id = mysqli_real_escape_string($con,trim($_POST['file_id']));

        $q="SELECT * FROM file_details WHERE file_id='$file_id'";
        $f=mysqli_query($con,$q) or die("can not show data .".mysqli_error($con));
        $row=mysqli_fetch_assoc($f);

        if (!empty($_FILES['file'] ['name'])) {

            $img_name = $_FILES['file']['name'];

            $img_size = $_FILES['file']['size'];
            $img_tmp  = $_FILES['file']['tmp_name'];

            $type = $_FILES['file']['type'];
            $data = addslashes(file_get_contents($_FILES['file']['tmp_name']));

            $directory = '../files/';
            $target_file = $directory.$img_name;

            if (!file_exists($target_file)) {

                $query ="UPDATE file_details SET file_name = '$img_name',file_link = '$target_file',mime = '$type',data='$data' WHERE file_id=$file_id";    
            
                $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

                if ($fire) {

                    //uploading to folder
                    move_uploaded_file($img_tmp,$target_file);

                    //add to activity

                    $created_at= date("Y-m-d H:i:s");
                    $activity_type= "file";
                    $activity_body= "You have uploaded a file references order id : ".$row['approved_id'];
                    $eu_id=$_SESSION['eu_id'];

                    $query_n = "INSERT INTO `expert_user_activity`(`created_at`, `activity_type`, `activity_body`, `eu_id`) VALUES ('$created_at','$activity_type','$activity_body','$eu_id')";

                    $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

                    if ($fire_n) {
                        $ms = array("icon"=>"success", "title"=>"Done", "text"=>"File uploaded successfully!");
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
                $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"This file cannot be uploaded!");    
                echo json_encode($ms);
            }
        }else{
            $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"File name is empty!");    
            echo json_encode($ms);
        }
    }
}





/******************************_______________ get the units ____________******************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['adds2'])) {

    if ($_POST['data2']!=null) {
       
        $nam = mysqli_real_escape_string($con,trim($_POST['data2']));

        $query = "SELECT * from items WHERE item_name='$nam' AND dept_id = '".$_SESSION['dept_id']."'";
        $fire = mysqli_query($con,$query);
        $n = mysqli_fetch_array($fire);
        $n_id=$n['item_id'];
        
        $query = "SELECT * from units WHERE item_id='$n_id' AND dept_id = '".$_SESSION['dept_id']."'";
        $fire = mysqli_query($con,$query);?>
        <option value="" selected="" disabled="">Select Unit</option>
        <?php
        while ($u = mysqli_fetch_array($fire)) {
      ?>
        <option value="<?php echo $u['unit_name']; ?>"><?php echo $u['unit_name']; ?></option>
      <?php
        }
    }
}





/********************************** send stock request to dept admin  ***********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {

    $dept_id            = mysqli_real_escape_string($con,trim($_POST['dept_id']));
    $notify_type        = mysqli_real_escape_string($con,trim($_POST['notify_type']));
    $notify_title       = mysqli_real_escape_string($con,trim($_POST['notify_title']));
    $notify_title       = ucwords(strtolower($notify_title));
    $notify_item        = mysqli_real_escape_string($con,trim($_POST['notify_item']));
    $notify_unit        = mysqli_real_escape_string($con,trim($_POST['notify_unit']));
    $notify_quantity    = mysqli_real_escape_string($con,trim($_POST['notify_quantity']));
    $notify_message     = mysqli_real_escape_string($con,trim($_POST['notify_message']));

    $created_at = date("Y-m-j H:i:s");

    $query = "INSERT INTO `dept_admin_notify`(`created_at`, `notify_title`, `notify_message`, `notify_item`, `notify_unit`, `notify_quantity`, `notify_type`, `dept_id`) VALUES ('$created_at','$notify_title','$notify_message','$notify_item','$notify_unit','$notify_quantity','$notify_type','$dept_id')";

    $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));
            

    if ($fire) {

        $created_at= date("Y-m-d H:i:s");
        $activity_type= "request";
        $activity_body= "You have requested to order stock : ".$notify_quantity." ".$notify_unit." of ".$notify_item;
        $eu_id=$_SESSION['eu_id'];

        $query_n = "INSERT INTO `expert_user_activity`(`created_at`, `activity_type`, `activity_body`, `eu_id`) VALUES ('$created_at','$activity_type','$activity_body','$eu_id')";

        $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

        if ($fire_n) {
            $m = array("icon"=>"success", "title"=>"DONE", "text"=>"Request has been successfully sent!");    
            echo json_encode($m);
        }else{
            $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
            echo json_encode($m);
        }
    }else{
        $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
        echo json_encode($m);
    }
}





/***____________________________upload file or insert file into database __________________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['acts'])){

    if ($_POST['acts']=="insert") {

        if (!empty($_FILES['files'] ['name'])) {

            $img_name = $_FILES['files']['name'];

            $img_size = $_FILES['files']['size'];
            $img_tmp  = $_FILES['files']['tmp_name'];

            $type = $_FILES['files']['type'];
            $data = addslashes(file_get_contents($_FILES['files']['tmp_name']));

            $directory = '../files/';
            $target_file = $directory.$img_name;

            $approved_ids=$_POST['approved_ids'];
            $dept_id=$_SESSION['dept_id'];

            if (!empty($approved_ids)) {

                $q="SELECT * FROM file_details WHERE approved_id='$approved_ids' AND dept_id='$dept_id'";
                $f=mysqli_query($con,$q) or die(mysqli_error($con));

                if (mysqli_num_rows($f)==0) {

                    //check if file alread exist
                    if (!file_exists($target_file)) {

                        $created_at = date("Y-m-j H:i:s");

                        $query = "INSERT INTO `file_details`(`created_at`,`file_name`, `file_link`, `mime`, `data`, `approved_id`, `dept_id`) VALUES ('$created_at','$img_name', '$target_file', '$type', '$data', '$approved_ids', '$dept_id')" or die(mysqli_error($con));

                        $fire = mysqli_query($con,$query) or die(mysqli_error($con));

                        if ($fire) {

                            move_uploaded_file($img_tmp,$target_file);

                            $created_at= date("Y-m-d H:i:s");
                            $activity_type= "file";
                            $activity_body= "You have uploaded a file references order id : ".$approved_ids;
                            $eu_id=$_SESSION['eu_id'];

                            $query_n = "INSERT INTO `expert_user_activity`(`created_at`, `activity_type`, `activity_body`, `eu_id`) VALUES ('$created_at','$activity_type','$activity_body','$eu_id')";

                            $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

                            if ($fire_n) {
                                $ms = array("icon"=>"success", "title"=>"Done", "text"=>"File uploaded successfully!");
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
                        $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"This file cannot be uploaded!");    
                        echo json_encode($ms);
                    }
                }else{
                    $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Approved id already exist!");    
                    echo json_encode($ms);
                }
            }else{
                $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Approved id cannot be empty!");    
                echo json_encode($ms);
            }    
        }else{
            $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"File name is empty!");    
            echo json_encode($ms);
        }
    }       
}