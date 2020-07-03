<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | College of AAU</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/college.css">
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
                    <a href="super_admin_dashboard_home.php" class="con_tabs_links"><i class="fas fa-home"></i>
                        Home</a>
                    <a href="faculty.php" class="con_tabs_links"><i class="fas fa-user-friends"></i> Faculties</a>
                    <a href="college.php" class="con_tabs_links ac"><i class="fas fa-book"></i>&nbsp Colleges</a>

                    <a href="clg_admin.php" class="con_tabs_links"><i class="fas fa-user"></i>&nbsp
                        Clg_admins</a>
                    <a href="#" class="con_tabs_links"><span class="counter_side_noti">
                            <p>2</p>
                        </span><i class="fas fa-bell"></i>&nbsp Notifications</a>
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
                    <h3>Assam Agriculture University</h3>
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

                    <!-------------------------------------------notification ---------------------------------->
                    <div class="noti">
                        <span class="counter">
                            <p>2</p>
                        </span>
                        <i class="fas fa-bell" class="noti_bell" onclick="show_notification()"></i>

                        <div class="drop_noti" id="notification">

                            <div class="noti_heading_btn">
                                <h6>Notifications</h6>
                                <a type="button">Read all</a>
                            </div>


                            <div class="notification">
                                <div class="alert_icon">
                                    <i class="noti_side_icon fa fa-user"></i>
                                    <h3>Greeting</h3>
                                </div>
                                <div class="noti_content">
                                    <h5>From Agricultural satistics</h5>
                                    <p>order for recurring stock of agriculture statistics</p>
                                    <div class="alert-time">6s ago</div>
                                </div>
                            </div>
                            <hr>
                            <a href="">View all notifications</a>

                        </div>
                    </div>

                    <div class="logout">
                        <a href="#">Logout</a>
                    </div>


                </div>

            </div>

            <div class="content">



                <div class="college">
                    <div class="heading_add_btn">
                        <div class="icon_heading">
                            <i class="fas fa-book"></i>
                            <h1>Colleges Under Assam Agriculture University</h1>
                        </div>
                        <div class="item_unit_btn">
                            <div class="search_bar">
                                <input type="text" placeholder="search">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>
                            <a id="add_clg" href="#" onclick="overlay_add()">Add College</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="align-middle" scope="col">College ID</th>
                                    <th class="align-middle" scope="col">College Name</th>
                                    <th class="align-middle" scope="col">Faculty Name</th>
                                    <th class="align-middle" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle"><?php echo "1" ?></td>
                                    <td class="align-middle"><?php echo "susmita" ?></td>
                                    <td class="align-middle"><?php echo "nitu" ?></td>
                                    <td class="align-middle"><a id="up_clg" class="editbtn" href="#"
                                            onclick="overlay_update()">Update</a></td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><?php echo "1" ?></td>
                                    <td class="align-middle"><?php echo "priya" ?></td>
                                    <td class="align-middle"><?php echo "susmita" ?></td>
                                    <td class="align-middle"><a id="up_clg" class="editbtn" href="#"
                                            onclick="overlay_update()">Update</a></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>


                <div class="overlay_add" id="overlay-add">
                    <a id="cross" onclick="reverse_add()"><i class="fas fa-times-circle"></i></a>
                    <div class="add_clg_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Add College</h1>
                        </div>


                        <div class="main_add_clg">
                            <form action="" id="form">
                                <p>College Name</p>
                                <input type="text" class="form-control form-control-sm" id="name_clg" required>


                                <p>Faculty Name</p>

                                <select class="form-control form-control-sm" id="clg_name_up" required>
                                    <option value="" disabled selected>Select College</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                </select>
                                <div class="add_clg_btn"><input type="submit" value="Save"></div>

                            </form>

                        </div>
                    </div>
                </div>





                <div class="overlay_update" id="overlay-update">
                    <a id="cross" onclick="reverse_update()"><i class="fas fa-times-circle"></i></a>

                    <div class="add_clg_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Update College</h1>

                        </div>
                        <div class="main_add_clg">
                            <form action="" method="POST">
                                <p>College Name</p>
                                <input type="text" class="form-control form-control-sm" id="clg_name">


                                <p>Faculty Name</p>

                                <select class="form-control form-control-sm" id="clg_name_up" required>
                                    <option value="" disabled selected>Select College</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                </select>

                                <div class="add_clg_btn"><input type="submit" value="Save changes"></div>

                            </form>

                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>


    <!--------------------------------------------------gsap link----------------------------------------------------------->

    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/college.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>






    <!--------------------------------------------------bootstrap js link----------------------------------------------------------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>