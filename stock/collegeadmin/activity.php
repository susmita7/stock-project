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
    <title>College Admin Activities | Stockpile</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">

    <!--------------------------------------------------css link
        ----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/activity.css">
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
     <!-----------------------------------------side menu open close-------------------------------------->
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
                    <a href="home" class="con_tabs_links"><i class="fas fa-home"></i>
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
                    <a href="activity" class="con_tabs_links ac"><i class="fa fa-history" aria-hidden="true"></i>&nbsp Activity Logs</a>
                </div>
            </div>
            

            <!---------------------------------------------------- copyright------------------------------------------->
            <div class="side_menu_footer">
                <!-- <img src="images/stockpileLogo1.png"> -->
                <div class="logo_title">
                    <img src="images/favicon.png">
                    <h3>STOCKPILE</h3>
                </div>
                <h5>All rights reserved,copyright&copy; STOCKPILE,2020</h5>
            </div>
        </div>
        <div class="top_content">
            <div class="top_nav">
             <!-----------------------------------------heading-------------------------------------->
                <div class="top_nav_heading">
                 <!-----------------------------------------side menu open close-------------------------------------->
                    <div class="hamburger" onclick="side_menu_open()">
                        <a><i class="fas fa-bars"></i></a>
                    </div>
                    <h3><?php echo $_SESSION["clg_name"] ;?> </h3>
                </div>

                <div class="top_nav_contents">
 <!----------------------------------------clock-------------------------------------->
                    <div class="clock">
                        <i class="fas fa-clock"></i>
                        <div id="time" onload="showTime()"></div>
                    </div>
 <!-----------------------------------------date-------------------------------------->
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
                    <div class="noti" id="notify_records">

                        <!------------ show notification dropdown here along with the bell icon
                            -------------------------->
                    </div>
 <!----------------------------------------logout-------------------------------------->
                    <div class="logout">
                        <a type="button" onclick="getLogout()">Logout</a>
                    </div>

                </div>

            </div>
 <!----------------------------------------content div-------------------------------------->
            <div class="content">

                <div class="college">
                    <div class="heading_add_btn">
                        <div class="icon_heading">
                            <i class="fas fa-history"></i>
                            <h1>All Activities</h1>
                        </div>
                        <div class="item_unit_btn">
                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search" autocomplete="off">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>
                            <a id="add_clg" type="button" onclick="clearAll()">Clear all</a>
                        </div>
                    </div>
                </div>


                <div id="my_activities">
                    <!---------------- show activities here
                        ---------------------->
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

            </div>
        </div>
    </div>


    <!--------------------------------------------------gsap link
        ----------------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/dashboard.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!--------------------------------------------------bootstrap js link----------------------------------------------------------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    
    

    <!--------------------------------------- show all activities in content div
        --------------------------------------->
    
    <script type="text/javascript">
        
        $(document).ready(function(){
            showActivities();
        });
        
        function showActivities() {
            var readactivities = "readactivities";
            $.ajax({
                url:"action_activity.php",
                type:"post",
                data:{ readactivities:readactivities },
                success:function(data,status){
                    $('#my_activities').html(data);
                }
            });
        }
        /*
        setInterval(function () {
            showActivities();
        }, 30000);
        */
    </script>

    <!--------------------------------- clear all activity
        ----------------------------------------->

    <script type="text/javascript">
        function clearAll() {
            var clearall = "clearall";
            $.ajax({
                url:"action_activity.php",
                type:"post",
                data:{ clearall:clearall },
                success:function(result){
                    var response=$.parseJSON(result);
                    swal(""+response.title , ""+response.text ,""+response.icon);
                    showActivities();
                }
            });
        }
    </script>


    <!------------------------- clear with id
        ----------------------------->
    
    <script type="text/javascript">

    function getClear(delid) {
        $('#deleteid').val(delid);
        overlay_delete();
    }
    </script>



    <!-------------------------------- clear activity ajax request 
        -------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#deleteform", function (e) {
        e.preventDefault();

        var delid=$('#deleteid').val();          

        $.ajax({
            url:"action_activity.php",
            type: "POST",
            data: { clear:1,delid:delid },
            success:function(result){
                var response=$.parseJSON(result);
                swal(""+response.title , ""+response.text ,""+response.icon);
                reverse_delete();
                showActivities();
            }
          });
    });
        
    </script>


    <!-------------------------------------------------- searching 
        --------------------------------------------->

    <script>
        $(document).ready(function () {
            $("#search").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#mydiv ").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <script>
        
        //search
        $(document).ready(function () {
            $(".fa-search").click(function () {
                $("#search").val("");
                showActivities();
                $(".icon").toggleClass("show_search");
                $("input[type='text']").toggleClass("show_search")
            });
        });

        // overlay for delete in-out


        function overlay_delete() {
            let over = document.getElementById("overlay-delete");
            gsap.to(over, {
                duration: .5,
                opacity: 1,
                display: 'block'
            });
        }

        function reverse_delete() {
            let cross = document.getElementById("overlay-delete");
            gsap.to(cross, {
                duration: .5,
                opacity: 0,
                display: 'none'
            });

        }
    </script>



</body>

</html>