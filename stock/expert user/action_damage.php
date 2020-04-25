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

if (isset($_POST['readdamage'])) {
  
  $record = '<table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="align-middle">Sl No.</th>
                  <th scope="col" class="align-middle">Date</th>
                  <th scope="col" class="align-middle">Usage</th>
                  <th scope="col" class="align-middle">Item Name</th>
                  <th scope="col" class="align-middle">Unit</th>
                  <th scope="col" class="align-middle">Issued Quantity</th>
                  <th scope="col" class="align-middle">Damage Quantity</th>
                  <th scope="col" class="align-middle">Damage Reason</th>
                  <th scope="col" class="align-middle">Receiver Name</th>
                  <th scope="col" class="align-middle">Contact No</th>
                </tr>
              </thead>
              <tbody id="myTable">';

  $query = "SELECT * FROM damage_items INNER JOIN receiver_non_recurring ON damage_items.receiver_id = receiver_non_recurring.receiver_id AND damage_items.dept_id = receiver_non_recurring.dept_id = '".$_SESSION['dept_id']."'";
  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      $no=1;
      while ($nr = mysqli_fetch_assoc($fire)) {

        $record .='<tr>    
                      <td class="align-middle">'.$no.'</td>
                      <td class="align-middle">'.$nr['damage_date'].'</td>
                      <td class="align-middle">'.$nr['used_for'].'</td>
                      <td class="align-middle">'.$nr['item_name'].'</td>
                      <td class="align-middle">'.$nr['unit'].'</td>
                      <td class="align-middle">'.$nr['quantity'].'</td>
                      <td class="align-middle">'.$nr['damage_quantity'].'</td>
                      <td class="align-middle">'.$nr['damage_reason'].'</td>
                      <td class="align-middle">'.$nr['receiver_name'].'</td>
                      <td class="align-middle">'.$nr['contact_no'].'</td>
                  </tr>';
                  $no++;
      }
  }else{
    $record .='<tr>
                <td class="align-middle" scope="col" colspan="10">No records availble</td>
              </tr>';
  }
  $record .='</tbody>
            </table>';
  echo $record;
}