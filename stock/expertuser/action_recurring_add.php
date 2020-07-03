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


/****************************_______Get stock register Table________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readstock'])) {
  
  $record = '<table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="align-middle">Date</th>
                  <th scope="col" class="align-middle">Usage</th>
                  <!--<th scope="col" class="align-middle">Particular name</th>
                  <th scope="col" class="align-middle">Particular type</th>--->
                  <th scope="col" class="align-middle">Particulars</th>
                  <th scope="col" class="align-middle">Unit</th>
                  <th scope="col" class="align-middle">Previous stock</th>
                  <th scope="col" class="align-middle">Add quantity</th>
                  <th scope="col" class="align-middle">Rate</th>
                  <th scope="col" class="align-middle">Amount</th>
                  <th scope="col" class="align-middle">Issued quantity</th>
                  <th scope="col" class="align-middle">Balance stock</th>
                  <th scope="col" class="align-middle">Remarks</th>
                </tr>
              </thead>';

  $query = "SELECT * FROM recurring_stock WHERE dept_id='".$_SESSION['dept_id']."' ORDER BY stock_id DESC";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      $no=1;
      while ($rec = mysqli_fetch_assoc($fire)) {
        //<td class="align-middle">'.$no.'</td>

        $formatInput = 'Y-m-d'; //database date format
        $dateInput = $rec['created_at']; //date from database

        $formatOut = 'd-m-Y'; // convert to this format
        $dateOut = DateTime::createFromFormat($formatInput, $dateInput)->format($formatOut);
        //final output of converted date formate

        $record .='<tbody id="myTable">
                  <tr>    
                      <td class="align-middle">'.$dateOut.'</td>
                      <td class="align-middle">'.$rec['used_for'].'</td>
                      <td class="align-middle">'.$rec['particular_name'].', '.$rec['particular_type'].'</td>
                      <td class="align-middle">'.$rec['unit'].'</td>
                      <td class="align-middle">'.$rec['previous_stock'].'</td>
                      <td class="align-middle">'.$rec['quantity'].'</td>
                      <td class="align-middle">'.$rec['price'].'</td>
                      <td class="align-middle">'.$rec['total_amount'].'</td>
                      <td class="align-middle">'.$rec['issued_quantity'].'</td>
                      <td class="align-middle">'.$rec['balance_stock'].'</td>
                      <td class="align-middle">'.$rec['remarks'].'</td>
                  </tr>';
                  $no++;
      }
  }else{
    $record .='<tbody>
              <tr>
                <td class="align-middle" scope="col" colspan="11">No Records Available</td>
              </tr>';
  }
  $record .='</tbody>
            </table>';
  echo $record;
}





/****************************____________ get the items _________***********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['adds1'])) {

  if ($_POST['datap']!=null) {
       
    $name = mysqli_real_escape_string($con,trim($_POST['datap']));

    $query = "SELECT * from category_type WHERE type_name='$name' AND dept_id = '".$_SESSION['dept_id']."'";
    $fire = mysqli_query($con,$query) or die("can not access data".mysqli_error($con));
    
    $na = mysqli_fetch_array($fire);

    $name_id=$na['type_id'];

    $query = "SELECT * from items WHERE type_id='$name_id' AND dept_id = '".$_SESSION['dept_id']."'";
    $fire = mysqli_query($con,$query) or die("can not access data".mysqli_error($con));
      ?>
        <option value="" selected="" disabled="">Select Item</option>
        <?php
        while ($r = mysqli_fetch_array($fire)) {
      ?>
        <option value="<?php echo $r['item_name']; ?>"><?php echo $r['item_name']; ?></option>
      <?php
        }
  }
}





/******************************_______________ get the units ____________******************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['adds2'])) {

  if ($_POST['data2']!=null) {
       
    $nam = mysqli_real_escape_string($con,trim($_POST['data2']));

    $query = "SELECT * from items WHERE item_name='$nam' AND dept_id = '".$_SESSION['dept_id']."'";
    $fire = mysqli_query($con,$query) or die("can not access data".mysqli_error($con));

    $n = mysqli_fetch_array($fire);
    
    $n_id=$n['item_id'];
        
    $query = "SELECT * from units WHERE item_id='$n_id' AND dept_id = '".$_SESSION['dept_id']."'";
    $fire = mysqli_query($con,$query) or die("can not access data".mysqli_error($con));
      ?>
        <option value="" selected="" disabled="">Select Unit</option>
        <?php
        while ($u = mysqli_fetch_array($fire)) {
      ?>
        <option value="<?php echo $u['unit_name']; ?>"><?php echo $u['unit_name']; ?></option>
      <?php
        }
  }
}





/***************************  Add Stock Register  ********************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {

  //get all the post variable value

  $used_for         = mysqli_real_escape_string($con,$_POST['used_for']);
  $particular_name  = mysqli_real_escape_string($con,$_POST['particular_name']);
  $particular_name  = ucwords(strtolower($particular_name));
  $particular_type  = mysqli_real_escape_string($con,$_POST['particular_type']);
  $quantity         = mysqli_real_escape_string($con,$_POST['quantity']);
  $unit             = mysqli_real_escape_string($con,$_POST['unit']);
  $price            = mysqli_real_escape_string($con,$_POST['price']);
  $total_amount     = mysqli_real_escape_string($con,$_POST['total_amount']);
  $remarks          = mysqli_real_escape_string($con,$_POST['remarks']);
  $dept_id          = mysqli_real_escape_string($con,$_POST['dept_id']);
  $updated          = date("Y-m-j");

  //since we are adding stock hence, issued quantity will be zero
  $issued_quantity = 0;

  //checking if the pevious records available in the backend table with same (name+unit+dept) combo

  //$query="SELECT * FROM `balance_stock_recurring` WHERE name='$particular_name' AND unit='$unit' AND dept_id='$dept_id'";
  
  $query="SELECT * FROM `recurring_stock_levels` WHERE name='$particular_name' AND unit='$unit' AND dept_id='$dept_id'";
  $fire  = mysqli_query($con,$query) or die("can not access data from database".mysqli_error($con));
  $item  = mysqli_fetch_array($fire);
    
  //check if the (item+unit+dept) is new to balance_stock_recurring
  
  if (mysqli_num_rows($fire) == 0) {

    //check the quantity to be added is for lab use or office use

    if ($used_for=="office") {
      $office_quantity=$quantity;
      $lab_quantity=0;
    }else if ($used_for=="lab") {
      $lab_quantity=$quantity;
      $office_quantity=0;
    }
    
    /*________________________________________ new entry to backend table ________________________________*/

    //$query="INSERT INTO `balance_stock_recurring`(`name`, `unit`, `office_quantity`, `lab_quantity`, `updated`, `dept_id`) VALUES ('$particular_name','$unit','$office_quantity','$lab_quantity','$updated','$dept_id')";
    
    $query="INSERT INTO `recurring_stock_levels`(`name`, `unit`, `office_quantity`, `lab_quantity`, `updated`, `dept_id`) VALUES ('$particular_name','$unit','$office_quantity','$lab_quantity','$updated','$dept_id')";

    $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));
            
    

    /*________________________________________ enter into stock register __________________________________*/
    
    //since no previous records available
    
    $previous_stock = 0;
    $balance_stock =$quantity;

    $q="INSERT INTO `recurring_stock`(`created_at`, `used_for`, `particular_name`, `particular_type`, `previous_stock`, `quantity`, `unit`, `price`, `total_amount`, `issued_quantity`, `balance_stock`, `remarks`, `dept_id`) VALUES ('$updated','$used_for','$particular_name','$particular_type','$previous_stock','$quantity','$unit','$price','$total_amount','$issued_quantity','$balance_stock','$remarks','$dept_id')";
          

    $f = mysqli_query($con,$q) or die("can not insert data into database. ".mysqli_error($con));

    if ($f) {

      //record in activity table
      $created_at= date("Y-m-d H:i:s");
      $activity_type= "stockadd";
      $activity_body= "You have added stock into recurring stock register : ".$quantity." ".$unit." of ".$particular_name." (".$used_for.").";
      $eu_id=$_SESSION['eu_id'];

      $query_n = "INSERT INTO `expert_user_activity`(`created_at`, `activity_type`, `activity_body`, `eu_id`) VALUES ('$created_at','$activity_type','$activity_body','$eu_id')";

      $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

      if ($fire_n) {
        $m = array("icon"=>"success", "title"=>"DONE", "text"=>"Stock successfully added!");    
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

    //there exist old record in balance_stock_recurring

    if ($used_for=="office") {
      
      //this will be required in adding stock register/record
      $previous_stock = $item['office_quantity'];

      //these will be required in updating backend table
      $quantity1 = $item['office_quantity'] + $quantity;
      $quantity2 = $item['lab_quantity'];

    }else if ($used_for=="lab") {

      //PS will be required in adding stock register/record
      $previous_stock = $item['lab_quantity'];

      //these will be required in updating backend table
      $quantity2 = $item['lab_quantity'] + $quantity;
      $quantity1 = $item['office_quantity'];
    } 

    /*___________________________________ update existing record in backend table _______________________________*/

    //$query = "UPDATE `balance_stock_recurring` SET `office_quantity`='$quantity1',`lab_quantity`='$quantity2',`updated`='$updated' WHERE name='$particular_name' AND unit='$unit' AND dept_id='$dept_id'";id

    //$query = "UPDATE `balance_stock_recurring` SET `office_quantity`='$quantity1',`lab_quantity`='$quantity2',`updated`='$updated' WHERE id='".$item['id']."'";
    
    $query = "UPDATE `recurring_stock_levels` SET `office_quantity`='$quantity1',`lab_quantity`='$quantity2',`updated`='$updated' WHERE id='".$item['id']."'";

    $fire = mysqli_query($con,$query) or die("can not update data into database. ".mysqli_error($con));
       
            
    /*___________________________________ enter into stock register ___________________________________*/
            
    $balance_stock =$previous_stock + $quantity;

    $q="INSERT INTO `recurring_stock`(`created_at`, `used_for`, `particular_name`, `particular_type`, `previous_stock`, `quantity`, `unit`, `price`, `total_amount`, `issued_quantity`, `balance_stock`, `remarks`, `dept_id`) VALUES ('$updated','$used_for','$particular_name','$particular_type','$previous_stock','$quantity','$unit','$price','$total_amount','$issued_quantity','$balance_stock','$remarks','$dept_id')";
    

    $f = mysqli_query($con,$q) or die("can not insert data into database. ".mysqli_error($con));

    if ($f) {

      //record in activity table
      $created_at= date("Y-m-d H:i:s");
      $activity_type= "stockadd";
      $activity_body= "You have added stock into recurring stock register : ".$quantity." ".$unit." of ".$particular_name." (".$used_for.").";
      $eu_id=$_SESSION['eu_id'];

      $query_n = "INSERT INTO `expert_user_activity`(`created_at`, `activity_type`, `activity_body`, `eu_id`) VALUES ('$created_at','$activity_type','$activity_body','$eu_id')";

      $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

      if ($fire_n) {
        $m = array("icon"=>"success", "title"=>"Done", "text"=>"Stock successfully added!");    
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
}



/****************************____________ checking the warning _________***********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['stock'])) {

  if(!empty($_POST['stock'])){

    //$query = "SELECT * from balance_stock_recurring WHERE dept_id = '".$_SESSION['dept_id']."'";
    
    $query = "SELECT * from recurring_stock_levels WHERE dept_id = '".$_SESSION['dept_id']."'";
    $fire = mysqli_query($con,$query) or die("can not access data".mysqli_error($con));

    if (mysqli_num_rows($fire)>0) {
      
      $records='';

      while ($warn = mysqli_fetch_assoc($fire)) {

        if ($warn['lab_quantity']>0 && $warn['lab_quantity']<5) {

          $records .= '<div class="warning_yellow war_open">
                        <div class="icon">
                          <i class="fas fa-exclamation-circle"></i>
                        </div>

                        <div class="msg">
                          <p>'.$warn['name'].' '.$warn['unit'].' (Lab), Less Stock! <p>
                        </div>
                        
                        <div class="cancel">
                          <i class="fas fa-times-circle" id="close1"></i>
                        </div>
                      </div>';
        }else if ($warn['lab_quantity']==0) {

          $records .= '<div class="warning_red war_open">
                        <div class="icon">
                          <i class="fas fa-exclamation-circle"></i>
                        </div>

                        <div class="msg">
                          <p>'.$warn['name'].' '.$warn['unit'].' (Lab), Out of stock! <p>
                        </div>
                        
                        <div class="cancel">
                          <i class="fas fa-times-circle" id="close"></i>
                        </div>
                      </div>';
        }

        if ($warn['office_quantity']>0 && $warn['office_quantity']<5) {
          
          $records .= '<div class="warning_yellow war_open">
                        <div class="icon">
                          <i class="fas fa-exclamation-circle"></i>
                        </div>

                        <div class="msg">
                          <p>'.$warn['name'].' '.$warn['unit'].' (Office), Less Stock! <p>
                        </div>
                        
                        <div class="cancel">
                          <i class="fas fa-times-circle" id="close1"></i>
                        </div>
                      </div>';
        }else if ($warn['office_quantity']==0) {

          $records .= '<div class="warning_red war_open">
                        <div class="icon">
                          <i class="fas fa-exclamation-circle"></i>
                        </div>

                        <div class="msg">
                          <p>'.$warn['name'].' '.$warn['unit'].' (Office), Out of stock! <p>
                        </div>
                        
                        <div class="cancel">
                          <i class="fas fa-times-circle" id="close"></i>
                        </div>
                      </div>';
        }                
      }
      echo $records;
    }
  }
}
?>
