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
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <title>Dashboard | Home</title>
    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/EU_dashboard_home.css">
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
            <!---------------------------------- profile --------------------------------->
            <div class="admin con_tabs">
                <img src="images/user1.png" alt="aau.jpg">
                <h4>Welcome Priya</h4>
                <a href="EU_profile.php">View Profile</a>
            </div>
            <!---------------------------------- tabs --------------------------------->
            <div class="tabs">
                <div class="con_tabs">
                    <a href="EU_dashboard_home.php" class="con_tabs_links ac"><i class="fas fa-home"></i>
                        Dashboard</a>
                    <p class="accordion con_link"><i class="fas fa-layer-group"></i> Item & Unit</p>
                    <div class="panel">
                        <a href="stock_item.php">Stock Items</a>
                        <a href="stock_unit.php">Stock Unit</a>
                    </div>

                    <p class="accordion con_link"><i class="fas fa-plus-square"></i> &nbspAdd Stock</p>
                    <div class="panel">
                        <a href="recurring_add.php">Recurring</a>
                        <a href="non_recurring_add.php">Non-Recurring</a>
                    </div>

                    <p class="accordion con_link"><i class="fas fa-minus-square"></i> Issue Stock</p>
                    <div class="panel">
                        <a href="recurring_issue.php">Recurring</a>
                        <a href="non_recurring_issue.php">Non-Recurring</a>
                    </div>

                    <a href="damage.php" class="con_tabs_links"><i class="fas fa-toolbox"></i>
                        Repair</a>
                    <a href="order.php" class="con_tabs_links"><i class="fas fa-copy"></i> Order & file</a>
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

        <div class="top_content">
            <!---------------------------------- top_nav --------------------------------->
            <div class="top_nav">
                <div class="top_nav_heading">
                    <div class="hamburger" onclick="side_menu_open()">
                      <a><i class="fas fa-bars"></i></a>
                    </div>
                    <h3>Agriculture Statistics</h3>
                </div>

                <div class="top_nav_contents">
                    <!---------------------------------- clock --------------------------------->
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
                    <!---------------------------------- calculator --------------------------------->
                    <div class="cal">
                        <i class="fas fa-calculator" onclick="show_calculator()"></i>

                        <div class="calculator" id="calculator">
                            <div id="result">
                                <div id="history">
                                    <p id="history-value"></p>
                                </div>
                                <div id="output">
                                    <p id="output-value"></p>
                                </div>
                            </div>
                            <div id="keyboard">
                                <button class="operator" id="clear">C</button>
                                <button class="operator" id="backspace">CE</button>
                                <button class="operator" id="%">%</button>
                                <button class="operator" id="/">&#247;</button>
                                <button class="number" id="7">7</button>
                                <button class="number" id="8">8</button>
                                <button class="number" id="9">9</button>
                                <button class="operator" id="*">&times;</button>
                                <button class="number" id="4">4</button>
                                <button class="number" id="5">5</button>
                                <button class="number" id="6">6</button>
                                <button class="operator" id="-">-</button>
                                <button class="number" id="1">1</button>
                                <button class="number" id="2">2</button>
                                <button class="number" id="3">3</button>
                                <button class="operator" id="+">+</button>
                                <button class="empty" id="empty"></button>
                                <button class="number" id="0">0</button>
                                <button class="operator" id=".">.</button>
                                <button class="operator" id="=">=</button>
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
                    <!---------------------------------- logout --------------------------------->
                    <div class="logout">
                        <a href="#">Logout</a>
                    </div>


                </div>

            </div>
            <!---------------------------------- content div --------------------------------->
            <div class="content">


            <!----------------------------------------------------welcome ---------------------------------------------->

            <div class="welcome onload">
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


                <h1>Overview</h1>

                <div class="heading_recurring">

                    <div class="heading_search">
                        <div class="heading_icon">
                            <i class="fas fa-cubes"></i>
                            <h2>Recurring Stock Details</h2>
                        </div>

                        <div class="search_bar">
                            <input type="text" placeholder="search" id="search">
                            <div class="icon"> <i class="fas fa-search"></i></div>
                        </div>
                    </div>


                    <div class="recurring">
                        <div class="chart">
                            <canvas id="myChart1"></canvas>
                        </div>

                        <div class="data">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="align-middle" scope="col">Sl No.</th>
                                            <th class="align-middle" scope="col">Name</th>
                                            <th class="align-middle" scope="col">Unit</th>
                                            <th class="align-middle" scope="col">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">

                                        <tr>
                                            <td class="align-middle">1</td>
                                            <td class="align-middle">Pen</td>
                                            <td class="align-middle">10</td>
                                            <td class="align-middle">Packet</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">1</td>
                                            <td class="align-middle">Pen</td>
                                            <td class="align-middle">10</td>
                                            <td class="align-middle">Packet</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">1</td>
                                            <td class="align-middle">Pen</td>
                                            <td class="align-middle">10</td>
                                            <td class="align-middle">Packet</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">1</td>
                                            <td class="align-middle">Pen</td>
                                            <td class="align-middle">10</td>
                                            <td class="align-middle">Packet</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">1</td>
                                            <td class="align-middle">Pen</td>
                                            <td class="align-middle">10</td>
                                            <td class="align-middle">Packet</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">1</td>
                                            <td class="align-middle">Pen</td>
                                            <td class="align-middle">10</td>
                                            <td class="align-middle">Packet</td>
                                        </tr>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="heading_non_recurring">

                    <div class="heading_search">
                        <div class="heading_icon">
                            <i class="fas fa-cubes"></i>
                            <h2>Non-Recurring Stock Details</h2>
                        </div>

                        <div class="search_bar">
                            <input type="text" placeholder="search" id="search2">
                            <div class="icon"> <i class="fas fa-search"></i></div>
                        </div>
                    </div>
                    <div class="non_recurring">

                        <div class="chart">
                            <canvas id="myChart2"></canvas>
                        </div>

                        <div class="data">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="align-middle" scope="col">Sl No.</th>
                                            <th class="align-middle" scope="col">Name</th>
                                            <th class="align-middle" scope="col">Unit</th>
                                            <th class="align-middle" scope="col">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable2">

                                        <tr>
                                            <td class="align-middle">1</td>
                                            <td class="align-middle">chair</td>
                                            <td class="align-middle">10</td>
                                            <td class="align-middle">Packet</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">1</td>
                                            <td class="align-middle">Pen</td>
                                            <td class="align-middle">10</td>
                                            <td class="align-middle">Packet</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">1</td>
                                            <td class="align-middle">Pen</td>
                                            <td class="align-middle">10</td>
                                            <td class="align-middle">Packet</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">1</td>
                                            <td class="align-middle">Pen</td>
                                            <td class="align-middle">10</td>
                                            <td class="align-middle">Packet</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">1</td>
                                            <td class="align-middle">Pen</td>
                                            <td class="align-middle">10</td>
                                            <td class="align-middle">Packet</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">1</td>
                                            <td class="align-middle">Pen</td>
                                            <td class="align-middle">10</td>
                                            <td class="align-middle">Packet</td>
                                        </tr>


                                    </tbody>
                                </table>

                            </div>
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
    <script src="js/calculator.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <script>
        var ctx = document.getElementById('myChart1').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: <?php echo json_encode($name);?> ,
                datasets : [{
                    label: 'Office Use',
                    backgroundColor: 'rgba(2,136,209,0.4)',
                    borderColor: 'rgb(2,136,209)',
                    borderWidth: 1,
                    pointBorderWidth: 1,
                    data: <?php echo json_encode($quan);?>
                }, {
                    label: 'Lab Use',
                    backgroundColor: 'rgb(1, 87, 155,0.4)',
                    borderColor: 'rgb(1, 87, 155)',
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
            type: 'line',

            // The data for our dataset
            data: {
                labels: <?php echo json_encode($name);?> ,
                datasets : [{
                    label: 'Office Use',
                    backgroundColor: 'rgba(2,136,209,0.4)',
                    borderColor: 'rgb(2,136,209)',
                    borderWidth: 1,
                    pointBorderWidth: 1,
                    data: <?php echo json_encode($quan); ?>
                }, {
                    label: 'Lab Use',
                    backgroundColor: 'rgb(1, 87, 155,0.4)',
                    borderColor: 'rgb(1, 87, 155)',
                    borderWidth: 1,
                    pointBorderWidth: 1,
                    data: <?php echo json_encode($quan2); ?>
                }, ]
            },

            // Configuration options go here
            options: {}
        });
    </script>

    <!--------------------------------------------------bootstrap js link----------------------------------------------------------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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


</body>

</html>