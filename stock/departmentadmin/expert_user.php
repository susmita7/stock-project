<?php require "../config/config.php"; ?>
<?php
    session_start();
    if ($_SESSION['is_da_login']) {
        //keep user on this page
    }else{
        //redirect to login page
        header("Location: ../choose") ;
    }  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expert Users of AAU | Stockpile</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">

    <!--------------------------------------------------css link 
        ----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/expert_users.css">
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
</head>

<body onload="renderDate()">
    <div class="wrapper">
        <!------------------------------ side menu ----------------------------------------->
        <div class="side_menu" id="menu">
            <div class="side_menu_close_btn" onclick="side_menu_open()">
                <a><i class="fas fa-window-close"></i></a>
            </div>

            <!----------------------------------------------------profile
                ---------------------------------------------->

            <div id="info" class="admin con_tabs">
                <!------------------- show the pro pic and name here
                    ------------------------->
            </div>

            <!---------------------------------------------------- side manu tabs ------------------------------------>
            <div class="tabs">
                <div class="con_tabs">
                    <a href="home" class="con_tabs_links"><i class="fas fa-home"></i>
                        Dashboard</a>

                    <a href="expert_user" class="con_tabs_links ac"><i class="fas fa-user"></i>
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

                    <!---------------------------------------------------- logout ---------------------------------------------->
                    <div class="logout">
                        <a type="button" onclick="getLogout()">Logout</a>
                    </div>


                </div>

            </div>

            <div class="content">


                <div class="college">

                    <!-------------------------------------------- heading+icon ---------------------------------->
                    <div class="heading_add_btn">
                        <div class="icon_heading">
                            <i class="fas fa-user"></i>
                            <h1>Expert Users Under <?php echo $_SESSION['dept_name'];?></h1>
                        </div>

                        <div class="item_unit_btn">

                            <!-------------------------------------------- search bar ---------------------------------->
                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search" autocomplete="off">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>
                            
                            <!---------------------------------------add EU buuton 
                                ----------------------------->
                            <a type="button" id="add_clg" onclick="overlay_add()">Add expert user</a>
                        </div>
                    </div>

                    <!--------------------------------------  table ----------------------------->
                    <div id="expert_user_records" class="table-responsive">

                        <!-------------- show expert user table here
                            --------------->

                    </div>



                </div>

                <!-------------------------------- overlay add ----------------------------->


                <div class="overlay_add" id="overlay-add">
                    <a id="cross" onclick="reverse_add()" type="button"><i class="fas fa-times-circle"></i></a>
                    <div class="add_clg_base_div">
                        
                        <div class="heading_for_add_clg">
                            <h1>Add Expert User</h1>
                        </div>
                        
                        <!------------------------------ add form ----------------------------->
                        <div class="main_add_clg">

                            <form id="form1" method="POST" autocomplete="off">

                                <div class="row">
                                    <div class="col">
                                        <p>First Name</p>
                                        <input type="text" class="form-control form-control-sm" id="eu_first_name"
                                            required>
                                    </div>
                                    <div class="col">
                                        <p>Last Name</p>
                                        <input type="text" class="form-control form-control-sm" id="eu_last_name"
                                            required>
                                    </div>
                                </div>


                                <p>User's Email</p>
                                <input type="email" class="form-control form-control-sm" id="eu_email" required>


                                <p>User's Password</p>
                                <input type="password" class="form-control form-control-sm" id="eu_password" required>


                                <p>Confirm Password</p>
                                <input type="password" class="form-control form-control-sm" id="eu_password2" required>


                                <p>Department Name</p>
                                <select class="form-control" id="dept_id" required>
                                  <?php
                                    $query = "SELECT * FROM  department WHERE dept_id='".$_SESSION['dept_id']."'";
                                    $fire = mysqli_query($con,$query) or die("can not display data from database. ".mysqli_error($con));
                                    ?>
                                    <option value="" disabled="" selected="">Select Department</option>
                                    <?php
                                    while ($rows = mysqli_fetch_array($fire)) {
                                        ?>
                                        <option value="<?= $rows['dept_id']; ?>"><?php echo $rows['dept_name']; ?></option>
                                        <?php
                                    }?>
                                  </select>

                                <div class="add_clg_btn">
                                    <input id="addsubmitbtn" type="submit" value="Save">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>



                <!---------------------------------------overlay update ----------------------------->


                <div class="overlay_update" id="overlay-update">
                    <a id="cross" onclick="reverse_update()" type="button"><i class="fas fa-times-circle"></i></a>

                    <div class="up_clg_ad_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Update Expert User</h1>
                        </div>
                        <!------------------------------ update form----------------------------->
                        <div class="main_add_clg">
                            <form id="form2" method="POST" autocomplete="off">

                                <input type="hidden" id="eu_id">

                                <div class="row">
                                    <div class="col">
                                        <p>First Name</p>
                                        <input type="text" class="form-control form-control-sm" id="eus_first_name"
                                            required>
                                    </div>
                                    <div class="col">
                                        <p>Last Name</p>
                                        <input type="text" class="form-control form-control-sm" id="eus_last_name"
                                            required>
                                    </div>
                                </div>

                                <p>User's Email</p>
                                <input type="text" class="form-control form-control-sm" id="eus_email" required>

                                <p>Department Name</p>

                                <input type="text" id="dept_name" class="form-control form-control-sm" readonly required>

                                <div class="add_clg_btn">
                                    <input type="submit" value="Save changes">
                                </div>

                            </form>

                        </div>
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



    <!--------------------------------------------------gsap link
        ----------------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>
    
    <!--------------------------------------------------ajax link
        ----------------------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    
    <!--------------------------------------------------js link
        ----------------------------------------------------------->
    <script src="js/dashboard.js"></script>
    <script src="js/expert_user.js"></script>
    
    <!---------------------------------------------------- sweet-alert link 
        ------------------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <!--------------------------------------------------bootstrap js link
        ----------------------------------------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    



    <!--------------------------------------- show EU table 
        --------------------------------------->
    <script type="text/javascript">
        $(document).ready(function(){
            showExpertusers();
        });
        
        function showExpertusers() {
            var readexpertuser = "readexpertuser";
            $.ajax({
                url:"action_expert_user.php",
                type:"post",
                data:{ readexpertuser:readexpertuser },
                success:function(data,status){
                    $('#expert_user_records').html(data);
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

    <!--------------------------------------- EU add ajax request 
        ---------------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#form1", function (e) {
        e.preventDefault();


        //var clg_id         = $("#clg_id").val();
        var eu_first_name  = $("#eu_first_name").val();
        var eu_last_name   = $("#eu_last_name").val();
        var eu_email       = $("#eu_email").val();
        var eu_password    = $("#eu_password").val();
        var eu_password2   = $("#eu_password2").val();
        var dept_id        = $("#dept_id").val();


       if(eu_first_name.trim() == "" || eu_last_name.trim() == ""){
          swal("Oops", "Whitesapces not allowed!", "warning");
        } else if (!eu_first_name.match(/^[a-zA-Z ]*$/) || !eu_last_name.match(/^[a-zA-Z ]*$/)) {
          swal("Oops", "Name should contain letters only!", "warning");
        } else if (!validateEmail(eu_email)) {       
          swal("Oops", "Please enter a valid Email Id!", "warning");
        } else if(eu_password.trim() == "" || eu_password2.trim() == ""){
          swal("Oops", "Password cannot be empty!", "warning");
        } else if(eu_password.length<4 || eu_password2.length<4){
          swal("Oops", "Password length is too short!", "warning");
        } else if(eu_password!=eu_password2){
          swal("Oops", "Password mismatched!", "warning");
        }
        else {
            $("#addsubmitbtn").prop('disabled', true);
            $("#addsubmitbtn").val("Please Wait");
          $.ajax({
            url:"action_expert_user.php",
            type: "POST",
            data: { add:1,eu_first_name:eu_first_name,eu_last_name:eu_last_name,eu_email:eu_email,eu_password:eu_password,eu_password2:eu_password2,dept_id:dept_id },
            success:function(data){
                var getmsgs=$.parseJSON(data);
                swal(""+getmsgs.title , ""+getmsgs.text ,""+getmsgs.icon);
                $("#eu_first_name").val("");
                $("#eu_last_name").val("");
                $("#eu_email").val("");
                $("#eu_password").val("");
                $("#eu_password2").val("");
                $("#dept_id").val("");
                reverse_add();
                showExpertusers();
                $("#addsubmitbtn").prop('disabled', false);
                $("#addsubmitbtn").val("Add");
            }
          });
        }
    });
        
    </script>


    <!--------------------- get the EU details to be updated 
        -------------------------------------->
    <script type="text/javascript">

    function getExpertuser(id) {

      $('#eu_id').val(id);

        $.post("action_expert_user.php", {
                id:id
            }, function (data,status) {

                var admin = JSON.parse(data);
                $('#eus_first_name').val(admin.eu_first_name);
                $('#eus_last_name').val(admin.eu_last_name);
                $('#eus_email').val(admin.eu_email);
                $('#dept_name').val(admin.dept_name);
            })  
      overlay_update();
    }
    </script>

    <!-------------------------------- EU update ajax request 
        -------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#form2", function (e) {
        e.preventDefault();

        var eu_id=$('#eu_id').val();
        var eu_first_name=$('#eus_first_name').val();
        var eu_last_name=$('#eus_last_name').val();
        var eu_email=$('#eus_email').val();
       
       if(eu_first_name.trim() == "" || eu_last_name.trim() == ""){
          swal("Oops", "Whitesapces not allowed!", "warning");
        } else if (!eu_first_name.match(/^[a-zA-Z ]*$/) || !eu_last_name.match(/^[a-zA-Z ]*$/)) {
          swal("Oops", "Name should contain letters only!", "warning");
        } else if (!validateEmail(eu_email)) {
          swal("Oops", "Please enter a valid Email Id!", "warning");
        }
        else {
          $.ajax({
            url:"action_expert_user.php",
            type: "POST",
            data: { upd:1,eu_id:eu_id,eu_first_name:eu_first_name,eu_last_name:eu_last_name,eu_email:eu_email },
            success:function(result){
                var response=$.parseJSON(result);
                swal(""+response.title , ""+response.text ,""+response.icon);
                reverse_update();
                showExpertusers();
            }
          });
        }
    });
        
    </script>



    <!------------------------- delete EU
        ----------------------------->
    
    <script type="text/javascript">

    function getDeluser(delid) {

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


    <!-------------------------------- EU delete ajax request 
        -------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#deleteform", function (e) {
        e.preventDefault();

        var delid=$('#deleteid').val();          

        $.ajax({
            url:"action_expert_user.php",
            type: "POST",
            data: { del:1,delid:delid },
            success:function(result){
                var response=$.parseJSON(result);
                swal(""+response.title , ""+response.text ,""+response.icon);
                reverse_delete();
                showExpertusers();
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