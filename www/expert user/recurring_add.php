<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <title>Dashboard | Reccuring Stock</title>



    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/recurring_add.css">
    <link rel="stylesheet" type="text/css" href="css/main_dashboard.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/Mq_dashboard.css"> -->

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
            <!---------------------------------------profile---------------------------------->
            <div class="admin con_tabs">
                <img src="images/user1.png" alt="aau.jpg">
                <h4>Welcome Priya</h4>
                <a href="EU_profile.php">View Profile</a>
            </div>
            <!---------------------------------------tabs---------------------------------->
            <div class="tabs">
                <div class="con_tabs">
                    <a href="EU_dashboard_home.php" class="con_tabs_links"><i class="fas fa-home"></i>
                        Dashboard</a>
                    <a href="#" class="accordion con_tabs_links"><i class="fas fa-layer-group"></i> Item & Unit</a>
                    <div class="panel">
                        <a href="stock_item.php">Stock Items</a>
                        <a href="stock_unit.php">Stock Unit</a>
                    </div>

                    <a href="#" class="accordion con_tabs_links ac"><i class="fas fa-plus-square"></i> &nbspAdd
                        Stock</a>
                    <div class="panel">
                        <a href="recurring_add.php">Recurring</a>
                        <a href="non_recurring_add.php">Non-Recurring</a>
                    </div>

                    <a href="#" class="accordion con_tabs_links"><i class="fas fa-minus-square"></i> Issue Stock</a>
                    <div class="panel">
                        <a href="recurring_issue.php">Recurring</a>
                        <a href="non_recurring_issue.php">Non-Recurring</a>
                    </div>

                    <a href="#" class="con_tabs_links"><i class="fas fa-toolbox"></i>
                        Repair</a>
                    <a href="#" class="con_tabs_links"><span class="counter_side_noti">
                            <p>2</p>
                        </span><i class="fas fa-bell"></i> Notifications</a>

                    <a href="#" class="con_tabs_links"><i class="fas fa-copy"></i> Orders</a>
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
        <!------------------------------------top contents---------------------------------->
        <div class="top_content">
            <div class="hamburger" onclick="side_menu_open()">
                <a><i class="fas fa-bars"></i></a>
            </div>
            <div class="top_nav">
                <div class="top_nav_heading">
                    <h3>Agriculture Statistics</h3>
                </div>

                <div class="top_nav_contents">
                    <!-------------------------------------clock---------------------------------->
                    <div class="clock">
                        <i class="fas fa-clock"></i>
                        <div id="time" onload="showTime()"></div>
                    </div>
                    <!---------------------------------------date---------------------------------->
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
                    <!--------------------------------------calculator---------------------------------->
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
                    <!---------------------------------------notification---------------------------------->
                    <div class="noti">
                        <span class="counter">
                            <p>2</p>
                        </span>
                        <i class="fas fa-bell"></i>
                    </div>
                    <!---------------------------------------logout---------------------------------->
                    <div class="logout">
                        <a href="#">Logout</a>
                    </div>

                </div>

            </div>
            <!---------------------------------------content div---------------------------------->
            <div class="content">

                <div class="college">
                    <div class="heading_btn">
                        <div class="icon_heading">
                            <i class="fas fa-cubes"></i>
                            <h1>Stock Register For Reccurring Stocks</h1>
                        </div>
                        <div class="item_unit_btn">
                            <!--------------------------------------search bar---------------------------------->
                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>
                            <!---------------------------------------profile---------------------------------->
                            <a id="add_item" type="button" onclick="overlay_add()">Add Stocks</a>
                            <a id="add_unit" type="button" href="recurring_issue.php">Issue Stock</a>
                        </div>
                    </div>
                    <!---------------------------------------table---------------------------------->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="align-middle">Sl No.</th>
                                    <th scope="col" class="align-middle">Date</th>
                                    <th scope="col" class="align-middle">Usage</th>
                                    <th scope="col" class="align-middle">Particular name</th>
                                    <th scope="col" class="align-middle">Particular type</th>
                                    <th scope="col" class="align-middle">Previous stock</th>
                                    <th scope="col" class="align-middle">Quantity</th>
                                    <th scope="col" class="align-middle">Unit</th>
                                    <th scope="col" class="align-middle">Rate</th>
                                    <th scope="col" class="align-middle">Amount</th>
                                    <th scope="col" class="align-middle">Issued Quantity</th>
                                    <th scope="col" class="align-middle">Balance stock</th>
                                    <th scope="col" class="align-middle">Remarks</th>
                                    <th scope="col" class="align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <tr>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">2020-03-20 20:07:53</td>
                                    <td class="align-middle">Office</td>
                                    <td class="align-middle">Paper</td>
                                    <td class="align-middle">Stationary</td>
                                    <td class="align-middle">0</td>
                                    <td class="align-middle">10</td>
                                    <td class="align-middle">ream</td>
                                    <td class="align-middle">100</td>
                                    <td class="align-middle">1000</td>
                                    <td class="align-middle">0</td>
                                    <td class="align-middle">10</td>
                                    <td class="align-middle">for office use only</td>
                                    <td class="align-middle"><a id="del_ad" href="#">Delete</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>

                </div>

                <!---------------------------------------overlay add---------------------------------->


                <div class="overlay_add" id="overlay-add">
                    <a id="cross" onclick="reverse_add()" type="button"><i class="fas fa-times-circle"></i></a>
                    <div class="add_clg_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Add Stocks</h1>
                        </div>

                        <div class="main_add_clg">
                            <form action="" method="POST">

                                <div class="row">
                                    <div class="col">
                                        <p>Usage</p>
                                        <select class="form-control form-control-sm" required>
                                            <option>select type</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <p>Stock group</p>
                                        <select class="form-control form-control-sm" required>
                                            <option>select type</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col">
                                        <p>Particular name</p>
                                        <select class="form-control form-control-sm" required>
                                            <option>select type</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <p>Quantity</p>
                                        <input type="text" class="form-control form-control-sm" required>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col">
                                        <p>Unit</p>
                                        <select class="form-control form-control-sm" required>
                                            <option>select type</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <p>Rate</p>
                                        <input type="text" class="form-control form-control-sm" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <p>GST</p>
                                        <input type="number" class="form-control form-control-sm">
                                    </div>
                                    <div class="col">
                                        <p>Total amount</p>
                                        <input type="number" class="form-control form-control-sm" readonly>
                                    </div>
                                </div>
                                <p>Remarks</p>
                                <input type="text" class="form-control form-control-sm">


                                <div class="add_clg_btn"><input type="submit" value="Save"></div>
                            </form>

                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>


    <!--------------------------------------------------gsap link----------------------------------------------------------->

    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>
    <!---------------------------------------------------------ajax link----------------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-----------------------------------------------------------------js links---------------------------------------------->
    <script src="js/dashboard.js"></script>
    <script src="js/calculator.js"></script>
    <script src="js/recurring_add.js"></script>
    <!---------------------------------------------------- sweet-alert link ------------------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--------------------------------------------------bootstrap js link---------------------------------------------------->
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
</body>

</html>