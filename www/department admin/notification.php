<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Notifications</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/notification.css">
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
                        Dashboard</a>

                    <a href="expert_user.php" class="con_tabs_links"><i class="fas fa-user"></i>
                        Expert users</a>
                    <a href="stock_group.php" class="con_tabs_links"><i class="fas fa-object-group"></i>
                        Stock groups</a>
                    <a href="stock.php" class="con_tabs_links"><i class="fas fa-cubes"></i> Stock details</a>
                    <a href="order.php" class="con_tabs_links"><i class="fas fa-copy"></i> File details</a>
                    <a href="notification.php" class="con_tabs_links"><span class="counter_side_noti">
                            <p>2</p>
                        </span><i class="fas fa-bell"></i> Notifications</a>
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
        <!---------------------------------------------------top nav ---------------------------------------------->
        <div class="top_content">

            <div class="top_nav">
                <!---------------------------------------------------- heading ------------------------------------------>
                <div class="top_nav_heading">
                    <div class="hamburger" onclick="side_menu_open()">
                        <a><i class="fas fa-bars"></i></a>
                    </div>
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
                    <!---------------------------------------------------- logout---------------------------------------------->
                    <div class="logout">
                        <a href="#">Logout</a>
                    </div>


                </div>

            </div>
            <!----------------------------------------content div---------------------------------->

            <div class="content">
                <div class="college">
                    <div class="heading_btn">
                        <div class="icon_heading">
                            <i class="fas fa-bell"></i>
                            <h1>All notifications</h1>
                        </div>
                        <div class="item_unit_btn">
                            <!----------------------------------------search---------------------------------->
                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>
                            <a type="button" id="add_item">Read all</a>
                        </div>
                    </div>
                </div>

                <!-- -----------------------------------notification div from expert user-------------------------------- -->
                <div class="base_notofication" id="mydiv">
                    <div class="from">
                        <h5>Agricultural statistics</h5>
                    </div>

                    <div class="description">

                        <div class="title">
                            <i class="fas fa-bell"></i>
                            <h6>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt, voluptatum?</h6>
                        </div>


                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis ullam est expedita laborum
                            nulla doloribus vitae exercitationem maxime cupiditate inventore.</p>

                        <div class="time_date">
                            <h4>26-04-2020 , 12:46 PM</h4>
                        </div>
                    </div>

                    <div class="btns">
                        <a type="button" class="noti_btn1">Verify</a>
                        <a type="button" class="noti_btn2" onclick="overlay_update()">Edit</a>
                        <a type="button" class="noti_btn3" onclick="overlay_delete()">Cancel</a>
                    </div>

                </div>



                <!-- -----notification div for clg_admin and show div after verfication ------ -->
                <div class="base_notofication" id="mydiv">
                    <div class="from">
                        <h5>Agricultural Statistics</h5>
                    </div>

                    <div class="description">

                        <div class="title">
                            <i class="fas fa-bell"></i>
                            <h6>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt, voluptatum?</h6>
                        </div>


                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis ullam est expedita laborum
                            nulla doloribus vitae exercitationem maxime cupiditate inventore.</p>

                        <div class="time_date">
                            <h4>26-04-2020 , 12:46 PM</h4>
                        </div>
                    </div>

                    <div class="btns">
                        <a type="button" class="noti_btn4">Forward</a>
                    </div>

                </div>



                <!-- -----------------------------------notification div from status forwarded-------------------------------- -->
                <div class="base_notofication" id="mydiv">
                    <div class="from">
                        <h5>Agricultural Statistics</h5>
                    </div>

                    <div class="description">

                        <div class="title">
                            <i class="fas fa-bell"></i>
                            <h6>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt, voluptatum?</h6>
                        </div>


                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis ullam est expedita laborum
                            nulla doloribus vitae exercitationem maxime cupiditate inventore.</p>

                        <div class="time_date">
                            <h4>26-04-2020 , 12:46 PM</h4>
                        </div>
                    </div>

                    <div class="status">
                        <i class="fas fa-clipboard-check"></i>
                        <h5>Forwarded</h5>
                    </div>

                </div>


                <!-- -----------------------------------notification div from status cancelled-------------------------------- -->
                <div class="base_notofication" id="mydiv">
                    <div class="from">
                        <h5>Agricultural Statistics</h5>
                    </div>

                    <div class="description">

                        <div class="title">
                            <i class="fas fa-bell"></i>
                            <h6>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt, voluptatum?</h6>
                        </div>


                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis ullam est expedita laborum
                            nulla doloribus vitae exercitationem maxime cupiditate inventore.</p>

                        <div class="time_date">
                            <h4>26-04-2020 , 12:46 PM</h4>
                        </div>
                    </div>

                    <div class="status">
                        <i class="fas fa-window-close"></i>
                        <h5>Cancelled</h5>
                    </div>

                </div>



                <!--------------------------------------------------overlay update--------------------------------------------->



                <div class="overlay_update" id="overlay-update">
                    <a id="cross" onclick="reverse_update()" type="button"><i class="fas fa-times-circle"></i></a>

                    <div class="add_clg_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Update Order</h1>

                        </div>
                        <div class="main_add_clg">
                            <!-------------------------------------------form-------------------------------------->
                            <form action="" method="POST" id="">


                                <div class="row">
                                    <div class="col">
                                        <p>Particular Name</p>
                                        <input type="text" class="form-control form-control-sm" id="first_name_up"
                                            readonly>
                                    </div>
                                    <div class="col">
                                        <p>Particular Unit</p>
                                        <input type="text" class="form-control form-control-sm" id="last_name_up"
                                            readonly>
                                    </div>
                                </div>


                                <p>Quantity</p>
                                <input type="text" class="form-control form-control-sm">

                                <div class="add_clg_btn"><input type="submit" value="Save changes"></div>

                            </form>

                        </div>
                    </div>
                </div>




                <!-----------------------------------------overlay delete---------------------------------->

                <div class="overlay_update" id="overlay-delete">

                    <div class="main_delete">
                        <div class="icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h1>Are You Sure?</h1>

                        <div class="button">
                            <form action="" id="">
                                <input type="hidden" id="">
                                <div class="del_btn">
                                    <a type="button" class="okay">Yes</a>
                                    <a type="button" class="cancel" onclick="reverse_delete()">No</a>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>





            </div>
        </div>
    </div>


    <!--------------------------------------------------gsap link-------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>
    <!---------------------------------------------------- ajax link ---------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!---------------------------------------------------- js link ---------------------------------------------->
    <script src="js/dashboard.js"></script>
    <script src="js/notification.js"></script>
    <!--------------------------------------------------sweet alert ---------------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!--------------------------------------------------bootstrap js link----------------------------------------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <!------------------------------------------------------------- searching ----------------------------------------------->

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


</body>

</html>