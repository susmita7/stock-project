<?php require "../config/config.php"; ?>
<?php
  session_start();
  if ($_SESSION['is_da_login']) {
    //keep user on this page
  }
  else{
    //redirect to login page
    header("Location: ../choose") ;
  }

extract($_POST);

date_default_timezone_set("Asia/kolkata");


/*************************************_____Get files Table________**************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readfile'])) {
  
    $records = '<table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="align-middle">Sl No.</th>
                        <th scope="col" class="align-middle">File Name</th>
                        <th scope="col" class="align-middle">Approved Id</th>
                        <th scope="col" class="align-middle">Action</th>
                    </tr>
                </thead>';

    $query="SELECT * FROM file_details WHERE dept_id = '".$_SESSION['dept_id']."'";
                          
    $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

    if (mysqli_num_rows($fire)>0) {
        $no=1;
        while ($file = mysqli_fetch_assoc($fire)) {

            if (!isset($file['file_name'])) {

                $records .='<tbody id="myTable">
                  <tr>    
                    <td class="align-middle">'.$no.'</td>
                    <td class="align-middle">Not Available</td>
                    <td class="align-middle">'.$file['approved_id'].'</td>
                    <td class="align-middle">Yet to upload</td>
                  </tr>';
            }else{
                $records .='<tbody id="myTable">
                  <tr>    
                    <td class="align-middle">'.$no.'</td>
                    <td class="align-middle">'.$file['file_name'].'</td>
                    <td class="align-middle">'.$file['approved_id'].'</td>
                    <td class="align-middle">
                        <a target="_blank" href="'.$file['file_link'].'" id="add_file" type="button">View file</a>
                    </td>
                  </tr>';
            }
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