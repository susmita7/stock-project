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


/*********************************_____Get stock units Table________**************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readunit'])) {
  
  $records = '<table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col" class="align-middle">SL No.</th>
                    <th scope="col" class="align-middle">Unit Name</th>
                    <th scope="col" class="align-middle">Unit For</th>
                    <th scope="col" colspan="2" class="align-middle">Action</th>
                  </tr>
                </thead>';

  $query = "SELECT * FROM units INNER JOIN items ON units.item_id = items.item_id AND units.dept_id = '".$_SESSION['dept_id']."'";
                          
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      $no=1;
      while ($unit = mysqli_fetch_assoc($fire)) {

      $records .='<tbody id="myTable">
                  <tr>    
                    <td class="align-middle">'.$no.'</td>
                    <td class="align-middle">'.$unit['unit_name'].'</td>
                    <td class="align-middle">'.$unit['item_name'].'</td>
                    <td class="align-middle">
                      <a type="button" id="up_clg" class="editbtn" onclick="getUnit('.$unit['unit_id'].')">Update</a>
                    </td>
                    <td class="align-middle">
                      <a type="button" id="del_ad" onclick="getDelunit('.$unit['unit_id'].')">Delete</a>
                    </td>
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





/**********************************_______add stock unit ________***********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])){

  $unit_name  = mysqli_real_escape_string($con,trim($_POST['unit_name']));
  $unit_name  = strtolower($unit_name);
  
  $item_id    = mysqli_real_escape_string($con,trim($_POST['item_id']));
  $dept_id    = mysqli_real_escape_string($con,trim($_POST['dept_id']));

  if (!empty($unit_name)) {

    $query = "SELECT * FROM units WHERE unit_name ='$unit_name' AND item_id='$item_id' AND dept_id ='$dept_id' ";
    $fire  = mysqli_query($con,$query);

    if ($fire) {
        
      if (mysqli_num_rows($fire) == 0) {

        $query = "INSERT INTO  units(unit_name,item_id,dept_id) VALUES('$unit_name','$item_id','$dept_id')";

        $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));

  	    if ($fire) {

          $q="SELECT * FROM items WHERE item_id='$item_id'";
          $f=mysqli_query($con,$q) or die("can not show data. ".mysqli_error($con));
          $row=mysqli_fetch_assoc($f);

          $created_at= date("Y-m-d H:i:s");
          $activity_type= "unit";
          $activity_body= "You have added stock unit : ".$unit_name." for stock item : ".$row['item_name'];
          $eu_id=$_SESSION['eu_id'];

          $query_n = "INSERT INTO `expert_user_activity`(`created_at`, `activity_type`, `activity_body`, `eu_id`) VALUES ('$created_at','$activity_type','$activity_body','$eu_id')";

          $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

          if ($fire_n) {
            $ms = array("icon"=>"success", "title"=>"Done", "text"=>"Unit added successfully!");
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
        $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Unit already exist!");   
        echo json_encode($msg);
      }
    }else{
      $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");   
      echo json_encode($msg);
    }
  }else{
    $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Name cannot be empty!");   
    echo json_encode($msg);
  }
}





/**************************_______ get item id nd send details ______********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    
  $id=mysqli_real_escape_string($con,trim($_POST['id']));

  $query = "SELECT * FROM units INNER JOIN items ON units.item_id = items.item_id WHERE unit_id ='$id'";

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





/************************_______update stock item ________*******************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upd'])){

  $unit_id        = mysqli_real_escape_string($con,trim($_POST['unit_id']));
  $unit_name		  = mysqli_real_escape_string($con,trim($_POST['unit_name']));
  $unit_name		  = strtolower($unit_name);
  $item_id        = mysqli_real_escape_string($con,trim($_POST['item_id']));
  $dept_id        = mysqli_real_escape_string($con,trim($_SESSION['dept_id']));

  if (!empty($unit_name)) {

    $query = "SELECT * FROM units WHERE unit_name ='$unit_name' AND item_id='$item_id' AND dept_id ='$dept_id' ";
    $fire  = mysqli_query($con,$query) or die("can not show data .".mysqli_error($con));

    if ($fire) {

      if (mysqli_num_rows($fire)==0) {

        $q="SELECT * FROM units INNER JOIN items ON units.item_id=items.item_id WHERE unit_id='$unit_id'";
        $f=mysqli_query($con,$q) or die("can not show data .".mysqli_error($con));
        $row=mysqli_fetch_assoc($f);

        $query ="UPDATE units SET unit_name = '$unit_name' WHERE unit_id=$unit_id";
        $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

        if ($fire) {

          //$query="SELECT * FROM items WHERE item_id='$item_id'";
          //$fire=mysqli_query($con,$query) or die("can not show data .".mysqli_error($con));
          //$r=mysqli_fetch_assoc($fire);

          $created_at= date("Y-m-d H:i:s");
          $activity_type= "unit";
          $activity_body= "You have updated stock unit : ".$row['unit_name']." to ".$unit_name." for stock item : ".$row['item_name'];
          $eu_id=$_SESSION['eu_id'];

          $query_n = "INSERT INTO `expert_user_activity`(`created_at`, `activity_type`, `activity_body`, `eu_id`) VALUES ('$created_at','$activity_type','$activity_body','$eu_id')";

          $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));   
                  $ms = array("icon"=>"success", "title"=>"Done", "text"=>"Unit Updated Successfully!");
                  echo json_encode($ms);
        }else{
          $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
          echo json_encode($ms);
        }
      }else{
        $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Unit already exist!");    
        echo json_encode($ms);
      }    
    }else{
      $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
      echo json_encode($ms);
    }  
  }else{
    $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Name cannot be empty!");
    echo json_encode($ms);
  }
}





/***************************_______delete stock item________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['del'])){

  if (!empty($_POST['delid'])) {

    $delid = mysqli_real_escape_string($con,trim($_POST['delid']));

    $q="SELECT * FROM units INNER JOIN items ON units.item_id=items.item_id WHERE unit_id='$delid'";
    $f=mysqli_query($con,$q) or die("can not show data .".mysqli_error($con));
    $row=mysqli_fetch_assoc($f);
    
    $query ="DELETE FROM units WHERE unit_id='$delid'";

    $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

    if ($fire) {

      $created_at= date("Y-m-d H:i:s");
      $activity_type= "unit";
      $activity_body= "You have deleted stock unit : ".$row['unit_name']." for stock item : ".$row['item_name'];
      $eu_id=$_SESSION['eu_id'];

      $query_n = "INSERT INTO `expert_user_activity`(`created_at`, `activity_type`, `activity_body`, `eu_id`) VALUES ('$created_at','$activity_type','$activity_body','$eu_id')";

      $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

      if ($fire_n) {
        $m = array("icon"=>"success", "title"=>"Done", "text"=>"Unit deleted successfully!");
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
    $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Id cannot be empty!");
    echo json_encode($m);
  }
}