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


/****************************_______Get stock register Table________*********************************/

if (isset($_POST['readreceiver'])) {
  
  $record = '<table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="align-middle">Sl No.</th>
                  <th scope="col" class="align-middle">Date</th>
                  <th scope="col" class="align-middle">Usage</th>
                  
                  <th scope="col" class="align-middle">Issued Quantity</th>
                  <th scope="col" class="align-middle">Unit</th>
                  <th scope="col" class="align-middle">Item name</th>
                  <th scope="col" class="align-middle">Receiver name</th>
                  <th scope="col" class="align-middle">Contact no</th>
                  <th scope="col" class="align-middle">Purpose</th>
                </tr>
              </thead>
              <tbody id="myTable">';

  $query = "SELECT * FROM receiver_recurring WHERE dept_id='".$_SESSION['dept_id']."' ORDER BY stock_id DESC";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      $no=1;
      while ($rec = mysqli_fetch_assoc($fire)) {

        $formatInput = 'Y-m-d'; //database date format
        $dateInput = $rec['date']; //date from database

        $formatOut = 'd-m-Y'; // convert to this format
        $dateOut = DateTime::createFromFormat($formatInput, $dateInput)->format($formatOut);
        //final output of converted date formate


        $record .='<tr>    
                      <td class="align-middle">'.$no.'</td>
                      <td class="align-middle">'.$dateOut.'</td>
                      <td class="align-middle">'.$rec['used_for'].'</td>
                      
                      <td class="align-middle">'.$rec['quantity'].'</td>
                      <td class="align-middle">'.$rec['unit'].'</td>
                      <td class="align-middle">'.$rec['item_name'].'</td>
                      <td class="align-middle">'.$rec['receiver_name'].'</td>
                      <td class="align-middle">'.$rec['contact_no'].'</td>
                      <td class="align-middle">'.$rec['purpose'].'</td>
                  </tr>';
                  $no++;
      }
  }else{
    $record .='<tr>
                <td class="align-middle" scope="col" colspan="9">No records availble</td>
              </tr>';
  }
  $record .='</tbody>
            </table>';
  echo $record;
}


/****************************____________ get stock groups _________***********************************/
if (isset($_POST['group'])) {
       
  $category="recurring";
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
if (isset($_POST['adds1'])) {

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
if (isset($_POST['adds2'])) {

    if ($_POST['data2']!=null) {
       
        $nam = mysqli_real_escape_string($con,$_POST['data2']);

        $query = "SELECT * from items WHERE item_name='$nam' AND dept_id = '".$_SESSION['dept_id']."'";
        $fire = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));
        $n = mysqli_fetch_array($fire);
        $n_id=$n['item_id'];
        
        $query = "SELECT * from units WHERE item_id='$n_id' AND dept_id = '".$_SESSION['dept_id']."'";
        $fire = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));?>
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
if (isset($_POST['adds3'])) {
    
    if ($_POST['used_for']!=null && $_POST['particular_name']!=null && $_POST['unit']!=null) {
        
        $used_for  =mysqli_real_escape_string($con,$_POST['used_for']);
        $name      =mysqli_real_escape_string($con,$_POST['particular_name']);
        $unit      =mysqli_real_escape_string($con,$_POST['unit']);
        
        $query = "SELECT quantity from balance_stock_recurring WHERE used_for='$used_for' AND name='$name' AND unit='$unit' AND dept_id = '".$_SESSION['dept_id']."'";
        $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

        if (mysqli_num_rows($fire) > 0) {
         // output data of each row
         $qu = mysqli_fetch_assoc($fire);
         echo $qu['quantity'];
        }
        else{
          $q=0;
          echo $q;
        }
    }
}

/*************************__________Issue Stock Register_______************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {

  $used_for         = mysqli_real_escape_string($con,trim($_POST['used_for']));
  $particular_name  = mysqli_real_escape_string($con,trim($_POST['particular_name']));
  $particular_name  = ucwords(strtolower($particular_name));
  $particular_type  = mysqli_real_escape_string($con,trim($_POST['particular_type']));
  $previous_stock   = mysqli_real_escape_string($con,$_POST['previous_stock']);
  $unit             = mysqli_real_escape_string($con,trim($_POST['unit']));
  $issued_quantity  = mysqli_real_escape_string($con,$_POST['issued_quantity']);
  $remarks          = mysqli_real_escape_string($con,trim($_POST['remarks']));
  date_default_timezone_set("Asia/kolkata");
  $updated          = date("Y-m-j");

  $receiver_name    = mysqli_real_escape_string($con,trim($_POST['receiver_name']));
  $receiver_name    = ucwords(strtolower($receiver_name));
  $receiver_dept    = mysqli_real_escape_string($con,$_POST['receiver_dept']);
  $contact_no       = mysqli_real_escape_string($con,$_POST['contact_no']);
  
  $dept_id          = mysqli_real_escape_string($con,$_POST['dept_id']);
    
  $query = "SELECT * FROM balance_stock_recurring WHERE used_for='$used_for' AND name ='$particular_name' AND unit='$unit' AND dept_id='$dept_id'";

  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));
  $raws  = mysqli_fetch_array($fire);
    
  if ($fire) {
          
    if (mysqli_num_rows($fire) == 1) {

      if ($previous_stock!=0 && $previous_stock>=$issued_quantity) {
         
        if (strlen($contact_no) ==10){

          /*--------------------------- adding in recurring stock register ------------------------------------*/

          $quantity=0;
          $price=0;
          $total_amount=0;

          $balance_stock = $previous_stock+$quantity-$issued_quantity;

          $q="INSERT INTO `recurring_stock`(`created_at`, `used_for`, `particular_name`, `particular_type`, `previous_stock`, `quantity`, `unit`, `price`, `total_amount`, `issued_quantity`, `balance_stock`, `remarks`, `dept_id`) VALUES ('$updated','$used_for','$particular_name','$particular_type','$previous_stock','$quantity','$unit','$price','$total_amount','$issued_quantity','$balance_stock','$remarks','$dept_id')";

          $f = mysqli_query($con,$q) or die("can not insert data into database. ".mysqli_error($con));
          if ($f) {
            $stock_id=mysqli_insert_id($con);
          }


          /*------------------------------------ updating backend table ------------------------------------*/
          
          $quantity1=$raws['quantity'];

          $quantity1=$quantity1-$issued_quantity;

          $query = "UPDATE balance_stock_recurring SET quantity='$quantity1',updated='$updated' WHERE used_for='$used_for' AND name='$particular_name' AND unit='$unit' AND dept_id='$dept_id'";

          $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));
  

          /*-----------------------------------___ adding receiver details__------------------------------------------*/
              

          $sql="INSERT INTO `receiver_recurring`(`date`, `used_for`, `item_name`, `quantity`, `unit`, `receiver_name`, `receiver_dept`, `contact_no`, `purpose`, `stock_id`, `dept_id`) VALUES ('$updated','$used_for','$particular_name','$issued_quantity','$unit','$receiver_name','$receiver_dept','$contact_no','$remarks','$stock_id','$dept_id')";
            
          $fires = mysqli_query($con,$sql) or die("can not insert data into database. ".mysqli_error($con));

          if ($f) {
            $m = array("icon"=>"success", "title"=>"Done", "text"=>"Successfully issued");    
            echo json_encode($m);
          }else{
            $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong");    
            echo json_encode($m);
          }
        }else{
          $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Mobile no is not valid");    
          echo json_encode($m);
        }
      }else{
        $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Sorry, Item stock not available!");    
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