<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <title>Dashboard | Activities</title>

    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/activity.css">
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
            <!---------------------------------profile-------------------------------------->
            <div class="admin con_tabs">
                <img src="images/user1.png" alt="aau.jpg">
                <h4>Welcome Priya</h4>
                <a href="EU_profile.php">View Profile</a>
            </div>
            <!---------------------------------tabs------------------------------------>
            <div class="tabs">
                <div class="con_tabs">
                    <a href="EU_dashboard_home.php" class="con_tabs_links"><i class="fas fa-home"></i>
                        Dashboard</a>
                    <p class="accordion con_tabs_links"><i class="fas fa-layer-group"></i> Item & Unit</p>
                    <div class="panel">
                        <a href="stock_item.php">Stock Items</a>
                        <a href="stock_unit.php">Stock Unit</a>
                    </div>

                    <p class="accordion con_tabs_links"><i class="fas fa-plus-square"></i> &nbspAdd
                        Stock</p>
                    <div class="panel">
                        <a href="recurring_add.php">Recurring</a>
                        <a href="non_recurring_add.php">Non-Recurring</a>
                    </div>

                    <p class="accordion con_tabs_links"><i class="fas fa-minus-square"></i> Issue Stock</p>
                    <div class="panel">
                        <a href="recurring_issue.php">Recurring</a>
                        <a href="non_recurring_issue.php">Non-Recurring</a>
                    </div>

                    <a href="damage.php" class="con_tabs_links"><i class="fas fa-toolbox"></i>
                        Repair</a>
                    <a href="order.php" class="con_tabs_links"><i class="fas fa-copy"></i> Orders</a>
                    <a href="notification.php" class="con_tabs_links"><span class="counter_side_noti">
                            <p>2</p>
                        </span><i class="fas fa-bell"></i> Notifications</a>
                    <a href="activity.php" class="con_tabs_links ac"><i class="fas fa-history"></i> Activity log</a>

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

            <!----------------------------------heading-------------------------------------->
            <div class="top_nav">
                <div class="top_nav_heading">
                    <div class="hamburger" onclick="side_menu_open()">
                        <a><i class="fas fa-bars"></i></a>
                    </div>
                    <h3>Agriculture Statistics</h3>
                </div>

                <div class="top_nav_contents">
                    <!----------------------------------clock---------------------------------------->
                    <div class="clock">
                        <i class="fas fa-clock"></i>
                        <div id="time" onload="showTime()"></div>
                    </div>
                    <!----------------------------------date--------------------------------------->
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
                    <!---------------------------------calculator---------------------------------------->
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
                                <button class="number" id="empty">00</button>
                                <button class="number" id="0">0</button>
                                <button class="operator" id=".">.</button>
                                <button class="operator" id="=">=</button>
                            </div>
                        </div>

                    </div>
                    <!----------------------------------notification--------------------------------------->
                    <div class="noti">
                        <span class="counter">
                            <p>2</p>
                        </span>
                        <i class="fas fa-bell"></i>
                    </div>
                    <!----------------------------------logout---------------------------------------->
                    <div class="logout">
                        <a href="#">Logout</a>
                    </div>

                </div>

            </div>
            <!---------------------------------------------content div--------------------------------------->
            <div class="content">

                <div class="college">
                    <div class="heading_add_btn">
                        <div class="icon_heading">
                            <i class="fas fa-history"></i>
                            <h1>All Activities</h1>
                        </div>
                        <div class="item_unit_btn">
                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>
                            <a id="add_clg" type="button">Clear all</a>
                        </div>
                    </div>


                </div>

                <!--------------------------no activity div------------------------>


                <div class="base_ac" id="mydiv">
                    <h5>No activities available</h5>
                </div>


                <!--------------------------activity div------------------------>

                <div class="base_ac" id="mydiv">
                    <div class="suc_icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="ac">
                        <p>Your profile successfully updated.</p>
                        <div class="time_date">

                            <h4><i class="far fa-clock"></i> 26-04-2020 , 12:46 PM</h4>
                        </div>

                    </div>
                    <div class="ac_del">
                        <a id="del" type="button" onclick="overlay_delete()">Clear</a>
                    </div>
                </div>

                <div class="base_ac" id="mydiv">
                    <div class="suc_icon">
                        <i class="fas fa-user-lock"></i>
                    </div>
                    <div class="ac">
                        <p>College admin for College of agricluture successfully added.</p>
                        <div class="time_date">

                            <h4><i class="far fa-clock"></i> 26-04-2020 , 12:46 PM</h4>
                        </div>

                    </div>
                    <div class="ac_del">
                        <a id="del" type="button" onclick="overlay_delete()">Clear</a>
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
                                    <a type="button" class="cancel" onclick="reverse_delete()">Cancel</a>
                                    <a type="button" class="okay">Yes</a>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <!--------------------------------------------------gsap link----------------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>
    <!----------------------------------------------------ajax link------------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-------------------------------------------------js link ------------------------------------------------->
    <script src="js/dashboard.js"></script>
    <script src="js/calculator.js"></script>
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

    <script>
        $(document).ready(function () {
            $(".fa-search").click(function () {
                $(".icon").toggleClass("show_search");
                $("input[type='text']").toggleClass("show_search")
            });
        });

        // overlay for delete in-out


        function overlay_delete() {
            let over = document.getElementById("overlay-delete");
            gsap.to(over, {
                duration: .5,
                opacity: 1,
                display: 'block'
            });
        }

        function reverse_delete() {
            let cross = document.getElementById("overlay-delete");
            gsap.to(cross, {
                duration: .5,
                opacity: 0,
                display: 'none'
            });

        }
    </script>
</body>

</html>