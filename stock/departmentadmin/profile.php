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
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Department Admin Profile | Stockpile</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    
    <!--------------------------------------------------css link 
        ----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/media_dashboard.css">
    <!--------------------------------------------------bootstrap css link 
        ----------------------------------------------------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <!--------------------------------------------------font asesome link
        ----------------------------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    
    <!--------------------------------------------------google fonts link 
        ----------------------------------------------------------->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins:300&display=swap" rel="stylesheet">

    

    <!--------------------------------------------------input file button script
        ------------------------------------------------->

    <script>
        (function (e, t, n) {
            var r = e.querySelectorAll("html")[0];
            r.className = r.className.replace(/(^|\s)no-js(\s|$)/, "$1js$2")
        })(document, window, 0);
    </script>

    <!------------------------------------------------- To change the Image 
        ----------------------------------------------------->
    <script type="text/javascript">
        function PreviewImage() {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("file-2").files[0]);

            var property=document.getElementById("file-2").files[0];
            var image_name=property.name;
            var image_extension=image_name.split('.').pop().toLowerCase();
            var image_size=property.size;

            if ($.inArray(image_extension,['png','jpg','jpeg'])== -1) {
                swal("Oops", "Invalid Image File", "warning");
                $("#file-2").val('');
            }else if (image_size>2000000) {
                swal("Oops", "Image File size is very big", "warning");
                $("#file-2").val('');
            }else{
            oFReader.onload = function (oFREvent) {
               document.getElementById("uploadPreview").src = oFREvent.target.result;
           }
            };
        };
    </script>
</head>


<body onload="renderDate()">
    <div class="wrapper">
     <!-----------------------------------------side menu open close-------------------------------------->
         <div class="side_menu" id="menu">
            <div class="side_menu_close_btn" onclick="side_menu_open()">
                <a><i class="fas fa-window-close"></i></a>
            </div>

            <!---------------------------------------- profile ----------------------------------->
            <div id="info" class="admin con_tabs">
                <!------------------ show profile picture and name here
                    ----------------------->
            </div>

            <!---------------------------------------------------- side manu tabs ------------------------------------>
            <div class="tabs">
                <div class="con_tabs">
                    <a href="home" class="con_tabs_links"><i class="fas fa-home"></i>
                        Dashboard</a>

                    <a href="expert_user" class="con_tabs_links"><i class="fas fa-user"></i>
                        Expert Users</a>
                    <a href="stock_groups" class="con_tabs_links"><i class="fas fa-object-group"></i>
                        Stock Groups</a>
                    <a href="stocks" class="con_tabs_links"><i class="fas fa-cubes"></i> Stock Details</a>
                    <a href="orders" class="con_tabs_links"><i class="fas fa-copy"></i> File Details</a>
                    <a href="notifications" class="con_tabs_links">
                        <div id="getcount">
                            <!---------- show notification count
                                ------------------>
                        </div>
                        <i class="fas fa-bell"></i> Notifications
                    </a>
                    <a href="activity" class="con_tabs_links"><i class="fa fa-history" aria-hidden="true"></i> Activity Logs</a>
                </div>
            </div>
            

            <!---------------------------------------------------- copyright------------------------------------------->
            <div class="side_menu_footer">
                <div class="logo_title">
                    <img src="images/favicon.png">
                    <h3>STOCKPILE</h3>
                </div>
                <h5>All rights reserved,copyright&copy; STOCKPILE,2020</h5>
            </div>

        </div>

        <!---------------------------------------------------top nav ---------------------------------------------->
        <div class="top_content">

            <div class="top_nav">
                <!---------------------------------------------------- heading ------------------------------------------>
                <div class="top_nav_heading">
                 <!-----------------------------------------side menu open close-------------------------------------->
                    <div class="hamburger" onclick="side_menu_open()">
                        <a><i class="fas fa-bars"></i></a>
                    </div>
                    <h3><?php echo $_SESSION['dept_name']; ?> Department</h3>
                </div>

                <div class="top_nav_contents">
                    <!---------------------------------------------------- clock---------------------------------------------->
                    <div class="clock">
                        <i class="fas fa-clock"></i>
                        <div id="time" onload="showTime()"></div>
                    </div>
                    <!---------------------------------------------------date ---------------------------------------------->
                    <div class="date">

                        <i class="fas fa-calendar-day"></i>

                        <?php

                            date_default_timezone_set("Asia/kolkata");

                            echo date("d-m-y");

                        ?>

                        <i class="fas fa-angle-down" id="angle_arrow" onclick="show_calendar()"></i>

                        <div class="calendar_wrapper" id="calendar">
                            <div class="calendar">

                                <div class="month">
                                    <div class="prev" onclick="moveDate('prev')">
                                        <span>&#10094;</span>
                                    </div>
                                    <div>
                                        <h2 id="month"></h2>
                                        <p id="date_str"></p>
                                    </div>
                                    <div class="next" onclick="moveDate('next')">
                                        <span>&#10095;</span>
                                    </div>
                                </div>
                                <div class="weekdays">
                                    <div>Sun</div>
                                    <div>Mon</div>
                                    <div>Tue</div>
                                    <div>Wed</div>
                                    <div>Thu</div>
                                    <div>Fri</div>
                                    <div>Sat</div>
                                </div>
                                <div class="days">

                                </div>

                            </div>
                        </div>

                    </div>

                    <!-------------------------------------------notification 
                        ---------------------------------->
                    <div id="notify_records" class="noti">
                        <!-------------------------------- show notificatiions here
                            --------------------------------------->
                    </div>

                    <!-------------------------------------------- logout---------------------------------------------->
                    <div class="logout">
                        <a type="button" onclick="getLogout()">Logout</a>
                    </div>


                </div>

            </div>

            <div class="content">


                <!---------------------- profile box ---------------------------->
                <!--<div class="base_profile">

                    <div class="left_side">
                        <div class="heading">
                            <h3>YOUR PROFILE</h3>
                            <div class="pic">
                                <img src="images/face.jpg">
                            </div>

                        </div>
                        <div class="icons">
                                <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                                <a href="https://www.instagram.com/?hl=en"  target="_blank"><i class="fab fa-instagram"></i></a>
                                <a href="https://twitter.com/explore"  target="_blank"><i class="fab fa-twitter"></i></a>

                            </div>
                    </div>
                    <div class="middle"></div>
                    <div class="right_side">
                        <div class="info">
                            <h4>Name : Priya Subhalakhmi Hazarika</h4>
                            <h4>Email ID : susmitasharma3751@gmail.com</h4>
                            <h4>Phone No. :908123456</h4>
                        </div>

                        <div class="up_re_btn">
                            <a id="up_pro" type="button" onclick="overlay_update()">Edit Profile</a>
                            <a id="re_pass" type="button" onclick="overlay_pass()">Reset Password</a>
                        </div>
                    </div>
                </div>--->



                <!------------------------------------- profile details ------------------------------->
                <div id="info_profile" class="base_profile">

                    <!----------------- show profile here
                    -------------->

                </div>



                <!-------------------------------- overlay profile update 
                    ------------------------------------>

                <div class="overlay_update" id="overlay-up">
                    <a id="cross" onclick="reverse_update()" type="button"><i class="fas fa-times-circle"></i></a>


                    <div class="update_profile_page" id="update">
                        <div class="heading_pro">
                            <h1>EDIT PROFILE</h1>
                            <!----------------------------------current pro image --------------------------------------->
                            <img id="uploadPreview" class="pro_pic">
                        </div>


                        <div class="main_update">
                            <!---------------------------------- update profile form --------------------------------------->
                            <form action="<?php echo htmlspecialchars("profile");?>" method="POST" autocomplete="off" enctype="multipart/form-data">

                                <div class="box">

                                    <input type="hidden" name="dept_admin_id" id="dept_admin_id" required="">

                                    <input type="file" name="dept_admin_img_link" id="file-2" accept=".jpg,.jpeg,.png" onchange="PreviewImage()" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
                                
                                    <label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17"
                                            viewBox="0 0 20 17">
                                            <path
                                                d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                                        </svg> <span>upload image</span></label>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p>First Name</p>
                                        <input type="text" class="form-control form-control-sm" id="dept_admin_first_name" name="dept_admin_first_name" required>
                                    </div>
                                    <div class="col">
                                        <p>Last Name</p>
                                        <input type="text" class="form-control form-control-sm" id="dept_admin_last_name" name="dept_admin_last_name" required>
                                    </div>
                                </div>


                                <p>Email ID</p>
                                <input type="email" class="form-control form-control-sm" id="dept_admin_email" name="dept_admin_email" required>

                                <p>Phone No.</p>
                                <input type="number" class="form-control form-control-sm" id="dept_admin_mobile" name="dept_admin_mobile" required>

                                <div class="update_btn">
                                    <input name="upd_profile_btn" type="submit" value="Save changes">
                                </div>
                                <!---------------------------------- end of update form --------------------------------------->
                            </form>
                            <!--------------------------------------- end of main_update_div ------------------------------>
                        </div>
                    </div>
                </div>
                <!------------------------------------------- end of update overlay -------------------------------->






                <!---------------------------------------- overlay reset password ------------------------------------>

                <div class="overlay_pass" id="overlay-pass">
                    <a id="cross" onclick="reverse_pass()" type="button"><i class="fas fa-times-circle"></i></a>


                    <div class="password_profile_page">
                        <div class="heading_pro">
                            <h1>RESET PASSWORD</h1>
                            
                                <!------------------------------current pro image--------------------------------------->
                                <img id="proimage" class="pro_pic">
                        </div>


                        <div class="main_pass">
                            <!---------------------------------reset password form --------------------------------------->
                            <form id="resetform" method="POST" autocomplete="off">

                                <input type="hidden" id="dept_admins_id" required>
                            
                                <p>Email ID</p>
                                <input type="text" class="form-control form-control-sm" id="dept_admins_email" required readonly>

                                <p>Password</p>
                                <input type="password" class="form-control form-control-sm" id="dept_admin_password" required>


                                <p>Confirm password</p>
                                <input type="password" class="form-control form-control-sm" id="dept_admin_password2" required>

                                <div class="update_btn">
                                    <input type="submit" value="Save">
                                </div>
                            </form>
                            <!---------------------------------------------- end of form --------------------------------------->
                        </div>
                        <!--------------------------------------------- end of main_pass ------------------------------>
                    </div>
                </div>
                <!------------------------------------------- end of reset password -------------------------------->


            </div>
        </div>
    </div>


    <!--------------------------------------------------gsap link
        ----------------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>

    <!--------------------------------------------------ajax link
        ----------------------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    
    <!--------------------------------------------------js link
        ----------------------------------------------------------->
    <script src="js/dashboard.js"></script>
    <script src="js/custom-file-input.js"></script>
    <script src="js/profile.js"></script>

    <!--------------------------------------------------bootstrap js link
        ----------------------------------------------------------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!---------------------------------------------------- sweet-alert link 
        ------------------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>




    



    <!--------------------------------------- email validation
        -------------------------------------->
    <script type="text/javascript">
        function validateEmail($email) {
           var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
           return emailReg.test( $email );
        }
    </script>


    <!-------------------------------------- show admin profile 
        -------------------------------------->
    <script type="text/javascript">
        $(document).ready(function(){
            showInfo();
        });
        
        function showInfo() {
            var info = "info";
            $.ajax({
                url:"action_profile.php",
                type:"post",
                data:{ info:info },
                success:function(data,status){
                    $('#info_profile').html(data);
                }
            });
        }
    </script>

    

    <!-------------------------- get id and show details when update button clicks
        ------------------------------>

    <script type="text/javascript">

    function getProfile(id) {

      $('#dept_admin_id').val(id);

        $.post("action_profile.php", {
                id:id
            }, function (data,status) {

                var admins = JSON.parse(data);
                $('#dept_admin_first_name').val(admins.dept_admin_first_name);
                $('#dept_admin_last_name').val(admins.dept_admin_last_name);
                $('#dept_admin_email').val(admins.dept_admin_email);
                $('#dept_admin_mobile').val(admins.dept_admin_mobile);
                /*if (admins.dept_admin_img_link==null) {
                   admins.dept_admin_img_link="../uploads/default_image.png";
                }*/
                $('#uploadPreview').attr('src',admins.dept_admin_img_link);
            }) 
        overlay_update();
    }
    </script>

    
    <!--------------------------------- get id when reset password button clicks
        ------------------------------>
    <script type="text/javascript">

        function getForgot(forgotid) {

            $('#dept_admins_id').val(forgotid);

        $.post("action_profile.php", {
                forgotid:forgotid
            }, function (data,status) {

                var admin = JSON.parse(data);
                $('#dept_admins_email').val(admin.dept_admin_email);
                /*if (admin.dept_admin_img_link==null) {
                    admin.dept_admin_img_link="../uploads/default_image.png";
                }*/
                $('#proimage').attr('src',admin.dept_admin_img_link);
            }) 
        overlay_pass();
        }
    </script>
    

    <!------------------------------ reset password ajax request
        ------------------------------->

    <script type="text/javascript">

    $(document).ready(function (e){
        $( "#resetform").on('submit', function (e) {
        e.preventDefault();

        var dept_admin_id=$('#dept_admins_id').val();
        var dept_admin_email=$('#dept_admins_email').val();
        var dept_admin_password=$('#dept_admin_password').val();
        var dept_admin_password2=$('#dept_admin_password2').val();
        
       
       if(dept_admin_password.trim() == "" || dept_admin_password2.trim() == ""){
            swal("Oops", "Password cannot be empty!", "warning");
        } else if (!validateEmail(dept_admin_email)) {  
            swal("Oops", "Please enter a valid Email Id", "warning");
        } else if (dept_admin_password.length<4 || dept_admin_password2.length<4) {  
            swal("Oops", "Password length is too short!", "warning");
        } else if (dept_admin_password!=dept_admin_password2) {  
            swal("Oops", "Password mismatched", "warning");
        }
        else {
          $.ajax({
            url:"action_profile.php",
            type: "POST",
            data: { reset:1,
                    dept_admin_id:dept_admin_id,
                    dept_admin_email:dept_admin_email,
                    dept_admin_password:dept_admin_password,
                    dept_admin_password2:dept_admin_password2
                  },
            success:function(result){
                var respon=$.parseJSON(result);
                $('#dept_admin_password').val("");
                $('#dept_admin_password2').val("");
                reverse_pass();
                showDatas();
                showInfo();
                swal(""+respon.title , ""+respon.text ,""+respon.icon, {
                    timer: 3000,
                }).then(
                    function () {
                        getLogout();
                });
            }
          });
        }
        });
    });        
    </script>



<!----------------------------  dept admin update profile  -------------------------------------->

<?php

if (isset($_POST['upd_profile_btn'])) {

  if (!empty($_POST['dept_admin_first_name']) && !empty($_POST['dept_admin_last_name']) && !empty($_POST['dept_admin_email'])) {

    $dept_admin_id           = mysqli_real_escape_string($con,trim($_POST['dept_admin_id']));
    $dept_admin_first_name   = mysqli_real_escape_string($con,trim($_POST['dept_admin_first_name']));
    $dept_admin_first_name   = ucwords(strtolower($dept_admin_first_name));
    $dept_admin_last_name    = mysqli_real_escape_string($con,trim($_POST['dept_admin_last_name']));
    $dept_admin_last_name    = ucwords(strtolower($dept_admin_last_name));
    $dept_admin_email        = mysqli_real_escape_string($con,trim($_POST['dept_admin_email']));
    $dept_admin_mobile       = mysqli_real_escape_string($con,trim($_POST['dept_admin_mobile']));

    $query ="SELECT * FROM department_admin WHERE dept_admin_id='$dept_admin_id'";
    $fire = mysqli_query($con,$query); //or die("can not update data .".mysqli_error($con));
    $row = mysqli_fetch_assoc($fire);

    if (!empty($dept_admin_first_name) && !empty($dept_admin_last_name)) {

      if (strlen($dept_admin_mobile)==10) {

        if (preg_match("/^[a-zA-Z ]*$/",$dept_admin_first_name) && preg_match("/^[a-zA-Z ]*$/",$dept_admin_last_name)) {

          if (filter_var($dept_admin_email, FILTER_VALIDATE_EMAIL)) {

            if (!empty($_FILES['dept_admin_img_link'] ['name'])) {

                $img_name = $_FILES['dept_admin_img_link'] ['name'];
                $img_size = $_FILES['dept_admin_img_link'] ['size'];
                $img_tmp  = $_FILES['dept_admin_img_link'] ['tmp_name'];

                $directory = '../uploads/';
                $target_file = $directory.$img_name;

                if (!file_exists($target_file)) {   

                    $query ="UPDATE department_admin SET dept_admin_first_name = '$dept_admin_first_name',dept_admin_last_name = '$dept_admin_last_name',dept_admin_email = '$dept_admin_email',dept_admin_mobile='$dept_admin_mobile',dept_admin_img_link = '$target_file' WHERE dept_admin_id=$dept_admin_id";
                    $fire = mysqli_query($con,$query); //or die("can not update data .".mysqli_error($con));

                    if ($fire) {

                        //delete the previous pro pic if exist
                        if (!empty($row['dept_admin_img_link'])) {
                            if (file_exists($row['dept_admin_img_link'])) {
                                unlink($row['dept_admin_img_link']);
                            }
                        }
                        
                        //upload file to the folder
                        move_uploaded_file($img_tmp,$target_file);

                        //add to activity
                        $created_at= date("Y-m-d H:i:s");
                        $activity_type= "profile";
                        $activity_body= "You have edited your profile.";
                        $dept_admin_id=$_SESSION['dept_admin_id'];

                        $query_n = "INSERT INTO `dept_admin_activity`(`created_at`, `activity_type`, `activity_body`, `dept_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$dept_admin_id')";

                        $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

                        if ($fire_n) {
                            echo '<script type="text/javascript"> 
                                swal("Done", "Profile updated successfully!", "success", {
                                      timer: 3000,
                                    }).then(
                                    function () {
                                        getLogout();
                                    });
                                </script>';
                        }else{
                            echo '<script type="text/javascript"> swal("Oops", "Something went wrong!", "error");</script>';
                        }
                    }else{
                        echo '<script type="text/javascript"> swal("Oops", "Something went wrong!", "error");</script>';
                    }
                }else{
                    echo '<script type="text/javascript"> swal("Oops", "Image file already exist!", "error");</script>';
                }
            }else{

                $query ="UPDATE department_admin SET dept_admin_first_name = '$dept_admin_first_name',dept_admin_last_name = '$dept_admin_last_name',dept_admin_email = '$dept_admin_email',dept_admin_mobile = '$dept_admin_mobile' WHERE dept_admin_id=$dept_admin_id";

                $fire = mysqli_query($con,$query); //or die("can not update data .".mysqli_error($con));

                if ($fire) {
                    $created_at= date("Y-m-d H:i:s");
                    $activity_type= "profile";
                    $activity_body= "You have edited your profile";
                    $dept_admin_id=$_SESSION['dept_admin_id'];

                    $query_n = "INSERT INTO `dept_admin_activity`(`created_at`, `activity_type`, `activity_body`, `dept_admin_id`) VALUES ('$created_at','$activity_type','$activity_body','$dept_admin_id')";

                    $fire_n = mysqli_query($con,$query_n) or die("can not insert data. ".mysqli_error($con));

                    if ($fire_n) {
                        
                        echo '<script type="text/javascript"> 
                            swal("Done", "Profile updated successfully!", "success", {
                                  timer: 3000,
                                }).then(
                                function () {
                                    getLogout();
                                });
                            </script>'; 
                    }else{
                        echo '<script type="text/javascript"> swal("Oops", "Something went wrong!", "error");</script>';
                    }
                }else{
                    echo '<script type="text/javascript"> swal("Oops", "Something went wrong!", "error");</script>';
                }
            }
          }else{
            echo '<script type="text/javascript"> swal("Oops", "Sorry, not a valid email !", "error");</script>';
          }
        }else{
            echo '<script type="text/javascript"> swal("Oops", "Name should contain letters only !", "error");</script>';
        }
      }else{
        echo '<script type="text/javascript"> swal("Oops", "Enter 10 digit mobile number !", "error");</script>';
      }
    }else{
        echo '<script type="text/javascript"> swal("Oops", "Name cannot be empty !", "error");</script>';
    }
  }else{
    echo '<script type="text/javascript"> swal("Oops", "Name or Email cannot be empty !", "error");</script>';
  }
}
?>

<!--------------------------------- end of php code ------------------------------------------->


</body>

</html>