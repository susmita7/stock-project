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

if (isset($_POST['readstock'])) {
  
  $record = '<table class="table table-striped table-bordered">
              <thead>
                <tr>
                  
                  <th scope="col" class="align-middle">Date</th>
                  <th scope="col" class="align-middle">Usage</th>
                  <th scope="col" class="align-middle">Particular name</th>
                  <th scope="col" class="align-middle">Particular type</th>
                  <th scope="col" class="align-middle">Previous stock</th>
                  <th scope="col" class="align-middle">Add Quantity</th>
                  <th scope="col" class="align-middle">Unit</th>
                  <th scope="col" class="align-middle">Rate</th>
                  <th scope="col" class="align-middle">Amount</th>
                  <th scope="col" class="align-middle">Issued Quantity</th>
                  <th scope="col" class="align-middle">Balance stock</th>
                  <th scope="col" class="align-middle">Remarks</th>
                </tr>
              </thead>
              <tbody id="myTable">';

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

        $record .='<tr>    
                      <td class="align-middle">'.$dateOut.'</td>
                      <td class="align-middle">'.$rec['used_for'].'</td>
                      <td class="align-middle">'.$rec['particular_name'].'</td>
                      <td class="align-middle">'.$rec['particular_type'].'</td>
                      <td class="align-middle">'.$rec['previous_stock'].'</td>
                      <td class="align-middle">'.$rec['quantity'].'</td>
                      <td class="align-middle">'.$rec['unit'].'</td>
                      <td class="align-middle">'.$rec['price'].'</td>
                      <td class="align-middle">'.$rec['total_amount'].'</td>
                      <td class="align-middle">'.$rec['issued_quantity'].'</td>
                      <td class="align-middle">'.$rec['balance_stock'].'</td>
                      <td class="align-middle">'.$rec['remarks'].'</td>
                  </tr>';
                  $no++;
      }
  }else{
    $record .='<tr>
                <td class="align-middle" scope="col" colspan="13">No records availble</td>
              </tr>';
  }
  $record .='</tbody>
            </table>';
  echo $record;
}



/****************************____________ get the items _________***********************************/
if (isset($_POST['adds1'])) {

    if ($_POST['datap']!=null) {
       
        $name = $_POST['datap'];

        $query = "SELECT * from category_type WHERE type_name='$name' AND dept_id = '".$_SESSION['dept_id']."'";
        $fire = mysqli_query($con,$query);
        $na = mysqli_fetch_array($fire);

        $name_id=$na['type_id'];

        $query = "SELECT * from items WHERE type_id='$name_id' AND dept_id = '".$_SESSION['dept_id']."'";
        $fire = mysqli_query($con,$query);?>
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
       
        $nam = $_POST['data2'];

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

/*****************************____________ get the unit _____________***************************/
/*if ($_POST['dat2']!=null) {
   
    $na = $_POST['dat2'];

    $query = "SELECT * from items WHERE item_name='$na' AND dept_id = '".$_SESSION['dept_id']."'";
    $fire = mysqli_query($con,$query);
    $r = mysqli_fetch_array($fire);
    $r_id=$r['item_id'];
    
    $query = "SELECT * from units WHERE item_id='$r_id' AND dept_id = '".$_SESSION['dept_id']."'";
    $fire = mysqli_query($con,$query);?>
    <option value="" selected="" disabled="">Select Unit</option>
    <?php
    while ($unit = mysqli_fetch_array($fire)) {
  ?>
    <option value="<?php echo $unit['unit_name']; ?>"><?php echo $unit['unit_name']; ?></option>
  <?php
    }
}*/


/**********************************  Add Stock Register  ****************************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {

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
    //$created_at       = date("Y-m-j");
    //$previous_stock   = real_escape_string($_POST['previous_stock']);
    //$issued_quantity  = real_escape_string($_POST['issued_quantity']);
    //$balance_stock    = real_escape_string($_POST['balance_stock']);
    date_default_timezone_set("Asia/kolkata");
    $updated=date("Y-m-j");

    $query="SELECT * FROM `balance_stock_recurring` WHERE used_for='$used_for' AND name='$particular_name' AND unit='$unit' AND dept_id='$dept_id'";
    $fire  = mysqli_query($con,$query) or die("can not access data from database".mysqli_error($con));
    $item  = mysqli_fetch_array($fire);
    
    if (mysqli_num_rows($fire) == 0) {
            
        $reorder_point=10;

        $query = "INSERT INTO `balance_stock_recurring`(`used_for`, `name`, `quantity`, `unit`, `updated`, `reorder_point`, `dept_id`) VALUES ('$used_for','$particular_name','$quantity','$unit','$updated','$reorder_point','$dept_id')";

        $fire = mysqli_query($con,$query) or die("can not insert data into database. ".mysqli_error($con));
            
        //enter into stock register

          $previous_stock = 0;
          $issued_quantity = 0;
          $balance_stock =$previous_stock+$quantity-$issued_quantity;

          $q="INSERT INTO `recurring_stock`(`created_at`, `used_for`, `particular_name`, `particular_type`, `previous_stock`, `quantity`, `unit`, `price`, `total_amount`, `issued_quantity`, `balance_stock`, `remarks`, `dept_id`) VALUES ('$updated','$used_for','$particular_name','$particular_type','$previous_stock','$quantity','$unit','$price','$total_amount','$issued_quantity','$balance_stock','$remarks','$dept_id')";
          

          $f = mysqli_query($con,$q) or die("can not insert data into database. ".mysqli_error($con));

          if ($f) {
            $m = array("icon"=>"success", "title"=>"DONE", "text"=>"Stock Successfully Added!");    
            echo json_encode($m);
          }else{
            $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
            echo json_encode($m);
          }
    }else{
            
          $previous_stock = $item['quantity'];

          //update items table

          $quantity1 = $item['quantity'] + $quantity;

          $query = "UPDATE balance_stock_recurring SET quantity='$quantity1',updated='$updated' WHERE used_for='$used_for' AND name='$particular_name' AND unit='$unit' AND dept_id='$dept_id'";

            $fire = mysqli_query($con,$query) or die("can not update data into database. ".mysqli_error($con));
       
            
              //enter into stock register
            
              $issued_quantity = 0;
              $balance_stock =$previous_stock + $quantity - $issued_quantity;

              $q="INSERT INTO `recurring_stock`(`created_at`, `used_for`, `particular_name`, `particular_type`, `previous_stock`, `quantity`, `unit`, `price`, `total_amount`, `issued_quantity`, `balance_stock`, `remarks`, `dept_id`) VALUES ('$updated','$used_for','$particular_name','$particular_type','$previous_stock','$quantity','$unit','$price','$total_amount','$issued_quantity','$balance_stock','$remarks','$dept_id')";
             /* 
              $q = "INSERT INTO recurring_stock(created_at,used_for,particular_name,particular_type,previous_stock,quantity,unit,price,total_amount,issued_quantity,balance_stock,remarks,dept_id) VALUES('$updated',$used_for','$particular_name','$particular_type','$previous_stock','$quantity','$unit','$price','$total_amount','$issued_quantity','$balance_stock','$remarks','$dept_id')";*/

              $f = mysqli_query($con,$q) or die("can not insert data into database. ".mysqli_error($con));

                if ($f) {
                    $m = array("icon"=>"success", "title"=>"Done", "text"=>"Stock Successfully Added!");    
                    echo json_encode($m);
                }else{
                    $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
                    echo json_encode($m);
                }
    }
}