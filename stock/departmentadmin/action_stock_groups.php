<?php require "../config/config.php"; 
  session_start();
  
  // check if dept admin logged in or not
  if ($_SESSION['is_da_login']) {  
    //keep user on page
  }else{
    //redirect on loginpage
    header("Location: ../choose");
  }

extract($_POST);

date_default_timezone_set("Asia/kolkata");


/*___________________________________ Get stock group _________________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readgroup'])) {
  
  $records = '<table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col" class="align-middle">SL No.</th>
                    <th scope="col" class="align-middle">Type Name</th>
                    <th scope="col" class="align-middle">Category</th>
                    <th scope="col" colspan="2" class="align-middle">Action</th>
                  </tr>
                </thead>';

  $query = "SELECT * FROM category_type WHERE dept_id='".$_SESSION['dept_id']."'";

  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      $no=1;
      while ($group = mysqli_fetch_assoc($fire)) {

      $records .='<tbody id="myTable">
                  <tr>    
                    <td class="align-middle">'.$no.'</td>
                    <td class="align-middle">'.$group['type_name'].'</td>
                    <td class="align-middle">'.$group['category'].'</td>
                    <td class="align-middle">
                      <a type="button" id="up_clg" class="editbtn" onclick="getGroup('.$group['type_id'].')">Update</a>
                    </td>
                    <td class="align-middle">
                      <a type="button" id="del_ad" onclick="getDelgroup('.$group['type_id'].')">Delete</a></td>
                  </tr>';
                  $no++;
      }
  }else{
    $records .='<tbody>
              <tr>
                <td class="align-middle" scope="col" colspan="4">No Records Available</td>
              </tr>';
  }
  $records .='</tbody>
            </table>';
  echo $records;
}





/*_______________________________  add stock group  ____________________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])){

  $type_name  = mysqli_real_escape_string($con,trim($_POST['type_name']));
  $type_name  = ucwords(strtolower($type_name));
  
  $category   = mysqli_real_escape_string($con,trim($_POST['category']));
  $dept_id    = mysqli_real_escape_string($con,trim($_POST['dept_id']));


  $query = "SELECT * FROM category_type WHERE type_name ='$type_name' AND dept_id='$dept_id' ";
	$fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));
 
  if ($fire) {
        
    if (mysqli_num_rows($fire) == 0) {

      $query = "INSERT INTO category_type(type_name,category,dept_id) VALUES('$type_name','$category','$dept_id')";

	    $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));

	    if ($fire) {
          
        //add to history

        $created_at= date("Y-m-d H:i:s");
        $activity_type= "stockgroup";
        $activity_body= "You have added stock group : ".$type_name.".";
        $dept_admin_id=$_SESSION['dept_admin_id'];

        $query_n = "INSERT INTO `dept_admin_activity`(`created_at`, `activity_type`, `activity_body`, `dept_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$dept_admin_id')";

        $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

        if ($fire_n) {
          $ms = array("icon"=>"success", "title"=>"Done", "text"=>"Stock group added successfully!");
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
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Stock group already exist!");   
      echo json_encode($msg);
    }
  }else{
    $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");   
    echo json_encode($msg);
  }
}





/*____________________________ get stock group id nd send details _________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    
    $id=mysqli_real_escape_string($con,trim($_POST['id']));

    $query = "SELECT * FROM category_type INNER JOIN department ON category_type.dept_id = department.dept_id WHERE type_id ='$id'";

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





/*______________________________  update stock group  _________________________________*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upd'])){

  $type_id        = mysqli_real_escape_string($con,trim($_POST['type_id']));
  $type_name		  = mysqli_real_escape_string($con,trim($_POST['type_name']));
  $type_name		  = ucwords(strtolower($type_name));
  $dept_id        = mysqli_real_escape_string($con,trim($_SESSION['dept_id']));

  if (!empty($type_name)) {

    $query = "SELECT * FROM category_type WHERE type_name ='$type_name' AND dept_id='$dept_id' ";
    $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));
 
    if ($fire) {
        
      if (mysqli_num_rows($fire) == 0) {

        $q="SELECT * FROM category_type WHERE type_id='$type_id'";
        $f=mysqli_query($con,$q) or die("can not show data .".mysqli_error($con));
        $row=mysqli_fetch_assoc($f);

        $query ="UPDATE category_type SET type_name = '$type_name' WHERE type_id=$type_id";

        $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

        if ($fire) {

          //add to history

          $created_at= date("Y-m-d H:i:s");
          $activity_type= "stockgroup";
          $activity_body= "You have updated stock group : ".$row['type_name']." to ".$type_name.".";
          $dept_admin_id=$_SESSION['dept_admin_id'];

          $query_n = "INSERT INTO `dept_admin_activity`(`created_at`, `activity_type`, `activity_body`, `dept_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$dept_admin_id')";

          $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

          if ($fire_n) {
            $ms = array("icon"=>"success", "title"=>"Done", "text"=>"Stock group updated successfully!");
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
        $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Stock group already exist!");    
        echo json_encode($ms);
      }
    }else{
      $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
      echo json_encode($ms);
    }
  }else{
    $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Name cannot be empty!");
    echo json_encode($ms);
  }
}





/***************************_______delete stock group________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['del'])){

  if (!empty($_POST['delid'])) {

    $delid = mysqli_real_escape_string($con,trim($_POST['delid']));

    $q="SELECT * FROM items WHERE type_id='$delid'";
    $f=mysqli_query($con,$q) or die("can not access data .".mysqli_error($con));

    if ($f) {

      if (mysqli_num_rows($f)==0) {

        $q="SELECT * FROM category_type WHERE type_id='$delid'";
        $f=mysqli_query($con,$q) or die("can not show data .".mysqli_error($con));
        $row=mysqli_fetch_assoc($f);
    
        $query ="DELETE FROM category_type WHERE type_id='$delid'";

        $fire = mysqli_query($con,$query) or die("can not delete data .".mysqli_error($con));

        if ($fire) {
            
          $created_at= date("Y-m-d H:i:s");
          $activity_type= "stockgroup";
          $activity_body= "You have deleted stock group : ".$row['type_name'].".";
          $dept_admin_id=$_SESSION['dept_admin_id'];

          $query_n = "INSERT INTO `dept_admin_activity`(`created_at`, `activity_type`, `activity_body`, `dept_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$dept_admin_id')";

          $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

          if ($fire_n) {
            $m = array("icon"=>"success", "title"=>"Done", "text"=>"Stock group deleted successfully!");
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
        $m = array("icon"=>"error", "title"=>"Oops", "text"=>"This stock group cannot be deleted!");
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