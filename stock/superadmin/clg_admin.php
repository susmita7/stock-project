<?php require "../config/config.php";
session_start();  
  // check if super admin logged in or not
  if ($_SESSION['is_sa_login']) {
     //keep admin on page
  }
  else{
     //redirect to loginpage
     header("Location: login");
     die();
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>College Admins of AAU | Stockpile</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">

    <!----------------------------------------- css link -------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/clg_admin.css">
    <link rel="stylesheet" type="text/css" href="css/main_dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/media_dashboard.css">
    <!----------------------------------------- bootstrap css link ----------------------------------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!---------------------------------------- font asesome link -------------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

    <!---------------------------------------- google fonts link -------------------------------------------->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins:300&display=swap" rel="stylesheet">



</head>

<body onload="renderDate()">

    <div class="wrapper">
        
         <!-----------------------------------------side menu open close-------------------------------------->
        <div class="side_menu" id="menu">
            <div class="side_menu_close_btn" onclick="side_menu_open()">
                <a><i class="fas fa-window-close"></i></a>
            </div>

            <!------------------------------------- admin profile ----------------------------->

            <div id="info" class="admin con_tabs">


            </div>

            <!------------------------------------------tabs-------------------------------------->
            <div class="tabs">
                <div class="con_tabs">
                    <a href="home" class="con_tabs_links"><i class="fas fa-home"></i> Dashboard</a>
                    <a href="faculty" class="con_tabs_links"><i class="fas fa-user-friends"></i> Faculties</a>
                    <a href="college" class="con_tabs_links"><i class="fas fa-book"></i>&nbsp Colleges</a>

                    <a href="clg_admin" class="con_tabs_links ac"><i class="fas fa-user"></i>&nbsp Clg Admins</a>
                    <a href="notifications" class="con_tabs_links">
                        <div id="getcount">
                            
                        </div>
                        <i class="fas fa-bell"></i>&nbsp Notifications</a>
                    <a href="activity" class="con_tabs_links"><i class="fa fa-history" aria-hidden="true"></i>&nbsp Activity Logs</a>
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
        <!-------------------------------- end side menu ---------------------------->

        <!-------------------------------- top nav ---------------------------------->

        <div class="top_content">


            <div class="top_nav">
                
                <div class="top_nav_heading">

                <!-----------------  responsive sidebar  ---------------------->
                <div class="hamburger" onclick="side_menu_open()">
                        <a><i class="fas fa-bars"></i></a>
                </div>
                
                    <h3>Assam Agricultural University</h3>
                </div>

                <div class="top_nav_contents">
                    
                    <!------------------------------------- clock ----------------------------->
                    <div class="clock">
                        <i class="fas fa-clock"></i>
                        <div id="time" onload="showTime()"></div>
                    </div>
                    
                    <!------------------------------------- date ----------------------------->
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

                    <!-------------------------------------------- notification ----------------------------------->
                    <div class="noti" id="notify_records">
                        
                        <!--------------- show dropdown noyifications here
                            ---------------------->
                    
                    </div>

                    <!-------------------------------------------- logout ----------------------------------->
                    <div class="logout">
                        <a type="button" onclick="getLogout()">Logout</a>
                    </div>
                </div>
            </div>
            <!----------------------------------- end of top navbar ------------------------------------>

            <!------------------------------------- conteny div ----------------------------->

            <div class="content">
                <div class="college">
                    <div class="heading_add_btn">

                        <div class="icon_heading">
                            <i class="fas fa-user"></i>
                            <h1>College Admins Under AAU</h1>
                        </div>

                        <!------------------------------- search-bar ----------------------------------->

                        <div class="item_unit_btn">
                            <div class="search_bar">
                                <input id="search" type="text" placeholder="search" autocomplete="off">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>

                            <!------------- add clg admin button --------------->
                            <a type="button" id="add_clg" onclick="overlay_add()">Add Admin</a>
                        </div>
                    </div>


                    <!-------------------------------------table ----------------------------------->

                    <div id="clg_admin_records" class="table-responsive">

                        <!-------------- show clg admin table here
                            ---------------------------->

                    </div>

                </div>


                <!-------------------------------- overlay-add ------------------------------->


                <div class="overlay_add" id="overlay-add">

                    <a id="cross" onclick="reverse_add()"><i class="fas fa-times-circle"></i></a>

                    <div class="add_clg_base_div">

                        <div class="heading_for_add_clg">
                            <h1>Add College Admin</h1>
                        </div>

                        <div class="main_add_clg">

                            <!--------------------------- add form ----------------------------->

                            <form id="form3" method="POST" autocomplete="off">

                                <div class="row">
                                    <div class="col">
                                        <p>First Name</p>
                                        <input type="text" class="form-control form-control-sm" id="first_name" required>
                                    </div>
                                    <div class="col">
                                        <p>Last Name</p>
                                        <input type="text" class="form-control form-control-sm" id="last_name" required>
                                    </div>
                                </div>


                                <p>Admin's Email</p>
                                <input type="email" class="form-control form-control-sm" id="email" required>


                                <p>Admin's Password</p>
                                <input type="password" class="form-control form-control-sm" id="password" required>


                                <p>Confirm Password</p>
                                <input type="password" class="form-control form-control-sm" id="password2" required>


                                <p>College Name</p>

                                <select class="form-control form-control-sm" id="clg_id" required>
                                <?php
                                   $query = "SELECT * FROM  college";
                                   $fire = mysqli_query($con,$query) or die("can not display data from database. ".mysqli_error($con));?>
                                   <option value="" disabled selected>Select College</option>
                                   <?php
                                   while ($rows = mysqli_fetch_array($fire)) {
                                ?>
                                  <option value="<?= $rows['clg_id']; ?>"><?php echo $rows['clg_name']; ?></option>
                                <?php
                                }?>
                                </select>

                                <div class="add_clg_btn">
                                    <input id="addsubmitbtn" type="submit" value="Add">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>






                <!--------------------------------- overlay-update ------------------------------------>



                <div class="overlay_update" id="overlay-update">
                    <a id="cross" onclick="reverse_update()"><i class="fas fa-times-circle"></i></a>

                    <div class="up_clg_ad_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Update College Admin</h1>

                        </div>
                        <div class="main_add_clg">

                            <!------------------------- update form ----------------------------->
                            <form id="form4" method="POST" autocomplete="off">

                                <input type="hidden" id="clg_admin_id" required>

                                <div class="row">
                                    <div class="col">
                                        <p>First Name</p>
                                        <input type="text" class="form-control form-control-sm" id="clg_admin_first_name"
                                            required>
                                    </div>
                                    <div class="col">
                                        <p>Last Name</p>
                                        <input type="text" class="form-control form-control-sm" id="clg_admin_last_name" required>
                                    </div>
                                </div>

                                <p>Admin's Email</p>
                                <input type="email" class="form-control form-control-sm" id="clg_admin_email" required>

                                <p>college Name</p>

                                <input type="text" class="form-control form-control-sm" id="clg_name" required readonly>

                                <div class="add_clg_btn">
                                    <input type="submit" value="Update">
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


    <!--------------------------------------------------gsap link ----------------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>

    <!------------------------------------------------ ajax link 
        ---------------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <!--------------------------------------------------- js link 
        --------------------------------------------------->
    <script src="js/dashboard.js"></script>
    <script src="js/clg_admin.js"></script>


    <!------------------------------------------------ sweet-alert 
        ------------------------------------------------------>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <!--------------------------------------------------bootstrap js link----------------------------------------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>



    <script type="text/javascript">

    // overlay for delete in-out


    function overlay_delete(){
        let over=document.getElementById("overlay-delete");
        gsap.to(over , {duration:.5, opacity:1 , display:'block'});
    }

    function reverse_delete(){
        let cross=document.getElementById("overlay-delete");
        gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});
    }
    
    </script>
    


    
    <!------------------------------------- show college admin table 
        --------------------------------------->
    <script type="text/javascript">
        $(document).ready(function(){
            showCollegeadmins();
        });
        
        function showCollegeadmins() {
            var readclgadmin = "readclgadmin";
            $.ajax({
                url:"action_clg_admin.php",
                type:"post",
                data:{ readclgadmin:readclgadmin },
                success:function(data,status){
                    $('#clg_admin_records').html(data);
                }
            });
        }
    </script>


    <!------------------------------------------- email validation 
        ------------------------------------------>

    <script type="text/javascript">
        function validateEmail($email) {
           var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
           return emailReg.test( $email );
        }
    </script>

    



    <!---------------------------------------- clg admin add ajax request 
        ---------------------------------------->

    <script type="text/javascript">
        
    $(document).on("submit", "#form3", function (e) {
        e.preventDefault();

        var clg_admin_first_name= $("#first_name").val();
        var clg_admin_last_name = $("#last_name").val();
        var clg_admin_email     = $("#email").val();
        var clg_admin_password  = $("#password").val();
        var clg_admin_password2 = $("#password2").val();
        var clg_id =$("#clg_id").val();


       if(clg_admin_first_name.trim() == "" || clg_admin_last_name.trim() == ""){
          swal("Oops", "Whitesapces not allowed!", "warning");
        } else if(!clg_admin_first_name.match(/^[a-zA-Z ]*$/) || !clg_admin_last_name.match(/^[a-zA-Z ]*$/)){
          swal("Oops", "Name should contain letters only!", "warning");
        } else if (!validateEmail(clg_admin_email)) { 
          swal("Oops", "Please enter a valid Email ID!", "warning");
        } else if (clg_admin_password.trim()=="" || clg_admin_password2.trim()=="") { 
          swal("Oops", "Password cannot be empty!", "warning");
        } else if (clg_admin_password.length<4 || clg_admin_password2.length<4) { 
          swal("Oops", "Password length is too short!", "warning");
        } else if (clg_admin_password!=clg_admin_password2) { 
          swal("Oops", "Password mismatched!", "warning");
        }
        else {
            $("#addsubmitbtn").prop('disabled', true);
            $("#addsubmitbtn").val("Please Wait");
          $.ajax({
            url:"action_clg_admin.php",
            type: "POST",
            data: { add:1,clg_admin_first_name:clg_admin_first_name,clg_admin_last_name:clg_admin_last_name,clg_admin_email:clg_admin_email,clg_admin_password:clg_admin_password,clg_admin_password2:clg_admin_password2,clg_id:clg_id },
            success:function(data){
                //alert(data);
                var getmsgs=$.parseJSON(data);
                swal(""+getmsgs.title , ""+getmsgs.text ,""+getmsgs.icon);
                $("#first_name").val("");
                $("#last_name").val("");
                $("#email").val("");
                $("#password").val("");
                $("#password2").val("");
                $("#clg_id").val("");
                reverse_add();
                showCollegeadmins();
                $("#addsubmitbtn").prop('disabled', false);
                $("#addsubmitbtn").val("Add");
            }
          });
        }
    });
        
    </script>


    <!---------------------------- get the college admin details to be updated 
        -------------------------------------->
    <script type="text/javascript">

    function getClgadmin(id) {

      $('#clg_admin_id').val(id);

        $.post("action_clg_admin.php", {
                id:id
            }, function (data,status) {

                var admin = JSON.parse(data);
                $('#clg_admin_first_name').val(admin.clg_admin_first_name);
                $('#clg_admin_last_name').val(admin.clg_admin_last_name);
                $('#clg_admin_email').val(admin.clg_admin_email);
                $('#clg_name').val(admin.clg_name);
            })  
      overlay_update();
    }
    </script>

    

    <!----------------------------------- clg admin update ajax request 
        ------------------------------------------->
    
    <script type="text/javascript">
        
    $(document).on("submit", "#form4", function (e) {
        e.preventDefault();

        var clg_admin_id=$('#clg_admin_id').val();
        var clg_admin_first_name=$('#clg_admin_first_name').val();
        var clg_admin_last_name=$('#clg_admin_last_name').val();
        var clg_admin_email=$('#clg_admin_email').val();
       
       if(clg_admin_first_name.trim() == "" || clg_admin_last_name.trim() == ""){
          swal("Oops", "Whitesapces not allowed!", "warning");
        } else if(!clg_admin_first_name.match(/^[a-zA-Z ]*$/) || !clg_admin_last_name.match(/^[a-zA-Z ]*$/)){
          swal("Oops", "Name should contain letters only!", "warning");
        } else if (!validateEmail(clg_admin_email)) {
          swal("Oops", "Please enter a valid Email ID!", "warning");
        }
        else {
          $.ajax({
            url:"action_clg_admin.php",
            type: "POST",
            data: { upd:1,clg_admin_id:clg_admin_id,clg_admin_first_name:clg_admin_first_name,clg_admin_last_name:clg_admin_last_name,clg_admin_email:clg_admin_email },
            success:function(result){
                var response=$.parseJSON(result);
                swal(""+response.title , ""+response.text ,""+response.icon);
                showCollegeadmins();
                reverse_update();
            }
          });
        }
    });
        
    </script>


    <!------------------------------------- clg admin delete ajax request 
        ------------------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#deleteform", function (e) {
        e.preventDefault();

        var delid=$('#deleteid').val();          

        $.ajax({
            url:"action_clg_admin.php",
            type: "POST",
            data: { del:1,delid:delid },
            success:function(result){
                var response=$.parseJSON(result);
                swal(""+response.title , ""+response.text ,""+response.icon);
                reverse_delete();
                showCollegeadmins();
            }
          });
    });
        
    </script>




    <!-------------------------------------------- delete clg admin
        -------------------------------------->
    
    <script type="text/javascript">

    function getDeladmin(delid) {

        $('#deleteid').val(delid);

        overlay_delete();
    }
    </script>




    <!-------------------------------------------------- searching 
        --------------------------------------------->
    
    <script>
        $(document).ready(function () {
            $("#search").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#mTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

</body>

</html>