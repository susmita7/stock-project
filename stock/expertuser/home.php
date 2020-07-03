<?php require "../config/config.php"; ?>
<?php
    session_start();
    if ($_SESSION['is_eu_login']) {
        //keep user on this page
    }else{
        //redirect to login page
        header("Location: ../choose") ;
    }  
?>

<?php

    /*----------------------------- rec --------------------------------------*/
    
    //$query = "SELECT * FROM balance_stock_recurring WHERE dept_id='".$_SESSION['dept_id']."'";
    
    $query = "SELECT * FROM recurring_stock_levels WHERE dept_id='".$_SESSION['dept_id']."'";

    $fire  = mysqli_query($con,$query) or die("can not show data from database".mysqli_error($con));

    if (mysqli_num_rows($fire)>0) {

        $ritem= [];
        $roffice= [];
        $rlab=[];

        while ($row=mysqli_fetch_assoc($fire)) {
            extract($row);
            $ritem[]= $name.'('.$unit.')';
            
            $roffice[]= $row['office_quantity'];
            $rlab[]= $row['lab_quantity'];
        }
    }else{

        $pair=[''];
        $pair2=['No Items Available'];
        $pair3=[' '];
        $ritem=[$pair,$pair2,$pair3];
        $roffice=[0,0,0];
        $rlab=[0,0,0];
    }


    /*--------------------------- non rec -------------------------------------*/

    $q = "SELECT * FROM non_recurring_stock_levels WHERE dept_id='".$_SESSION['dept_id']."'";

    $f  = mysqli_query($con,$q) or die("can not show data from database".mysqli_error($con));

    if (mysqli_num_rows($f)>0) {

        $nitem= [];
        $noffice= [];
        $nlab=[];

        while ($r=mysqli_fetch_assoc($f)) {
            extract($r);
            $nitem[]= $name.'('.$unit.')';

            $noffice[]= $r['office_quantity'];
            $nlab[]= $r['lab_quantity'];
        }
    }else{

        $pair=[''];
        $pair2=['No Items Available'];
        $pair3=[' '];
        $nitem=[$pair,$pair2,$pair3];
        $noffice=[0,0,0];
        $nlab=[0,0,0];
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <title>Expert User Dashboard | Stockpile</title>

    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/main_dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
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
         <!-----------------------------------------side menu open close-------------------------------------->
            <div class="side_menu_close_btn" onclick="side_menu_open()">
                <a><i class="fas fa-window-close"></i></a>
            </div>

            <!---------------------------------- profile --------------------------------->
            
            <div id="info" class="admin con_tabs">
                <!------------ show profile pic and name
                ------------->
            </div>
    
            <!---------------------------------- tabs --------------------------------->
            <div class="tabs">
                <div class="con_tabs">
                    <a href="home" class="con_tabs_links ac"><i class="fas fa-home"></i> Dashboard</a>
                    <p type="button" class="accordion con_tabs_links"><i class="fas fa-layer-group"></i> Item & Unit</p>
                    <div class="panel">
                        <a href="stock_item">Stock Items</a>
                        <a href="stock_unit">Stock Units</a>
                    </div>

                    <p type="button" class="accordion con_tabs_links"><i class="fas fa-plus-square"></i> Add
                        Stock</p>
                    <div class="panel">
                        <a href="recurring_add">Recurring</a>
                        <a href="non_recurring_add">Non-Recurring</a>
                    </div>

                    <p type="button" class="accordion con_tabs_links"><i class="fas fa-minus-square"></i> Issue Stock</p>
                    <div class="panel">
                        <a href="recurring_issue">Recurring</a>
                        <a href="non_recurring_issue">Non-Recurring</a>
                    </div>

                    <a href="damage" class="con_tabs_links"><i class="fas fa-chain-broken"></i> Damage Stock</a>
                    
                    <a href="order" class="con_tabs_links"><i class="fas fa-copy"></i> Order & Files</a>

                    <a href="notifications" class="con_tabs_links">
                        <div id="getcount">
                            <!------------ show count ----------------->
                        </div>
                        <i class="fas fa-bell"></i> Notifications</a>
                    <a href="activity" class="con_tabs_links"><i class="fa fa-history" aria-hidden="true"></i> Activity Logs</a>
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
                    <h3><?php echo $_SESSION['dept_name']; ?> Department</h3>
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
                                <button class="number" id="00">00</button>
                                <button class="number" id="0">0</button>
                                <button class="operator" id=".">.</button>
                                <button class="operator" id="=">=</button>
                            </div>
                        </div>
                    </div>

                    <!-------------------------------------------notification ---------------------------------->
                    <div class="noti" id="notify_records">

                        <!----------- show drop down notifications here
                            ----------------------------->
                    </div>
                    
                    <!---------------------------------- logout --------------------------------->
                    <div class="logout">
                        <a type="button" onclick="getLogout()">Logout</a>
                    </div>

                </div>

            </div>
            
            <!---------------------------------- content div --------------------------------->
            <div class="content">

                  <!---------------------------------------- welcome admin
                    ------------------------------------>

                
                 <div class="welcome onload">
                    <div class="user_icon">
                        <i class="fas fa-smile"></i>
                    </div>

                    <div class="msg_body">
                        <h5>Hey, Expert User<h5>
                                <p>You're finally here, have a look around!<p>

                    </div>
                    <div class="cancel_icon">
                        <i class="fas fa-times-circle" id="close"></i>
                    </div>
                </div>
                

                <!------------------------------------------ overview 
                    --------------------------------------->

                <h1>Overview</h1>

                <!------------------------- starting of recurring div ------------------------->

                <div class="heading_recurring" id="rec_details">

                    <div class="heading_search">
                        <div class="heading_icon">
                            <i class="fas fa-cubes"></i>
                            <h2>Recurring Stock Details</h2>
                        </div>

                        <div class="search_bar">
                            <input type="text" placeholder="search" id="search" autocomplete="off">
                            <div id="s1" class="icon"> <i class="fas fa-search"></i></div>
                        </div>
                    </div>


                    <div class="recurring">

                        <!--------------------- rec details chart --------------------->
                        <div class="chart">
                            <canvas id="myChart1"></canvas>
                        </div>

                        <!------------------------ rec details table ----------------------------->
                        <div class="data" id="rec_table">
                            <!---------------- rec details table --------->
                        </div>
                    </div>
                </div>

                <!------------------------ end of reurring div ----------------------->

                <!------------------------- starting of non-recurring div ------------------------->

                <div class="heading_non_recurring" id="non_rec_details">

                    <div class="heading_search">
                        <div class="heading_icon">
                            <i class="fas fa-cubes"></i>
                            <h2>Non-Recurring Stock Details</h2>
                        </div>

                        <div class="search_bar">
                            <input type="text" placeholder="search" id="search2" autocomplete="off">
                            <div id="s2" class="icon"> <i class="fas fa-search"></i></div>
                        </div>
                    </div>

                    <div class="non_recurring">

                        <!------------------- non-rec details chart -------------------->

                        <div class="chart">
                            <canvas id="myChart2"></canvas>
                        </div>

                        <!--------------------- non-rec details table ------------------->

                        <div class="data" id="non_rec_table">
                            <!---------------- non-rec details table --------->
                        </div>

                    </div>
                </div>
                <!------------------ end of non-recurring details div -----------------> 



                <div class="instruction">

                    <div class="ins_head">

                        <img src="images/Group 10.png" class="ins_pic">


                        <h5>Activities of Expert User</h5>


                        

                        <p>You can add , edit & delete stock items which are require for <?php echo $_SESSION["dept_name"] ;?>.</p>

                        <p>You can add , edit & delete stock unit for items which you have already added.</p>

                        <p>You can add and issue recurring and non-recurring stocks of <?php echo $_SESSION["dept_name"] ;?>.</p>

                        <p>You can manage records of damage products.</p>

                        <p>You can send notification to department admin of <?php echo $_SESSION["dept_name"] ;?>.</p>

                        <!---<p>You can edit , approve or deny the notifications which are sent by the Department Admins of the college of agriculture.</p>-->

                        <p>You can read notifications which you have received from department admin and college admin.</p>


                        <p>Lastly , You can see your previous activities.</p>
                    </div>
                </div>





            </div>
        </div>
    </div>


    <!--------------------------------------------------gsap link----------------------------------------------------------->

    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/main_dashboard.js"></script>
    <script src="js/calculator.js"></script>






   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <!--------------------------------------------------bootstrap js link----------------------------------------------------------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->


         
    <!--------------------------------------------------- chart js link
        ------------------------------------------------>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!--------------------------------------------------- Recurring details chart 
        ------------------------------------------->

    <script>
        var ctx = document.getElementById('myChart1').getContext('2d');
        var chart = new Chart(ctx, {
            
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: <?php echo json_encode($ritem);?> ,
                datasets : [{
                    label: 'Office Use',
                    backgroundColor: 'rgba(2,136,209,0.4)',
                    borderColor: 'rgb(2,136,209)',
                    borderWidth: 1,
                    pointBorderWidth: 1,
                    data: <?php echo json_encode($roffice);?>
                }, 
                {
                     label: 'Lab Use',
                     backgroundColor: 'rgb(1, 87, 155,0.4)',
                     borderColor: 'rgb(1, 87, 155)',
                     borderWidth: 1,
                     pointBorderWidth: 1,
                     data: <?php echo json_encode($rlab);?>
                }, 
                ]
            },

            // Configuration options go here
            options: {}
        });
    </script>


    <!----------------------------------------------- Non-recurring details chart
      ---------------------------------------------------> 

    <script>
        var ctx = document.getElementById('myChart2').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: <?php echo json_encode($nitem);?> ,
                datasets : [{
                    label: 'Office Use',
                    backgroundColor: 'rgba(2,136,209,0.4)',
                    borderColor: 'rgb(2,136,209)',
                    borderWidth: 1,
                    pointBorderWidth: 1,
                    data: <?php echo json_encode($noffice); ?>
                }, {
                    label: 'Lab Use',
                    backgroundColor: 'rgb(1, 87, 155,0.4)',
                    borderColor: 'rgb(1, 87, 155)',
                    borderWidth: 1,
                    pointBorderWidth: 1,
                    data: <?php echo json_encode($nlab); ?>
                }, ]
            },

            // Configuration options go here
            options: {}
        });
    </script>


    <!----------------------------------------------- welcome EU
        -------------------------------------------------->


    <script type="text/javascript">
        /*
        $(document).ready(function () {
            $(".welcome").css('display', 'flex');

            setTimeout(function () {
                $(".welcome").fadeOut(1000);
            }, 5000);

            $("#close").click(function () {
                $(".welcome").css('display', 'none');
            });
        });
        */
    </script>



    <!---------------------------------------------------- Recurring details table 
        --------------------------------------->
    <script type="text/javascript">
        
        $(document).ready(function(){
            showRectables();
        });
        
        function showRectables() {
            var readrec = "readrec";
            $.ajax({
                url:"action_home.php",
                type:"post",
                data:{ readrec:readrec },
                success:function(data,status){
                    $('#rec_table').html(data);
                }
            });
        }
    </script>

    <!------------------------------------------------------- Non-recurring details table 
        --------------------------------------->
    <script type="text/javascript">
        
        $(document).ready(function(){
            showNonrectables();
        });
        
        function showNonrectables() {
            var readnonrec = "readnonrec";
            $.ajax({
                url:"action_home.php",
                type:"post",
                data:{ readnonrec:readnonrec },
                success:function(data,status){
                    $('#non_rec_table').html(data);
                }
            });
        }
    </script>



    <!------------------------------------------------------ Recurring table searching ----------------------------------------------->

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

    <!------------------------------------------------------ Recurring table searching ----------------------------------------------->

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


    <!---------------------------- clear the search field on icon click
        --------------------------------->

    <script type="text/javascript">


    $(document).ready(function(){
        $("#s1").click(function(){
            $("#search").val("");
            showRectables();
        });
    });

    $(document).ready(function(){
        $("#s2").click(function(){
            $("#search2").val("");
            showNonrectables();
        });
    });
    </script>

</body>

</html>