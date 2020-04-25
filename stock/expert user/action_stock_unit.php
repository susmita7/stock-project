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


/*************************************_____Get stock units Table________**************************************/

if (isset($_POST['readunit'])) {
  
  $records = '<table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col" class="align-middle">SL No.</th>
                    <th scope="col" class="align-middle">Unit Name</th>
                    <th scope="col" class="align-middle">Unit For</th>
                    <th scope="col" colspan="2" class="align-middle">Action</th>
                  </tr>
                </thead>
              <tbody id="myTable">';

  //$query = "SELECT * FROM units INNER JOIN items ON units.item_id = items.item_id AND units.dept_id = items.dept_id = '".$_SESSION['dept_id']."'";

  $query = "SELECT * FROM units INNER JOIN items ON units.item_id = items.item_id AND units.dept_id = '".$_SESSION['dept_id']."'";
                          
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      $no=1;
      while ($unit = mysqli_fetch_assoc($fire)) {

      $records .='<tr>    
                    <td class="align-middle">'.$no.'</td>
                    <td class="align-middle">'.$unit['unit_name'].'</td>
                    <td class="align-middle">'.$unit['item_name'].'</td>
                    <td class="align-middle">
                      <a type="button" id="up_clg" class="editbtn" onclick="getUnit('.$unit['unit_id'].')">Update</a>
                    </td>
                    <td class="align-middle">
                      <a type="button" id="del_ad" onclick="getDelunit('.$unit['unit_id'].')">Delete</a></td>
                  </tr>';
                  $no++;
      }
  }else{
    $records .='<tr>
                <td class="align-middle" scope="col" colspan="4">No records availble</td>
              </tr>';
  }
  $records .='</tbody>
            </table>';
  echo $records;
}

/**************************************____ end of stock unit table ____*************************************/






/**************************************_______add stock unit ________*****************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])){

  $unit_name  = mysqli_real_escape_string($con,trim($_POST['unit_name']));
  $unit_name  = strtolower($unit_name);
  
  $item_id    = mysqli_real_escape_string($con,trim($_POST['item_id']));
  $dept_id    = mysqli_real_escape_string($con,trim($_POST['dept_id']));

  // check if name only contains letters and whitespace
  if (preg_match("/^[a-zA-Z ]*$/",$unit_name)) {

    $query = "SELECT * FROM units WHERE unit_name ='$unit_name' AND item_id='$item_id' AND dept_id ='$dept_id' ";
    $fire  = mysqli_query($con,$query);

    if ($fire) {
        if (mysqli_num_rows($fire) == 0) {

            $query = "INSERT INTO  units(unit_name,item_id,dept_id) VALUES('$unit_name','$item_id','$dept_id')";

            $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));

  	        if ($fire) {
                $ms = array("icon"=>"success", "title"=>"Done", "text"=>"Unit Added Successfully!");
  	            echo json_encode($ms);
            }else{        
    		        $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
    	    	    echo json_encode($ms);
        		}
        }
        else{
            $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Unit already exist!");   
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


/***************************************_______ get item id nd send details ______**************************************/
if (isset($_POST['id'])) {
    
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






/*****************************************_______update stock item ________***********************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upd'])){

  $unit_id        = mysqli_real_escape_string($con,trim($_POST['unit_id']));
  $unit_name		  = mysqli_real_escape_string($con,trim($_POST['unit_name']));
  $unit_name		  = strtolower($unit_name);
  $item_id        = mysqli_real_escape_string($con,trim($_POST['item_id']));
  $dept_id        = $_SESSION['dept_id'];

    if (!empty($unit_name)) {

      if (preg_match("/^[a-zA-Z& ]*$/",$unit_name)) {

        $query = "SELECT * FROM units WHERE unit_name ='$unit_name' AND item_id='$item_id' AND dept_id ='$dept_id' ";
        $fire  = mysqli_query($con,$query);

          if ($fire) {

            if (mysqli_num_rows($fire)==0) {

                $query ="UPDATE units SET unit_name = '$unit_name' WHERE unit_id=$unit_id";
                $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

                if ($fire) {   
                  $ms = array("icon"=>"success", "title"=>"Done", "text"=>"Unit Updated Successfully!");
                  echo json_encode($ms);
                }else{
                  $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
                  echo json_encode($ms);
                }
            
            }else{
                $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Unit already exist!");    
                echo json_encode($ms);
            }
          
          }else{
            $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
            echo json_encode($ms);
          }   
      }else{  
        $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Only letters and white space allowed!");    
        echo json_encode($ms); 
      }  
    }else{
      $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Name cannot be Empty!");
      echo json_encode($ms);
    }
}

/***************************_______delete stock item________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['del'])){

  if (!empty($_POST['delid'])) {

    $delid = mysqli_real_escape_string($con,trim($_POST['delid']));
    
    $query ="DELETE FROM units WHERE unit_id='$delid'";

    $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

          if ($fire) {
          
            $m = array("icon"=>"success", "title"=>"Done", "text"=>"Unit deleted successfully!");
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