<?php require "../config/config.php"; ?>
<?php
     session_start();
     if ($_SESSION['is_ca_login']) {
      //keep user on this page
     }
     else{
      //redirect to login page
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
    <title>College Admin Dashboard | Stockpile</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/media_dashboard.css">
    <!--------------------------------------------------bootstrap css link----------------------------------------------------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!--------------------------------------------------font asesome link----------------------------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <!--------------------------------------------------google fonts link----------------------------------------------------------->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins:300&display=swap" rel="stylesheet">
</head>

    <body onload="renderDate()">

    <div class="wrapper">

        <div class="side_menu" id="menu">
            <div class="side_menu_close_btn" onclick="side_menu_open()">
                <a><i class="fas fa-window-close"></i></a>
            </div>
            
            <div id="info" class="admin con_tabs">
                
                <!------------------- show profile pic and name here
                    -------------------->
                
            </div>

            <!--------------------------- tabs -------------------------------->
            <div class="tabs">
                <div class="con_tabs">
                    <a href="home" class="con_tabs_links ac"><i class="fas fa-home"></i>
                        Dashboard</a>
                    <a href="department" class="con_tabs_links"><i class="fas fa-book"></i>&nbsp Departments</a>

                    <a href="dept_admin" class="con_tabs_links"><i class="fas fa-user"></i>&nbsp Dept Admins</a>
                    <a href="firms" class="con_tabs_links"><i class="fas fa-building"></i>&nbsp Firms</a>
                    <a href="notifications" class="con_tabs_links">
                        <div id="getcount">
                            <!---- show the notification count
                                ------------------->
                        </div>
                       <i class="fas fa-bell"></i>&nbsp Notifications</a>
                    <a href="activity" class="con_tabs_links"><i class="fa fa-history" aria-hidden="true"></i>&nbsp Activity Logs</a>
                </div>
            </div>

            <!----------------------- copyright -------------------------------->
            <div class="side_menu_footer">

                <div class="logo_title">
                    <img src="images/favicon.png">
                    <h3>STOCKPILE</h3>
                </div>
                <h5>All rights reserved,copyright&copy; STOCKPILE,2020</h5>
            </div>

        </div>
        <div class="top_content">

            <div class="top_nav">
                <div class="top_nav_heading">
                 <!-----------------------------------------side menu open close-------------------------------------->
                    <div class="hamburger" onclick="side_menu_open()">
                        <a><i class="fas fa-bars"></i></a>
                    </div>
                    
                    <h3><?php echo $_SESSION["clg_name"] ;?> </h3>
                </div>

                <div class="top_nav_contents">
 <!-----------------------------------------clock-------------------------------------->
                    <div class="clock">
                        <i class="fas fa-clock"></i>
                        <div id="time" onload="showTime()"></div>
                    </div>
 <!-----------------------------------------date------------------------------------->
                    <div class="date">

                        <i class="fas fa-calendar-day"></i>

                        <?php

                            date_default_timezone_set("Asia/kolkata");

                            echo date("d-m-y");

                        ?>

                        <i class="fas fa-angle-down" id="angle_arrow"  onclick="show_calendar()"></i>

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
 <!---------------------------------------notification--------------------------------------> 

                    <div class="noti" id="notify_records">

                        <!------------ show notification dropdown here along with the bell icon
                            -------------------------->
                    </div>
 <!-----------------------------------------logout-------------------------------------->
                    <div class="logout">
                        <a type="button" onclick="getLogout()">Logout</a>
                    </div>


                </div>

            </div>
 <!-----------------------------------------content div------------------------------------->
            <div class="content">

                <!-------------------- welcome college admin --------------------->

                <div class="welcome display">
                    <div class="user_icon">
                        <i class="fas fa-smile"></i>
                        <!--<img src="images/face.jpg">-->
                    </div>

                    <div class="msg_body">
                        <h5>Hey, College Admin</h5>
                        <p>You're finally here, have a look around!</p>
                    </div>
                    <div class="cancel_icon">
                        <i class="fas fa-times-circle" id="close"></i>
                    </div>
                </div>

                <!--------------------------------------------overview heading ---------------------------------------------->
                <h1>Overview</h1>
 <!-----------------------------------------counters-------------------------------------->
                <div id="home_counter" class="content_counter">

                </div>



 <!-----------------------------------------instriction-------------------------------------->
                <div class="instruction">

                    <div class="ins_head">

                        <img src="images/Group 10.png" class="ins_pic">


                        <h5>Activities of College Admin</h5>


                        <p>You can add & edit Departments which are under the <?php echo $_SESSION["clg_name"] ;?>.</p>

                        <p>You can add , edit & delete Department Admins for the departments which are under <?php echo $_SESSION["clg_name"] ;?>.</p>

                        <p>You can add , edit & delete firms & also can send mail to the firms which you have already added.</p>

                        <p>You can send notification to the Super Admin as well as can view your notifications.</p>

                        <!---<p>You can edit , approve or deny the notifications which are sent by the Department Admins of the college of agriculture.</p>-->

                        <p>You can edit , approve or deny the notifications received from the Departments which are under <?php echo $_SESSION["clg_name"] ;?>.</p>


                        <p>Lastly , You can see your previous activities.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <!------------------------------------------------------ gsap link ----------------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>

    <!----------------------------------------------------- ajax link
        ------------------------------------------------------>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <!----------------------------------------------------- js link
        ----------------------------------------------------->
    <script src="js/dashboard.js"></script>

    <!----------------------------------------------------- sweet alert link
        ------------------------------------------------------>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <!--------------------------------------------------bootstrap js link ----------------------------------------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <!----------------------------------------- show counts 
        ---------------------------------------->
    <script type="text/javascript">
        $(document).ready(function(){
            showCounter();
        });
        
        function showCounter() {
            var readcounts = "readcounts";
            $.ajax({
                url:"action_home.php",
                type:"post",
                data:{ readcounts:readcounts },
                success:function(data,status){
                    $('#home_counter').html(data);
                }
            });
        }

        setInterval(function () {
            showCounter();
        }, 30000);
    </script>


</body>

</html>