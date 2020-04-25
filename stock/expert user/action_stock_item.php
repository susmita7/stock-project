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


/*************************************_____Get stock items Table________**************************************/

if (isset($_POST['readitem'])) {
  
  $records = '<table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col" class="align-middle">SL No.</th>
                    <th scope="col" class="align-middle">Item Name</th>
                    <th scope="col" class="align-middle">Type</th>
                    <th scope="col" class="align-middle">category</th>
                    <th scope="col" colspan="2" class="align-middle">Action</th>
                  </tr>
                </thead>
              <tbody id="myTable">';

  //$query = "SELECT * FROM items INNER JOIN category_type ON items.type_id = category_type.type_id AND items.dept_id = category_type.dept_id = '".$_SESSION['dept_id']."'";

  $query="SELECT * FROM items INNER JOIN category_type ON items.type_id = category_type.type_id AND items.dept_id = '".$_SESSION['dept_id']."'";
                          
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      $no=1;
      while ($item = mysqli_fetch_assoc($fire)) {

      $records .='<tr>    
                    <td class="align-middle">'.$no.'</td>
                    <td class="align-middle">'.$item['item_name'].'</td>
                    <td class="align-middle">'.$item['type_name'].'</td>
                    <td class="align-middle">'.$item['category'].'</td>
                    <td class="align-middle">
                      <a type="button" id="up_clg" class="editbtn" onclick="getItem('.$item['item_id'].')">Update</a>
                    </td>
                    <td class="align-middle">
                      <a type="button" id="del_ad" onclick="getDelitem('.$item['item_id'].')">Delete</a></td>
                  </tr>';
                  $no++;
      }
  }else{
    $records .='<tr>
                <td class="align-middle" scope="col" colspan="5">No records availble</td>
              </tr>';
  }
  $records .='</tbody>
            </table>';
  echo $records;
}

/**************************************____ end of stock item table ____*************************************/






/**************************************_______add stock item ________*****************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])){

  $item_name  = mysqli_real_escape_string($con,trim($_POST['item_name']));
  $item_name  = ucwords(strtolower($item_name));
  
  $type_id    = mysqli_real_escape_string($con,trim($_POST['type_id']));
  $dept_id    = mysqli_real_escape_string($con,trim($_POST['dept_id']));

  // check if name only contains letters and whitespace
  if (preg_match("/^[a-zA-Z& ]*$/",$item_name)) {

    $query = "SELECT * FROM items WHERE item_name ='$item_name' AND dept_id ='$dept_id' ";
    $fire  = mysqli_query($con,$query);

    if ($fire) {
        if (mysqli_num_rows($fire) == 0) {

            $query = "INSERT INTO  items(item_name,type_id,dept_id) VALUES('$item_name','$type_id','$dept_id')";

            $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));

  	        if ($fire) {
                $ms = array("icon"=>"success", "title"=>"Done", "text"=>"Item Added Successfully!");
  	            echo json_encode($ms);
            }else{        
    		        $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
    	    	    echo json_encode($ms);
        		}
        }
        else{
            $msg = array("icon"=>"error", "title"=>"Oops", "text"=>"Item already exist!");   
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

    $query = "SELECT * FROM items INNER JOIN category_type ON items.type_id = category_type.type_id WHERE item_id ='$id'";

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

  $item_id        = mysqli_real_escape_string($con,trim($_POST['item_id']));
  $item_name		  = mysqli_real_escape_string($con,trim($_POST['item_name']));
  $item_name		  = ucwords(strtolower($item_name));
  $dept_id        = $_SESSION['dept_id'];

    if (!empty($item_name)) {

      if (preg_match("/^[a-zA-Z& ]*$/",$item_name)) {

        $query = "SELECT * FROM items WHERE item_name='$item_name' AND dept_id='$dept_id'";
        $fire  = mysqli_query($con,$query) or die("can not access data .".mysqli_error($con));

          if ($fire) {

            if (mysqli_num_rows($fire)==0) {

                $query ="UPDATE items SET item_name = '$item_name' WHERE item_id=$item_id";
                $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

                if ($fire) {   
                  $ms = array("icon"=>"success", "title"=>"Done", "text"=>"Item Updated Successfully!");
                  echo json_encode($ms);
                }else{
                  $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
                  echo json_encode($ms);
                }
            
            }else{
                $ms = array("icon"=>"error", "title"=>"Oops", "text"=>"Item already exist!");    
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

    $q="SELECT * FROM units WHERE item_id='$delid'";
    $f=mysqli_query($con,$q) or die("can not access data .".mysqli_error($con));

    if ($f) {

      if (mysqli_num_rows($f)==0) {
    
        $query ="DELETE FROM items WHERE item_id='$delid'";

        $fire = mysqli_query($con,$query) or die("can not update data .".mysqli_error($con));

          if ($fire) {
          
            $m = array("icon"=>"success", "title"=>"Done", "text"=>"Item deleted successfully!");
            echo json_encode($m);
            
          }else{
        
              $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
              echo json_encode($m);
          }
      }else{
        $m = array("icon"=>"error", "title"=>"Oops", "text"=>"This item cannot be deleted!");
        echo json_encode($m);
      }
    } 
  }else{
    $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Id cannot be Empty!");
    echo json_encode($m);
  }
}