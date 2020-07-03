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



/****************************_______Get damaged stock Table________*********************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readdamage'])) {
  
  $record = '<table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="align-middle">Sl No.</th>
                  <th scope="col" class="align-middle">Date</th>
                  <th scope="col" class="align-middle">Usage</th>
                  <th scope="col" class="align-middle">Item Name</th>
                  <th scope="col" class="align-middle">Unit</th>
                  <!--<th scope="col" class="align-middle">Issued Quantity</th>
                  <th scope="col" class="align-middle">Active quantity</th>-->
                  <th scope="col" class="align-middle">Damaged quantity</th>
                  <th scope="col" class="align-middle">Damaged Reason</th>
                  <th scope="col" class="align-middle">Receiver Name</th>
                  <th scope="col" class="align-middle">Contact No</th>
                </tr>
              </thead>';

  $query = "SELECT * FROM damage_stock INNER JOIN receiver_non_recurring INNER JOIN non_recurring_stock ON damage_stock.receiver_id = receiver_non_recurring.receiver_id AND receiver_non_recurring.stock_id=non_recurring_stock.stock_id WHERE damage_stock.dept_id = '".$_SESSION['dept_id']."'";

  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      $no=1;
      while ($nr = mysqli_fetch_assoc($fire)) {

        $formatInput = 'Y-m-d'; //database date format
        $dateInput = $nr['damage_date']; //date from database

        $formatOut = 'd-m-Y'; // convert to this format
        $dateOut = DateTime::createFromFormat($formatInput, $dateInput)->format($formatOut);
        //final output of converted date formate

        $record .='<tbody id="myTable">
                  <tr>    
                      <td class="align-middle">'.$no.'</td>
                      <td class="align-middle">'.$dateOut.'</td>
                      
                      <td class="align-middle">'.$nr['used_for'].'</td>
                      <td class="align-middle">'.$nr['particular_name'].'</td>
                      <td class="align-middle">'.$nr['unit'].'</td>
                      <td class="align-middle">'.$nr['damage_quantity'].'</td>
                      <td class="align-middle">'.$nr['damage_reason'].'</td>
                      <td class="align-middle">'.$nr['receiver_name'].'</td>
                      <td class="align-middle">'.$nr['contact_no'].'</td>
                  </tr>';
                  $no++;
      }
  }else{
    $record .='<tbody>
              <tr>
                <td class="align-middle" scope="col" colspan="9">No Records Available</td>
              </tr>';
  }
  $record .='</tbody>
            </table>';
  echo $record;
}