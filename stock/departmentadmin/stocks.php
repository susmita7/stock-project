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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock Details | Stockpile</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    
    <!-------------------------------------------------- css link ----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/stock.css">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/media_dashboard.css">

    <!-------------------------------------------------- bootstrap css link ----------------------------------------------------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <!-------------------------------------------------- font asesome link ----------------------------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    
    <!-------------------------------------------------- google fonts link ----------------------------------------------------------->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins:300&display=swap" rel="stylesheet">
</head>

<body onload="renderDate()">
    <div class="wrapper">
     <!-----------------------------------------side menu open close-------------------------------------->
        <div class="side_menu" id="menu">
            <div class="side_menu_close_btn" onclick="side_menu_open()">
                <a><i class="fas fa-window-close"></i></a>
            </div>

            <!----------------------------------------------------profile
                ---------------------------------------------->

            <div id="info" class="admin con_tabs">
                <!----------------------- show profile pic nd name here
                    ---------------------------->
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
                    <a href="stocks" class="con_tabs_links ac"><i class="fas fa-cubes"></i> Stock Details</a>
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


            <!---------------------------------------------------- copyright ------------------------------------------->
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

                    <!---------------------------------------------------- logout ---------------------------------------------->
                    <div class="logout">
                        <a type="button" onclick="getLogout()">Logout</a>
                    </div>
                
                </div>

            </div>

            <div class="content">

                <div class="college">
                    
                    <div class="heading_add_btn">
                        
                        <div class="icon_heading">
                            <i class="fas fa-cubes"></i>
                            <h1>Recurring Stock Details</h1>
                        </div>
                        
                        <div class="item_unit_btn">
                            <!-------------------------------------------- search bar ---------------------------------->
                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search1" autocomplete="off">
                                <div id="s1" class="icon"> <i class="fas fa-search"></i></div>
                            </div>
                        </div>

                    </div>

                    <div id="rec_table">

                        <!------------------- table for recurring stock details 
                            --------------------------->
                    </div>
                    
                </div>



                <div class="college_1">

                    <div class="heading_add_btn">

                        <div class="icon_heading">
                            <i class="fas fa-cubes"></i>
                            <h1>Non-Recurring Stock Details</h1>
                        </div>
                        
                        <div class="item_unit_btn">
                            <!-------------------------------------------- search bar ---------------------------------->
                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search2" autocomplete="off">
                                <div id="s2" class="icon"> <i class="fas fa-search"></i></div>
                            </div>
                        </div>
                    
                    </div>


                    <div id="non_rec_table">
                        <!----------------- table for non-recurring stock details 
                            ---------------------------->
                    </div>

                    
                </div>

            </div>

        </div>
    </div>



    <!------------------------------------------------------- gsap link 
        ----------------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>
    
    <!--------------------------------------------------ajax link 
        ----------------------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    
    <!--------------------------------------------------js link 
        ----------------------------------------------------------->
    <script src="js/dashboard.js"></script>
    
    <!---------------------------------------------------- sweet-alert link 
        ------------------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <!--------------------------------------------------bootstrap js link 
        ----------------------------------------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>





    <!---------------------------------------------------- Recurring details table 
        --------------------------------------->
    <script type="text/javascript">
        
        $(document).ready(function(){
            showRectables();
        });
        
        function showRectables() {
            var readrec = "readrec";
            $.ajax({
                url:"action_stock.php",
                type:"post",
                data:{ readrec:readrec },
                success:function(data,status){
                    $('#rec_table').html(data);
                }
            });
        }
        
        setInterval(function () {
            $("#search1").val("");
            showRectables();
        }, 60000);
    
    </script>

    <!------------------------------------------------------- Non-recurring details table 
        --------------------------------------->
    <script type="text/javascript">
        
        $(document).ready(function(){
            showNonrectables();
        });
        
        function showNonrectables() {
            var readnonrec = "readnonrec";
            $.ajax({
                url:"action_stock.php",
                type:"post",
                data:{ readnonrec:readnonrec },
                success:function(data,status){
                    $('#non_rec_table').html(data);
                }
            });
        }

        setInterval(function () {
            $("#search2").val("");
            showNonrectables();
        }, 60000);

    </script>



    

    


    <!---------------------------- clear the search field on icon click
        --------------------------------->

    <script type="text/javascript">

    $(document).ready(function(){
        $("#s1").click(function(){
            $("#search1").val("");
            showRectables();
        });
    });

    $(document).ready(function(){
        $("#s2").click(function(){
            $("#search2").val("");
            showNonrectables();
        });
    });

    </script>

    


    <!------------------------------------------------------------- searching ----------------------------------------------->


    <!------------------------------------------------------ Recurring table searching ----------------------------------------------->

    <script>
        $(document).ready(function () {
            $("#search1").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable1 tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>


    <!------------------------------------------------------ Non-recurring table searching ----------------------------------------------->

    <script>
        $(document).ready(function () {
            $("#search2").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable2 tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>


    
</body>

</html>