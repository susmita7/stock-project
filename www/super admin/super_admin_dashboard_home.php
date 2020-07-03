<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Home</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/main_dashboard.css">
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
            <div class="admin con_tabs">
                <img src="images/face.jpg" alt="aau.jpg">
                <h4>Welcome Priya</h4>
                <a href="super_Admin_profile.php">View Profile</a>
            </div>
            <div class="tabs">
                <div class="con_tabs">
                    <a href="super_admin_dashboard_home.php" class="con_tabs_links ac"><i class="fas fa-home"></i>
                        Home</a>
                    <a href="faculty.php" class="con_tabs_links"><i class="fas fa-user-friends"></i> Faculties</a>
                    <a href="college.php" class="con_tabs_links"><i class="fas fa-book"></i>&nbsp Colleges</a>

                    <a href="clg_admin.php" class="con_tabs_links"><i class="fas fa-user"></i>&nbsp
                        Clg_admins</a>
                    <a href="notification.php" class="con_tabs_links"><span class="counter_side_noti">
                            <p>2</p>
                        </span><i class="fas fa-bell"></i>&nbsp Notifications</a>
                    <a href="activity.php" class="con_tabs_links"><i class="fas fa-history"></i> Activity log</a>
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
                <div class="top_nav_heading">
                    <div class="hamburger" onclick="side_menu_open()">
                        <a><i class="fas fa-bars"></i></a>
                    </div>
                    <h3>Assam Agricultural University</h3>
                </div>

                <div class="top_nav_contents">

                    <div class="clock">
                        <i class="fas fa-clock"></i>
                        <div id="time" onload="showTime()"></div>
                    </div>

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

                    <div class="noti">
                        <span class="counter">
                            <p>2</p>
                        </span>
                        <i class="fas fa-bell" class="noti_bell" onclick="show_notification()"></i>

                        <div class="drop_noti" id="notification">
                            <h6>hii!I'm susmita</h6>
                        </div>
                    </div>

                    <div class="logout">
                        <a href="#">Logout</a>
                    </div>


                </div>

            </div>

            <div class="content">
                <!--------------------------------------------overview heading ---------------------------------------------->
                <h1>Overview</h1>

                <div class="content_counter">
                    <div class="con_details">
                        <img src="images/Group 11.png" class="fac">
                        <h4>Faculties</h4>

                        <h2>2</h2>
                    </div>
                    <div class="con_details">
                        <img src="images/dept.png" class="dept">
                        <h4>Colleges</h4>

                        <h2>1</h2>
                    </div>

                    <div class="con_details">
                        <img src="images/Group 9.png" class="ad">
                        <h4>College admins</h4>

                        <h2>1</h2>
                    </div>

                    <div class="con_details">
                        <img src="images/noti.png" class="notify">
                        <h4>Notifications</h4>

                        <h2>3</h2>
                    </div>
                </div>




                <div class="instruction">

                    <div class="ins_head">

                        <img src="images/Group 10.png" class="ins_pic">


                        <h5>Activities of Super admin</h5>


                        <p>You can add and edit faculty which are under the Assam Agricultural University.</p>

                        <p>You can add and edit colleges which are under the faculty you have added.</p>

                        <p>You can add , edit and delete college Admins which are under colleges you have added.</p>


                        <p>You can send notification to college admins of different colleges which you have added.</p>



                        <p>Lastly , You can see your previous activities.</p>
                    </div>
                </div>







            </div>
        </div>
    </div>


    <!--------------------------------------------------gsap link----------------------------------------------------------->

    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/dashboard.js"></script>










    <!--------------------------------------------------bootstrap js link----------------------------------------------------------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>