<?php
  $pair=['pen(packet)'];
  $pair2=['pencil(bundle)'];
  $pair3=['paper(ream)'];
  $pair4=['pen(box)'];
//   $name=['pen', 'pencil','paper','copy'];
//   $unit=['packet','bundle','peice','no'];
  $name=[$pair,$pair2,$pair3,$pair4];
  $quan=[10,20,5,50];
  
  $quan2=[20,3,10,30];
  
?>


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
            <!---------------------------------------------------- content div---------------------------------------------->

            <div class="content">

                <!-- <div class="warning_red show">
                    <div class="icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="msg">
                        <p>Warning : Less Stock,Please check! <p>

                    </div>
                    <div class="cancel">
                        <i class="fas fa-times-circle" id="close"></i>
                    </div>
                </div> -->

<!----------------------------------------------------welcome ---------------------------------------------->

                <div class="welcome display">
                    <div class="user_icon">
                        <i class="fas fa-smile"></i>
                        
                    </div>

                    <div class="msg_body">
                        <h5>Hey,Department Admin<h5><br>
                        <p>You're finally ready, have a look around!<p>

                    </div>
                    <div class="cancel_icon">
                        <i class="fas fa-times-circle" id="close"></i>
                    </div>
                </div>

<!---------------------------------------------------- ---------------------------------------------->
                <h1>Overview</h1>

                <div class="heading_recurring">
<!------------------------------------------------------------------------------------------------->
                    <div class="heading_search">
                        <div class="heading_icon">
                            <i class="fas fa-cubes"></i>
                            <h2>Recurring Stock Details</h2>
                        </div>

                    </div>

<!---------------------------------------------------- ---------------------------------------------->
                    <div class="recurring">
                        <div class="chart">
                            <canvas id="myChart1"></canvas>
                        </div>

                    </div>
                </div>
<!-------------------------------------------------------------------------------------------------->
                <div class="heading_non_recurring">

                    <div class="heading_search">
                        <div class="heading_icon">
                            <i class="fas fa-cubes"></i>
                            <h2>Non-Recurring Stock Details</h2>
                        </div>
                    </div>

<!-------------------------------------------------------------------------------------------------->
                    <div class="non_recurring">

                        <div class="chart">
                            <canvas id="myChart2"></canvas>
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
    <!--------------------------------------------------sweet alert ---------------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

    <!--------------------------------------------------bootstrap js link----------------------------------------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <script>
        var ctx = document.getElementById('myChart1').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: <?php echo json_encode($name);?> ,
                datasets : [{
                    label: 'Office Use',
                    backgroundColor: '#2962ff',
                    borderColor:'#2962ff',
                    borderWidth: 1,
                    pointBorderWidth: 1,
                    data: <?php echo json_encode($quan);?>
                }, {
                    label: 'Lab Use',
                    backgroundColor: '#82b1ff',
                    borderColor:'#82b1ff',
                    borderWidth: 1,
                    pointBorderWidth: 1,
                    data: <?php echo json_encode($quan2);?>
                }, ]
            },

            // Configuration options go here
            options: {}
        });
    </script>

    <script>
        var ctx = document.getElementById('myChart2').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: <?php echo json_encode($name);?> ,
                datasets : [{
                    label: 'Office Use',
                    backgroundColor: '#6200ea',
                    borderColor: '#6200ea',
                    borderWidth: 1,
                    pointBorderWidth: 1,
                    data: <?php echo json_encode($quan);?>
                }, {
                    label: 'Lab Use',
                    backgroundColor: '#b388ff',
                    borderColor: '#b388ff',
                    borderWidth: 1,
                    pointBorderWidth: 1,
                    data: <?php echo json_encode($quan2);?>
                }, ]
            },

            // Configuration options go here
            options: {}
        });
    </script>



    <script>
        //warning_red

        // $(document).ready(function () {
        //     showWarning();
        // });

        // function showWarning(){
        //     var x = 0

        //     if (x == 1) {
        //         $(".warning_red").css('display', 'flex');

        //         setTimeout(function () {
        //             $(".warning_red").fadeOut(1000);
        //         }, 5000);

        //         $("#close").click(function () {
        //             $(".warning_red").css('display', 'none');
        //         });


        //     } else {
        //         $(".warning_red").css('display', 'none');
        //     }
        // }


        // setInterval(function () {
        //     showWarning();
        // }, 100000);











        $(document).ready(function () {
            $(".welcome").css('display', 'flex');

            setTimeout(function () {
                $(".welcome").fadeOut(1000);
            }, 5000);

            $("#close").click(function () {
                $(".welcome").css('display', 'none');
            });
        });
    </script>


    <!------------------------------------------------------------- searching ----------------------------------------------->

    <script>
        $(document).ready(function () {
            $("#search").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <!------------------------------------------------------------- searching ----------------------------------------------->

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