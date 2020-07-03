<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Stock Details</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/stock.css">
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
                    <a href="dept_admin_dashboard_home.php" class="con_tabs_links"><i class="fas fa-home"></i>
                        Dashboard</a>

                    <a href="expert_user.php" class="con_tabs_links"><i class="fas fa-user"></i>
                        Expert users</a>
                    <a href="stock_group.php" class="con_tabs_links"><i class="fas fa-object-group"></i>
                        Stock groups</a>
                    <a href="stock.php" class="con_tabs_links ac"><i class="fas fa-cubes"></i> Stock details</a>
                    <a href="order.php" class="con_tabs_links"><i class="fas fa-copy"></i> File details</a>
                    <a href="notification.php" class="con_tabs_links"><span class="counter_side_noti">
                            <p>2</p>
                        </span><i class="fas fa-bell"></i> Notifications</a>
                    <a href="activity.php" class="con_tabs_links"><i class="fas fa-history"></i> Activity log</a>
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
                        <a type="button">Logout</a>
                    </div>


                </div>

            </div>

            <div class="content">

                <!----------------------------------------red alert----------------------------------->
                <div class="warning_red show">
                    <div class="icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="msg">
                        <p>Warning : Less Stock,Please check! <p>

                    </div>
                    <div class="cancel">
                        <i class="fas fa-times-circle" id="close"></i>
                    </div>
                </div>
                <!----------------------------------------yellow alert----------------------------------->

                <div class="warning_yellow show">
                    <div class="icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="msg">
                        <p>Warning : Less Stock,Please check! <p>

                    </div>
                    <div class="cancel">
                        <i class="fas fa-times-circle" id="close"></i>
                    </div>
                </div>


                <div class="college">
                    <div class="heading_add_btn">
                        <div class="icon_heading">
                            <i class="fas fa-cubes"></i>
                            <h1>Recurring stock details</h1>
                        </div>
                        <div class="item_unit_btn">
                            <!-------------------------------------------- search bar---------------------------------->
                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search1">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>

                        </div>
                    </div>

                    <div class="table-responsive table_data">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="align-middle">Sl. no</th>
                                    <th scope="col" class="align-middle">Usage</th>
                                    <th scope="col" class="align-middle">Name</th>
                                    <th scope="col" class="align-middle">Quantity</th>
                                    <th scope="col" class="align-middle">Unit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable2">
                                <tr>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">stationary</td>
                                    <td class="align-middle">reccuring</td>
                                    <td class="align-middle">statistics</td>
                                    <td class="align-middle">statistics</td>
                                </tr>

                                <tr>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">stationary</td>
                                    <td class="align-middle">non reccuring</td>
                                    <td class="align-middle">statistics</td>
                                    <td class="align-middle">statistics</td>
                                </tr>

                                <tr>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">stationary</td>
                                    <td class="align-middle">non reccuring</td>
                                    <td class="align-middle">statistics</td>
                                    <td class="align-middle">statistics</td>
                                </tr>
                                <tr>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">stationary</td>
                                    <td class="align-middle">non reccuring</td>
                                    <td class="align-middle">statistics</td>
                                    <td class="align-middle">statistics</td>
                                </tr>
                                <tr>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">stationary</td>
                                    <td class="align-middle">non reccuring</td>
                                    <td class="align-middle">statistics</td>
                                    <td class="align-middle">statistics</td>
                                </tr>


                            </tbody>
                        </table>

                    </div>



                </div>



                <div class="college_1">
                    <div class="heading_add_btn">
                        <div class="icon_heading">
                            <i class="fas fa-cubes"></i>
                            <h1>Non-Recurring stock details</h1>
                        </div>
                        <div class="item_unit_btn">
                            <!-------------------------------------------- search bar---------------------------------->
                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search2">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive table_data">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="align-middle">Sl. no</th>
                                    <th scope="col" class="align-middle">Usage</th>
                                    <th scope="col" class="align-middle">Name</th>
                                    <th scope="col" class="align-middle">Quantity</th>
                                    <th scope="col" class="align-middle">Unit</th>
                                </tr>
                            </thead>
                            <tbody id="myTable2">
                                <tr>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">stationary</td>
                                    <td class="align-middle">reccuring</td>
                                    <td class="align-middle">statistics</td>
                                    <td class="align-middle">statistics</td>
                                </tr>

                                <tr>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">stationary</td>
                                    <td class="align-middle">non reccuring</td>
                                    <td class="align-middle">statistics</td>
                                    <td class="align-middle">statistics</td>
                                </tr>

                                <tr>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">stationary</td>
                                    <td class="align-middle">non reccuring</td>
                                    <td class="align-middle">statistics</td>
                                    <td class="align-middle">statistics</td>
                                </tr>
                                <tr>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">stationary</td>
                                    <td class="align-middle">non reccuring</td>
                                    <td class="align-middle">statistics</td>
                                    <td class="align-middle">statistics</td>
                                </tr>
                                <tr>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">stationary</td>
                                    <td class="align-middle">non reccuring</td>
                                    <td class="align-middle">statistics</td>
                                    <td class="align-middle">statistics</td>
                                </tr>


                            </tbody>
                        </table>

                    </div>


                </div>

            </div>

        </div>
    </div>



    <!--------------------------------------------------gsap link----------------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>
    <!--------------------------------------------------ajax link----------------------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!--------------------------------------------------js link----------------------------------------------------------->
    <script src="js/dashboard.js"></script>
    <!---------------------------------------------------- sweet-alert link ------------------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--------------------------------------------------bootstrap js link----------------------------------------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!------------------------------------------------------------- searching ----------------------------------------------->

    <script>
        //recurring search

        $(document).ready(function () {
            $("#search1").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable1 tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        //non recurring search

        $(document).ready(function () {
            $("#search2").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable2 tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });


        //clear search

        $(document).ready(function () {
            $(".fa-search").click(function () {
                $(".icon").toggleClass("show_search");
                $("input[type='text']").toggleClass("show_search")
            });
        });
    </script>


    <!-----------------------------------alert-------------------------------------->

    <script>


        //warning_yellow
        
        $(document).ready(function () {
            showWarning();
        });

        setInterval(function () {
            showWarning();
        }, 10000);


        function showWarning() {
            var stock = 5

            if (stock == 5)

                showYellowWarning();
            else
                showRedWarning();
        }

        //yellow warning

        function showYellowWarning() {

            $(".warning_yellow").css('display', 'flex');

            setTimeout(function () {
                $(".warning_yellow").fadeOut(1000);
            }, 5000);

            $("#close").click(function () {
                $(".warning_yellow").css('display', 'none');
            });

        }


        //warning_red


        function showRedWarning() {

            $(".warning_red").css('display', 'flex');

            setTimeout(function () {
                $(".warning_red").fadeOut(1000);
            }, 5000);

            $("#close").click(function () {
                $(".warning_red").css('display', 'none');
            });

        }

    </script>

</body>

</html>