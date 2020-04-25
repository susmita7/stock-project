<?php require "./config/config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {

    if ($_POST['datavalue']!=null) {

        $nameid = $_POST['datavalue'];

        $query = "SELECT * from department WHERE clg_id = '$nameid'";
        $fire = mysqli_query($con,$query);
            ?>
            <option value="" selected="" disabled="">Select Department</option>
            <?php
        while ($rows = mysqli_fetch_array($fire)) {
            ?>
            <option value="<?php echo $rows['dept_name']; ?>"><?php echo $rows['dept_name']; ?></option>
            <?php
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['choose'])) {

    if (!empty($_POST['dept_name'])) {
        
        if ($_POST['clg_id']!=null && $_POST['dept_name']!=null) {

            $clg_id     = mysqli_real_escape_string($con,trim($_POST['clg_id']));
            $dept_name  = mysqli_real_escape_string($con,(trim($_POST['dept_name'])));

            $query = "SELECT * FROM department WHERE dept_name ='$dept_name' AND clg_id ='$clg_id'";
            $fire  = mysqli_query($con,$query);

            if ($fire) {
                if (mysqli_num_rows($fire) == 1) {
                  
                  $_SESSION['depts_name'] = $dept_name;
                  $_SESSION['is_dept'] = true;
                  $row = mysqli_fetch_assoc($fire);
                  $m = array("icon"=>"success", "title"=>"Done", "text"=>"Successful!");    
                  echo json_encode($m);
                }else{
                    $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
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
    }else{
        $m = array("icon"=>"error", "title"=>"Oops", "text"=>"Something Went Wrong!");    
        echo json_encode($m);
    }
}