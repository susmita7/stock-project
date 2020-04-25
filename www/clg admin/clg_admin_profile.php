<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dsahboard | clg admin profile</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/clg_admin_profile.css">
    <link rel="stylesheet" type="text/css" href="css/main_dashboard.css">
    <!--------------------------------------------------bootstrap css link----------------------------------------------------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!--------------------------------------------------font asesome link----------------------------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <!--------------------------------------------------google fonts link----------------------------------------------------------->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins:300&display=swap" rel="stylesheet">

    <!--------------------------------------------------input file button script------------------------------------------------->

    <script>
        (function (e, t, n) {
            var r = e.querySelectorAll("html")[0];
            r.className = r.className.replace(/(^|\s)no-js(\s|$)/, "$1js$2")
        })(document, window, 0);
    </script>
</head>

<body onload="renderDate()">
    <div class="wrapper">
        <div class="side_menu">
            <div class="side_menu_close_btn" onclick="side_menu_close()">
                <a><i class="fas fa-window-close"></i></a>
            </div>
            <div class="admin con_tabs">
                <!-------------------------------------------- profile ---------------------------------->
                <img src="AAu-jorhat.jpg" alt="aau.jpg">
                <h4>Welcome Priya</h4>
                <a href="clg_admin_profile.php">View Profile</a>
            </div>
            <!-------------------------------------------- tabs---------------------------------->
            <div class="tabs">
                <div class="con_tabs">
                    <a href="clg_admin_dashboard_home.php" class="con_tabs_links"><i class="fas fa-home"></i>
                        Home</a>
                    <a href="department.php" class="con_tabs_links"><i class="fas fa-book"></i> Departments</a>

                    <a href="dept_admin.php" class="con_tabs_links"><i class="fas fa-user"></i>
                        Dept_admins</a>
                    <a href="#" class="con_tabs_links"><span class="counter_side_noti">
                            <p>2</p>
                        </span><i class="fas fa-bell"></i> Notifications</a>
                    <a href="firms.php" class="con_tabs_links"><i class="fas fa-building"></i> Firms</a>

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
        <!-------------------------------------------- top nav ---------------------------------->
        <div class="top_content">
            <div class="hamburger" onclick="side_menu_open()">
                <a><i class="fas fa-bars"></i></a>
            </div>
            <!---------------------------------------college name heading ---------------------------------->
            <div class="top_nav">
                <div class="top_nav_heading">
                    <h3>College of Agriculture</h3>
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
                        <a href="#">Logout</a>
                    </div>

                </div>

            </div>
            <div class="content">


                <!------------------------------------- profile details ------------------------------->

                <div class="main_profile">
                    <div class="heading_pro">
                        <h1>YOUR PROFILE</h1>
                        <img src="images/face.jpg" class="pro_pic">
                    </div>

                    <!---------------------------------------- details ------------------------------------>
                    <div class="details">
                        <div class="left_content">
                            <h3>Name :</h3>
                            <h3>Email ID :</h3>
                        </div>
                        <div class="right_content">
                            <h3>Kaushik Kamal Bordoloi</h3>
                            <h3>superadmin@gmail.com</h3>
                        </div>
                    </div>

                    <!------------------------------- update profile and reset password butto------------------------------>

                    <div class="up_re_btn">
                        <a id="up_pro" type="button" onclick="overlay_update()">Edit Profile</a>
                        <a id="re_pass" type="button" onclick="overlay_pass()">Reset Password</a>
                    </div>
                </div>




                <!---------------------------------------- overlay update ------------------------------------>

                <div class="overlay_update" id="overlay-up">
                    <a id="cross" onclick="reverse_update()" type="button"><i class="fas fa-times-circle"></i></a>


                    <div class="update_profile_page" id="update">
                        <div class="heading_pro">
                            <h1>EDIT PROFILE</h1>
                            <!---------------------------------------------- image --------------------------------------->
                            <img src="images/face.jpg" class="pro_pic">
                        </div>


                        <div class="main_update">
                            <!---------------------------------------------form --------------------------------------->
                            <form action="" method="POST">
                                <div class="box">
                                    <input type="file" name="file-2[]" id="file-2" class="inputfile inputfile-2"
                                        data-multiple-caption="{count} files selected" multiple />
                                    <label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17"
                                            viewBox="0 0 20 17">
                                            <path
                                                d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                                        </svg> <span>upload image</span></label>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p>First Name</p>
                                        <input type="text" class="form-control form-control-sm" id="first_name_up">
                                    </div>
                                    <div class="col">
                                        <p>Last Name</p>
                                        <input type="text" class="form-control form-control-sm" id="last_name_up">
                                    </div>
                                </div>


                                <p>Email ID</p>
                                <input type="email" class="form-control form-control-sm">

                                <p>Phone No.</p>
                                <input type="number" class="form-control form-control-sm">

                                <div class="update_btn"><input type="submit" value="Save changes"></div>
                                <!---------------------------------------------- end of form --------------------------------------->
                            </form>
                            <!--------------------------------------------- end of main_update_div ------------------------------>
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
                            <form action="" method="POST">
                                <!-------------------------------------------image--------------------------------------->
                                <img src="images/face.jpg" class="pro_pic">
                        </div>


                        <div class="main_pass">
                            <!---------------------------------------------- form --------------------------------------->
                            <form action="" method="POST">
                                <p>Email ID</p>
                                <input type="text" class="form-control form-control-sm" readonly>

                                <p>Password</p>
                                <input type="email" class="form-control form-control-sm">


                                <p>Confirm password</p>
                                <input type="number" class="form-control form-control-sm">

                                <div class="update_btn"><input type="submit" value="Save"></div>
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


    <!--------------------------------------------------gsap link----------------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>
    <!--------------------------------------------------ajax link----------------------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!--------------------------------------------------js link----------------------------------------------------------->
    <script src="js/dashboard.js"></script>
    <script src="js/profile.js"></script>

    <!---------------------------------------------------- sweet-alert link ------------------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <!--------------------------------------------------bootstrap js link----------------------------------------------------------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>