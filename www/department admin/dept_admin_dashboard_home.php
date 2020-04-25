<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Home</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/dept_admin_dashboard_home.css">
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

            <!----------------------------------------------------profile---------------------------------------------->
            <div class="admin con_tabs">
                <img src="images/face.jpg" alt="aau.jpg">
                <h4>Welcome Priya</h4>
                <a href="dept_admin_profile.php">View Profile</a>
            </div>
            <!---------------------------------------------------- side manu tabs ------------------------------------>
            <div class="tabs">
                <div class="con_tabs">
                    <a href="dept_admin_dashboard_home.php" class="con_tabs_links ac"><i class="fas fa-home"></i>
                        Home</a>

                    <a href="expert_user.php" class="con_tabs_links"><i class="fas fa-user"></i>
                        Expert users</a>
                    <a href="stock_group.php" class="con_tabs_links"><i class="fas fa-object-group"></i>
                        Stock groups</a>
                    <a href="#" class="con_tabs_links"><i class="fas fa-cubes"></i> Stocks</a>
                    <a href="#" class="con_tabs_links"><i class="fas fa-copy"></i> Orders</a>
                    <a href="#" class="con_tabs_links"><span class="counter_side_noti">
                            <p>2</p>
                        </span><i class="fas fa-bell"></i> Notifications</a>

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
        <!---------------------------------------------------top nav ---------------------------------------------->
        <div class="top_content">
            <div class="hamburger" onclick="side_menu_open()">
                <a><i class="fas fa-bars"></i></a>
            </div>
            <div class="top_nav">
                <!---------------------------------------------------- heading ------------------------------------------>
                <div class="top_nav_heading">
                    <h3>Assam Agriculture University</h3>
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
                    <!----------------------------------------------------notification ---------------------------------------------->
                    <div class="noti">
                        <span class="counter">
                            <p>2</p>
                        </span>
                        <i class="fas fa-bell" class="noti_bell" onclick="show_notification()"></i>

                        <div class="drop_noti" id="notification">
                            <h6>hii!I'm susmita</h6>
                        </div>
                    </div>
                    <!---------------------------------------------------- logout---------------------------------------------->
                    <div class="logout">
                        <a href="#">Logout</a>
                    </div>


                </div>

            </div>
            <!---------------------------------------------------- content div---------------------------------------------->
            <div class="content">




            </div>
        </div>
    </div>


    <!--------------------------------------------------gsap link-------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>
    <!---------------------------------------------------- ajax link ---------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!---------------------------------------------------- js link ---------------------------------------------->
    <script src="js/dashboard.js"></script>
    <!--------------------------------------------------sweet alert ---------------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!--------------------------------------------------bootstrap js link----------------------------------------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</body>

</html>