<?php require "../config/config.php"; ?>
<?php
     session_start();
     if ($_SESSION['is_ca_login']) {
      //keep user on this page
     }
     else{
      //redirect to login page
      header("Location: login");
     }  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Department Admins of AAU | Stockpile</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">

    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/dept_admin.css">
    <link rel="stylesheet" type="text/css" href="css/main_dashboard.css">

    <!--------------------------------------------------bootstrap css link----------------------------------------------------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!--------------------------------------------------font asesome link----------------------------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <!--------------------------------------------------google fonts link----------------------------------------------------------->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins:300&display=swap" rel="stylesheet">
</head>

<body onload="renderDate()">
    <div class="wrapper">
        <div class="side_menu">
            <div class="side_menu_close_btn" onclick="side_menu_close()">
                <a><i class="fas fa-window-close"></i></a>
            </div>

            <div id="info" class="admin con_tabs">
                <!---------------------- show profile pic and name here
                    ------------------------>
            
            </div>
        
            <!-------------------------------------------- tabs---------------------------------->
            <div class="tabs">
                <div class="con_tabs">
                    <a href="home" class="con_tabs_links"><i class="fas fa-home"></i>
                        Home</a>
                    <a href="department" class="con_tabs_links"><i class="fas fa-book"></i> Depts</a>

                    <a href="dept_admin" class="con_tabs_links ac"><i class="fas fa-user"></i>
                        Deptadmins</a>
                    <a href="firms" class="con_tabs_links"><i class="fas fa-building"></i> Firms</a>
                    <a href="notifications" class="con_tabs_links"><span class="counter_side_noti">
                            <p>2</p>
                        </span><i class="fas fa-bell"></i> Notifications</a>

                </div>
            </div>

            <!-------------------------------------------- copyright ---------------------------------->
            <div class="side_menu_footer">
                <img src="images/stockpileLogo1.png">
                <h5>All rights reserved,copyright&copy; STOCKPILE,2020</h5>
            </div>

        </div>
        <!-------------------------------------------- top nav ---------------------------------->
        <div class="top_content">
            <div class="hamburger" onclick="side_menu_open()">
                <a><i class="fas fa-bars"></i></a>
            </div>
            <!---------------------------------------college name heading ---------------------------------->
            <div class="top_nav">

                <div class="top_nav_heading">
                    <h3><?php echo $_SESSION["clg_name"] ;?></h3>
                </div>

                <div class="top_nav_contents">
                    <!---------------------------------------clock ---------------------------------->
                    <div class="clock">
                        <i class="fas fa-clock"></i>
                        <div id="time" onload="showTime()"></div>
                    </div>
                    <!-------------------------------------------- date ---------------------------------->
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
                    <!-------------------------------------------notification ---------------------------------->
                    <div class="noti">
                        <span class="counter">
                            <p>2</p>
                        </span>
                        <i class="fas fa-bell" class="noti_bell" onclick="show_notification()"></i>

                        <div class="drop_noti" id="notification">
                            <h6>hii!I'm susmita</h6>
                        </div>
                    </div>
                    <!--------------------------------------------logout ---------------------------------->
                    <div class="logout">
                        <a href="college_admin_logout">Logout</a>
                    </div>

                </div>

            </div>



            <div class="content">




                <div class="college">
                    <div class="heading_add_btn">
                        <div class="icon_heading">
                            <i class="fas fa-user"></i>
                            <h1>Dept Admins of <?php echo $_SESSION["clg_name"] ;?></h1>
                        </div>

                        <div class="item_unit_btn">
                            <!-------------------------------------------- search bar---------------------------------->
                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search" autocomplete="off">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>
                            <!---------------------------------------add department admin buuton ----------------------------->
                            <a type="button" id="add_clg" onclick="overlay_add()">Add admin</a>
                        </div>
                    </div>
                    <!--------------------------------------------table---------------------------------->
                    <div id="dept_admin_records" class="table-responsive">
                        <!------------------------- show dept admins records here
                            ----------------------->

                    </div>



                </div>


                <!-------------------------------------------overlay add---------------------------------->

                <div class="overlay_add" id="overlay-add">
                    <a id="cross" onclick="reverse_add()"><i class="fas fa-times-circle"></i></a>
                    <div class="add_clg_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Add Department Admin</h1>
                        </div>
                        <!--------------------------------- add form---------------------------------->
                        <div class="main_add_clg">
                            <form id="form1" method="POST" autocomplete="off">

                                <input type="hidden" id="clg_id" value="<?php echo $_SESSION['clg_id'];?>">


                                <div class="row">
                                    <div class="col">
                                        <p>First Name</p>
                                        <input type="text" class="form-control form-control-sm" id="dept_admin_first_name"
                                            required>
                                    </div>

                                    <div class="col">
                                        <p>Last Name</p>
                                        <input type="text" class="form-control form-control-sm" id="dept_admin_last_name"
                                            required>
                                    </div>
                                </div>

                                <p>Admin's Email</p>
                                <input type="email" class="form-control form-control-sm" id="dept_admin_email" required>


                                <p>Admin's Password</p>
                                <input type="password" class="form-control form-control-sm" id="dept_admin_password" required>


                                <p>Confirm Password</p>
                                <input type="password" class="form-control form-control-sm" id="dept_admin_password2" required>


                                <p>Department Name</p>
                                <select class="form-control" id="dept_id" required>
                                    
                                  <?php
                                    $query = "SELECT * FROM  department WHERE clg_id='".$_SESSION['clg_id']."'";
                                    $fire = mysqli_query($con,$query) or die("can not display data from database. ".mysqli_error($con));?>
                                        <option value="" selected="" disabled="">Select Department</option>
                                        <?php
                                    while ($rows = mysqli_fetch_array($fire)) {
                                        ?>
                                        <option value="<?= $rows['dept_id']; ?>"><?php echo $rows['dept_name']; ?></option>
                                        <?php
                                    }?>
                                </select>

                                <div class="add_clg_btn">
                                    <input type="submit" value="Save">
                                </div>

                            </form>

                        </div>
                    </div>
                </div>






                <!-----------------------------------------overlay update---------------------------------->



                <div class="overlay_update" id="overlay-update">
                    <a id="cross" onclick="reverse_update()"><i class="fas fa-times-circle"></i></a>

                    <div class="up_clg_ad_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Update Department Admin</h1>

                        </div>
                        <!---------------------------- update form---------------------------------->
                        <div class="main_add_clg">
                            <form id="form2" method="POST" autocomplete="off">

                                <input type="hidden" id="dept_admin_id" required> 

                                <div class="row">

                                    <div class="col">
                                        <p>First Name</p>
                                        <input type="text" class="form-control form-control-sm" id="dept_admins_first_name" required>
                                    </div>

                                    <div class="col">
                                        <p>Last Name</p>
                                        <input type="text" class="form-control form-control-sm" id="dept_admins_last_name" required>
                                    </div>
                                </div>


                                <p>Admin's Email</p>
                                <input type="email" class="form-control form-control-sm" id="dept_admins_email" required>

                                <p>Department Name</p>
                                <input type="text" class="form-control form-control-sm" id="dept_name" required readonly>

                                <div class="add_clg_btn">
                                    <input type="submit" value="Save changes">
                                </div>

                            </form>

                        </div>
                    </div>



                </div>
            </div>
        </div>


        <!--------------------------------- overlay-delete ------------------------------------>
                <div class="overlay_update" id="overlay-delete">

                    <div class="main_delete">
                        <div class="icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                            <h1>Are You Sure?</h1>
                        

                        <div class="button">
                            <form id="deleteform">
                                
                                <input type="hidden" id="deleteid">
            
                                <div class="del_btn"> 
                                    <a type="button" class="cancel" onclick="reverse_delete()">Cancel</a>
                                    <input type="submit" class="okay" value="Yes">
                                </div>

                            </form>
                        </div>
                    </div>

                </div>


        <!--------------------------------------------------gsap link----------------------------------------------------------->

        <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>
        <!---------------------------------------------------------ajax link----------------------------------------------------->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <!-----------------------------------------------------------------js links---------------------------------------------->
        <script src="js/dept_admin.js"></script>
        <script src="js/dashboard.js"></script>
        <!---------------------------------------------------- sweet-alert link ------------------------------------------------->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!--------------------------------------------------bootstrap js link---------------------------------------------------->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>




    <!------------------------------------- show pro pic nd name 
        ------------------------------------>
    <script type="text/javascript">
        $(document).ready(function(){
            showDatas();
        });
        
        function showDatas() {
            var read = "read";
            $.ajax({
                url:"action.php",
                type:"post",
                data:{ read:read },
                success:function(data,status){
                    $('#info').html(data);
                }
            });
        }
    </script>



    <!--------------------------------------- show department admin table 
        --------------------------------------->
    <script type="text/javascript">
        $(document).ready(function(){
            showDeptadmins();
        });
        
        function showDeptadmins() {
            var readdeptadmin = "readdeptadmin";
            $.ajax({
                url:"action_dept_admin.php",
                type:"post",
                data:{ readdeptadmin:readdeptadmin },
                success:function(data,status){
                    $('#dept_admin_records').html(data);
                }
            });
        }
    </script>

    <!------------------------------------- validate email
        ------------------------------------>

    <script type="text/javascript">
        function validateEmail($email) {
           var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
           return emailReg.test( $email );
        }
    </script>

    <!--------------------------------------- clg admin add ajax request 
        ---------------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#form1", function (e) {
        e.preventDefault();


        var clg_id                 = $("#clg_id").val();
        var dept_admin_first_name  = $("#dept_admin_first_name").val();
        var dept_admin_last_name   = $("#dept_admin_last_name").val();
        var dept_admin_email       = $("#dept_admin_email").val();
        var dept_admin_password    = $("#dept_admin_password").val();
        var dept_admin_password2   = $("#dept_admin_password2").val();
        var dept_id                = $("#dept_id option:selected").val();


       if(dept_admin_first_name.trim() == "" || dept_admin_last_name.trim() == ""){
          swal("Oops", "Sorry, Whitesapces Not Allowed", "warning");
        } else if (!dept_admin_first_name.match(/^[a-zA-Z ]*$/) || !dept_admin_last_name.match(/^[a-zA-Z ]*$/)) {
          swal("Oops", "No special characters & numbers allowed", "warning");
        } else if (!validateEmail(dept_admin_email)) {       
          swal("Oops", "Please Enter a Valid Email ID", "warning");
        } else if(dept_admin_password.trim() == "" || dept_admin_password2.trim() == ""){
          swal("Oops", "Password cannot be empty", "warning");
        } else if(dept_admin_password.length<4 || dept_admin_password2.length<4){
          swal("Oops", "Password length is too short!", "warning");
        } else if(dept_admin_password!=dept_admin_password2){
          swal("Oops", "Password Mismatched", "warning");
        }
        else {
          $.ajax({
            url:"action_dept_admin.php",
            type: "POST",
            data: { add:1,dept_admin_first_name:dept_admin_first_name,dept_admin_last_name:dept_admin_last_name,dept_admin_email:dept_admin_email,dept_admin_password:dept_admin_password,dept_admin_password2:dept_admin_password2,dept_id:dept_id,clg_id:clg_id },
            success:function(data){
                var getmsgs=$.parseJSON(data);
                swal(""+getmsgs.title , ""+getmsgs.text ,""+getmsgs.icon);
                reverse_add();
                showDeptadmins();
            }
          });
        }
    });
        
    </script>


    <!--------------------- get the college admin details to be updated 
        -------------------------------------->
    <script type="text/javascript">

    function getDeptadmin(id) {

      $('#dept_admin_id').val(id);

        $.post("action_dept_admin.php", {
                id:id
            }, function (data,status) {

                var admin = JSON.parse(data);
                $('#dept_admins_first_name').val(admin.dept_admin_first_name);
                $('#dept_admins_last_name').val(admin.dept_admin_last_name);
                $('#dept_admins_email').val(admin.dept_admin_email);
                $('#dept_name').val(admin.dept_name);
            })  
      overlay_update();
    }
    </script>

    <!-------------------------------- clg admin update ajax request 
        -------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#form2", function (e) {
        e.preventDefault();

        var dept_admin_id=$('#dept_admin_id').val();
        var dept_admin_first_name=$('#dept_admins_first_name').val();
        var dept_admin_last_name=$('#dept_admins_last_name').val();
        var dept_admin_email=$('#dept_admins_email').val();
       
       if(dept_admin_first_name.trim() == "" || dept_admin_last_name.trim() == ""){
          swal("Oops", "Sorry, Whitesapces Not Allowed", "warning");
        } else if (!dept_admin_first_name.match(/^[a-zA-Z ]*$/) || !dept_admin_last_name.match(/^[a-zA-Z ]*$/)) {
          swal("Oops", "No special characters & numbers allowed", "warning");
        } else if (!validateEmail(dept_admin_email)) {
          swal("Oops", "Please Enter a Valid Email ID", "warning");
        }
        else {
          $.ajax({
            url:"action_dept_admin.php",
            type: "POST",
            data: { upd:1,dept_admin_id:dept_admin_id,dept_admin_first_name:dept_admin_first_name,dept_admin_last_name:dept_admin_last_name,dept_admin_email:dept_admin_email },
            success:function(result){
                var response=$.parseJSON(result);
                swal(""+response.title , ""+response.text ,""+response.icon);
                reverse_update();
                showDeptadmins();
            }
          });
        }
    });
        
    </script>



    <!------------------------- delete clg admin
        ----------------------------->
    
    <script type="text/javascript">

    function getDeladmin(delid) {

        $('#deleteid').val(delid);

        overlay_delete();
    }
    </script>




    <!---------------------------- overlay for delete in-out
        ----------------->

    <script type="text/javascript">

    function overlay_delete(){
        let over=document.getElementById("overlay-delete");
        gsap.to(over , {duration:.5, opacity:1 , display:'block'});
    }

    function reverse_delete(){
        let cross=document.getElementById("overlay-delete");
        gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

    }
    
    </script>


    <!-------------------------------- clg admin delete ajax request 
        -------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#deleteform", function (e) {
        e.preventDefault();

        var delid=$('#deleteid').val();          

        $.ajax({
            url:"action_dept_admin.php",
            type: "POST",
            data: { del:1,delid:delid },
            success:function(result){
                var response=$.parseJSON(result);
                swal(""+response.title , ""+response.text ,""+response.icon);
                reverse_delete();
                showDeptadmins();
            }
          });
    });
        
    </script>


    

    
    <!------------------------------------------------------------- searching 
        ----------------------------------------------->

        <script>
            $(document).ready(function () {
                $("#search").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
</body>

</html>