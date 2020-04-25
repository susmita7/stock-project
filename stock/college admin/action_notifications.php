<?php require "../config/config.php"; 
  session_start();
  
  // check if super admin logged in or not
  if ($_SESSION['is_ca_login']) {  
    //keep user on page
  }else{
    //redirect on loginpage
    header("Location: login");
  }

extract($_POST);


/*************************************_____Get dept Admin Table________**************************************/

if (isset($_POST['readnotify'])) {
  
  $records = '<table class="table">
                <thead>
                  <tr>
                    <th>SL. No.
                    <th>From</th>
                    <th>Title</th>
                    <th>Message</th>
                  </tr>
                </thead>
                <tbody>';

  $query = "SELECT * FROM clg_admin_notify WHERE clg_id='".$_SESSION['clg_id']."'";

  $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

  if (mysqli_num_rows($fire)>0) {
      $no=1;

      while ($notify = mysqli_fetch_assoc($fire)) {
        
        if ($notify['notify_from']==0) {

          $records .='<tr class="success">
                        <td class="align-middle">'.$no.'</td>
                        <td>Super Admin</td>
                        <td>'.$notify['notify_title'].'</td>
                        <td>'.$notify['notify_message'].'</td>
                      </tr>';
        }else{
          $id = $notify['notify_from'];
          $q  = "SELECT dept_name FROM department WHERE dept_id= '$id'";
          $f  = mysqli_query($con,$q) or die("can not show data from database".mysqli_error($con));
          $noti = mysqli_fetch_array($f);
            $records .='<tr class="danger">
                        <td class="align-middle">'.$no.'</td>
                        <td>Department Admin of '.$noti['dept_name'].'</td>
                        <td>'.$notify['notify_title'].'</td>
                        <td>'.$notify['notify_message'].'</td>
                        <td><button>aprrove</button></td>
                      </tr>';
        }
      $no++;
    }
  }else{
    $records .='<tr class="info">
                <td colspan="7">No records availble</td>
              </tr>';
  }
  $records .='</tbody>
            </table>';
  echo $records;
}