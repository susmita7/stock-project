<?php require "../config/config.php"; ?>
<?php
    session_start();
    if ($_SESSION['is_da_login']) {
    	//keep user on this page
    }else{
    	//redirect to login page
        header("Location: ../choose") ;
    }

    date_default_timezone_set("Asia/kolkata");

	extract($_POST);


/************************************__ rec table __*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readrec'])) {

    //$query = "SELECT * FROM balance_stock_recurring WHERE dept_id='".$_SESSION['dept_id']."'";
    
    $query = "SELECT * FROM recurring_stock_levels WHERE dept_id='".$_SESSION['dept_id']."'";
    $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

    //$row = mysqli_num_rows($fire);


    $reads = '<div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="align-middle" scope="col">Sl No.</th>
                            <th class="align-middle" scope="col">Updated</th>
                            <th class="align-middle" scope="col">Item</th>
                            <th class="align-middle" scope="col">Unit</th>
                            <th class="align-middle" scope="col">Office Quantity</th>
                            <th class="align-middle" scope="col">Lab Quantity</th>
                        </tr>
                    </thead>';

    if (mysqli_num_rows($fire)>0) {

    	$no=1;
        while ($r = mysqli_fetch_assoc($fire)) {


    	$reads .= '<tbody id="myTable1">
                    <tr>
                        <td class="align-middle">'.$no.'</td>
                        <td class="align-middle">'.$r['updated'].'</td>
                        <td class="align-middle">'.$r['name'].'</td>
                        <td class="align-middle">'.$r['unit'].'</td>
                        <td class="align-middle">'.$r['office_quantity'].'</td>
                        <td class="align-middle">'.$r['lab_quantity'].'</td>
                    </tr>';
                    $no++;
        }

    }else{

    	$reads .='<tbody>
		              <tr>
		                <td class="align-middle" scope="col" colspan="6">No Records Available</td>
		              </tr>';
    }
  $reads .='</tbody>
            </table>
            </div>';
  echo $reads;
}





/************************************__ non rec table __*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readnonrec'])) {

    $query = "SELECT * FROM non_recurring_stock_levels WHERE dept_id='".$_SESSION['dept_id']."'";

    $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

    //$row = mysqli_num_rows($fire);


    $reads = '<div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="align-middle" scope="col">Sl No.</th>
                            <th class="align-middle" scope="col">Updated</th>
                            <th class="align-middle" scope="col">Item</th>
                            <th class="align-middle" scope="col">Unit</th>
                            <th class="align-middle" scope="col">Office Quantity</th>
                            <th class="align-middle" scope="col">Lab Quantity</th>
                        </tr>
                    </thead>';

    if (mysqli_num_rows($fire)>0) {

        $no=1;
        while ($n = mysqli_fetch_assoc($fire)) {


        $reads .= '<tbody id="myTable2">
                    <tr>
                        <td class="align-middle">'.$no.'</td>
                        <td class="align-middle">'.$n['updated'].'</td>
                        <td class="align-middle">'.$n['name'].'</td>
                        <td class="align-middle">'.$n['unit'].'</td>
                        <td class="align-middle">'.$n['office_quantity'].'</td>
                        <td class="align-middle">'.$n['lab_quantity'].'</td>
                    </tr>';
                    $no++;
        }

    }else{

        $reads .='<tbody>
                      <tr>
                        <td class="align-middle" scope="col" colspan="6">No Records Available</td>
                      </tr>';
    }
  $reads .='</tbody>
            </table>
            </div>';
  echo $reads;
}