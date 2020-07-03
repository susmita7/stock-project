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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readreceiver'])) {
  
  $record = '<table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="align-middle">Date</th>
                  <th scope="col" class="align-middle">Usage</th>   
                  <th scope="col" class="align-middle">Issued quantity</th>
                  <th scope="col" class="align-middle">Unit</th>
                  <th scope="col" class="align-middle">Item name</th>
                  <th scope="col" class="align-middle">Receiver name</th>
                  <th scope="col" class="align-middle">Contact no</th>
                  <th scope="col" class="align-middle">Purpose</th>
                  <th scope="col" class="align-middle">Active Item</th>
                  <th scope="col" class="align-middle">Damage Item</th>
                  <th scope="col" class="align-middle">Action</th>
                </tr>
              </thead>';

  //$query = "SELECT * FROM receiver_non_recurring WHERE dept_id='".$_SESSION['dept_id']."' ORDER BY stock_id DESC";
  
  $query = "SELECT * FROM receiver_non_recurring INNER JOIN non_recurring_stock ON receiver_non_recurring.stock_id=non_recurring_stock.stock_id WHERE dept_id='".$_SESSION['dept_id']."' ORDER BY receiver_id DESC";
  
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      //$no=1;
      while ($nrec = mysqli_fetch_assoc($fire)) {

        $formatInput = 'Y-m-d'; //database date format
        $dateInput = $nrec['created_at']; //date from database

        $formatOut = 'd-m-Y'; // convert to this format
        $dateOut = DateTime::createFromFormat($formatInput, $dateInput)->format($formatOut);
        //final output of converted date formate

        $record .='<tbody id="myTable">
                  <tr>    
                      <td class="align-middle">'.$dateOut.'</td>
                      <td class="align-middle">'.$nrec['used_for'].'</td>
                      <td class="align-middle">'.$nrec['issued_quantity'].'</td>
                      <td class="align-middle">'.$nrec['unit'].'</td>
                      <td class="align-middle">'.$nrec['particular_name'].'</td>
                      <td class="align-middle">'.$nrec['receiver_name'].'</td>
                      <td class="align-middle">'.$nrec['contact_no'].'</td>
                      <td class="align-middle">'.$nrec['remarks'].'</td>
                      <td class="align-middle">'.$nrec['active_item'].'</td>
                      <td class="align-middle">'.$nrec['damage_item'].'</td>
                      <td class="align-middle">
                          <a type="button" id="del_ad" class="editbtn" onclick="getRec('.$nrec['receiver_id'].')">Damage</a>
                      </td>
                  </tr>';
                  //$no++;
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





/****************************____________ get stock groups _________***********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['group'])) {
       
  $category="non-recurring";
  $query = "SELECT * FROM  category_type WHERE category='$category' AND dept_id='".$_SESSION['dept_id']."'";

  $fire = mysqli_query($con,$query) or die("can not display data from database. ".mysqli_error($con));

  if ($fire) {
    ?>
    <option value="" selected="" disabled="">Select Stockgroup</option>
    <?php
    while ($type = mysqli_fetch_array($fire)) {
      ?>
      <option value="<?= $type['type_name']; ?>"><?php echo $type['type_name']; ?></option>
      <?php
    }
  }
}





/****************************____________ get the items _________***********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['adds1'])) {

  if ($_POST['datap']!=null) {
       
    $name = mysqli_real_escape_string($con,$_POST['datap']);

    $query = "SELECT * from category_type WHERE type_name='$name' AND dept_id = '".$_SESSION['dept_id']."'";
    $fire = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));
        
    $na = mysqli_fetch_array($fire);

    $name_id=$na['type_id'];

    $query = "SELECT * from items WHERE type_id='$name_id' AND dept_id = '".$_SESSION['dept_id']."'";
    $fire = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));?>
        
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
       
    $nam = mysqli_real_escape_string($con,$_POST['data2']);

    $query = "SELECT * from items WHERE item_name='$nam' AND dept_id = '".$_SESSION['dept_id']."'";
    $fire = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));
    
    $n = mysqli_fetch_array($fire);
    $n_id=$n['item_id'];
        
    $query = "SELECT * from units WHERE item_id='$n_id' AND dept_id = '".$_SESSION['dept_id']."'";
    $fire = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));
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





/*******************_________ get the available quantity from stock records______________*************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['adds3'])) {
    
  if ($_POST['used_for']!=null && $_POST['particular_name']!=null && $_POST['unit']!=null) {
        
    $used_for  =mysqli_real_escape_string($con,$_POST['used_for']);
    $name      =mysqli_real_escape_string($con,$_POST['particular_name']);
    $unit      =mysqli_real_escape_string($con,$_POST['unit']);
        
    //$query = "SELECT quantity from balance_stock_non_recurring WHERE used_for='$used_for' AND name='$name' AND unit='$unit' AND dept_id = '".$_SESSION['dept_id']."'";

    $query = "SELECT * FROM non_recurring_stock_levels WHERE name='$name' AND unit='$unit' AND dept_id = '".$_SESSION['dept_id']."'";

    $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

    if (mysqli_num_rows($fire) > 0) {

      // output data of each row

      $qu = mysqli_fetch_assoc($fire);

      if ($used_for=="office") {
        echo $qu['office_quantity'];
      }else if ($used_for=="lab") {
        echo $qu['lab_quantity'];
      }
    }else{
      $q=0;
      echo $q;
    }
  }
}





/*************************__________Issue Stock Register_______************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {

  $used_for         = mysqli_real_escape_string($con,$_POST['used_for']);
  $particular_name  = mysqli_real_escape_string($con,trim($_POST['particular_name']));
  //$particular_name  = ucwords(strtolower($particular_name));
  $particular_type  = mysqli_real_escape_string($con,$_POST['particular_type']);
  $previous_stock   = mysqli_real_escape_string($con,$_POST['previous_stock']);
  $unit             = mysqli_real_escape_string($con,$_POST['unit']);
  $issued_quantity  = mysqli_real_escape_string($con,$_POST['issued_quantity']);
  $remarks          = mysqli_real_escape_string($con,trim($_POST['remarks']));

  $updated          = date("Y-m-j");

  $receiver_name    = mysqli_real_escape_string($con,trim($_POST['receiver_name']));
  $receiver_name    = ucwords(strtolower($receiver_name));
  //$receiver_dept    = mysqli_real_escape_string($con,$_POST['receiver_dept']);
  $contact_no       = mysqli_real_escape_string($con,$_POST['contact_no']);
  
  $dept_id          = mysqli_real_escape_string($con,$_POST['dept_id']);


  //get the older details with same (item+unit+dept) combo
    
  $query = "SELECT * FROM non_recurring_stock_levels WHERE name ='$particular_name' AND unit='$unit' AND dept_id='$dept_id'";
    
  //$query = "SELECT * FROM balance_stock_non_recurring WHERE used_for='$used_for' AND name ='$particular_name' AND unit='$unit' AND dept_id='$dept_id'";

  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));
  $raws  = mysqli_fetch_array($fire);
    
  if ($fire) {
          
    if (mysqli_num_rows($fire) == 1) {

      if ($previous_stock>0 && $issued_quantity<=$previous_stock) {

        /*__________________________________ updating backend table _________________________________*/
          
        $quantity1=$raws['office_quantity'];
        $quantity2=$raws['lab_quantity'];

        if ($used_for=="office") {
          $quantity1=$quantity1-$issued_quantity;
        }else if ($used_for=="lab") {
          $quantity2=$quantity2-$issued_quantity;
        }

        $query = "UPDATE non_recurring_stock_levels SET office_quantity='$quantity1',lab_quantity='$quantity2',updated='$updated' WHERE name='$particular_name' AND unit='$unit' AND dept_id='$dept_id'";

        $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));



        /*_____________________________ adding in recurring stock register ___________________________*/

        //since we are issuing stock hence, add quantity, price & total amount becomes zero 
        $quantity=0;
        $price=0;
        $total_amount=0;

        $balance_stock = $previous_stock-$issued_quantity;

        $q="INSERT INTO `non_recurring_stock`(`created_at`, `used_for`, `particular_name`, `particular_type`, `previous_stock`, `quantity`, `unit`, `price`, `total_amount`, `issued_quantity`, `balance_stock`, `remarks`, `dept_id`) VALUES ('$updated','$used_for','$particular_name','$particular_type','$previous_stock','$quantity','$unit','$price','$total_amount','$issued_quantity','$balance_stock','$remarks','$dept_id')";

        $f = mysqli_query($con,$q) or die("can not insert data into database. ".mysqli_error($con));
          
        if ($f) {
          //get the added stock id
          $stock_id=mysqli_insert_id($con);
        }


        /*____________________________________ adding receiver details ____________________________*/


        $damage=0;
        $active=$issued_quantity;


        $sql="INSERT INTO `receiver_non_recurring`(`receiver_name`, `contact_no`, `active_item`, `damage_item`, `stock_id`) VALUES ('$receiver_name','$contact_no','$active','$damage','$stock_id')";
          
  
        $fires = mysqli_query($con,$sql) or die("can not insert data into database. ".mysqli_error($con));

        if ($fires) {

          $created_at= date("Y-m-d H:i:s");
          $activity_type= "issuestock";
          $activity_body= "You have issued non-recurring stock : ".$issued_quantity." ".$unit." of ".$particular_name." (".$used_for.").";
          $eu_id=$_SESSION['eu_id'];

          $query_n = "INSERT INTO `expert_user_activity`(`created_at`, `activity_type`, `activity_body`, `eu_id`) VALUES ('$created_at','$activity_type','$activity_body','$eu_id')";

          $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

          if ($fire_n) {
            $m = array("icon"=>"success", "title"=>"Done", "text"=>"Stock issued successfully");    
            echo json_encode($m);
          }else{
            $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong");    
            echo json_encode($m);
          }
        }else{
          $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong");    
          echo json_encode($m);
        }
      }else{
        $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Sorry, item out of stock!");    
        echo json_encode($m);
      }
    }else{
      $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
      echo json_encode($m);
    }
  }else{
    $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something went wrong!");    
    echo json_encode($m);
  }
}





/**********************************_____get receiver id nd send details ______*************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    
  $id=mysqli_real_escape_string($con,trim($_POST['id']));

  $query = "SELECT * FROM receiver_non_recurring INNER JOIN non_recurring_stock ON receiver_non_recurring.stock_id = non_recurring_stock.stock_id WHERE receiver_id ='$id'";

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





/*************************__________ damage stock add_______************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['damage'])) {

  $receiver_id         = mysqli_real_escape_string($con,trim($_POST['receiver_id']));
  $damage_quantity     = mysqli_real_escape_string($con,trim($_POST['damage_quantity']));
  $active_quantity     = mysqli_real_escape_string($con,trim($_POST['active_quantity']));
  $damage_reason       = mysqli_real_escape_string($con,trim($_POST['damage_reason']));
  $dept_id             = mysqli_real_escape_string($con,trim($_POST['dept_id']));

  $damage_date          = date("Y-m-j");

  $query = "SELECT * FROM receiver_non_recurring WHERE receiver_id='$receiver_id'";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));
  $receive  = mysqli_fetch_array($fire);

    
  if ($fire) {
          
    if (mysqli_num_rows($fire) == 1) {

      if ($damage_quantity>0) {

        $active_quantity=$active_quantity-$damage_quantity;
         

        /*--------------------------- adding in damage items table ------------------------------------*/

        
        $q="INSERT INTO `damage_stock`(`damage_date`, `active_quantity`, `damage_quantity`, `damage_reason`, `receiver_id`, `dept_id`) VALUES ('$damage_date','$active_quantity','$damage_quantity','$damage_reason','$receiver_id','$dept_id')";

        $f = mysqli_query($con,$q) or die("can not insert data into database. ".mysqli_error($con));

        
        /*------------------------------------ updating receiver table ------------------------------------*/
          
        $active_item=$receive['active_item'];

        $active_item=$active_item-$damage_quantity;

        $damage_item=$receive['damage_item'];
        
        if ($damage_item==0) {
          $damage_item=$damage_quantity;
        }else{
          $damage_item=$damage_item+$damage_quantity;
        }

        $query = "UPDATE receiver_non_recurring SET active_item='$active_item',damage_item='$damage_item' WHERE receiver_id='$receiver_id'";

        $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));
  
        if ($fire) {
          $m = array("icon"=>"success", "title"=>"Done", "text"=>"Successfully updated!");    
          echo json_encode($m);
        }else{
          $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
          echo json_encode($m);
        }
      }else{
        $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Sorry, quantity cannot be zero!");    
        echo json_encode($m);
      }
    }else{
      $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
      echo json_encode($m);
    }
  }else{
    $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
    echo json_encode($m);
  }
}