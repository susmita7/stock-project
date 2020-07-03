<?php require "../config/config.php"; ?>
<?php
    session_start();
    if ($_SESSION['is_da_login']) {
        //keep user on this page
    }else{
        //redirect to login page
        header("Location: ../choose") ;
    }  
?>
<?php

    /*----------------------------- rec stock --------------------------------------*/
    
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


    /*--------------------------- non rec stock -------------------------------------*/

    $q = "SELECT * FROM non_recurring_stock_levels WHERE dept_id='".$_SESSION['dept_id']."'";

    $f  = mysqli_query($con,$q) or die("can not show data from database".mysqli_error($con));

    if (mysqli_num_rows($f)>0) {

        $nitem= [];
        $noffice= [];
        $nlab=[];

        while ($r=mysqli_fetch_assoc($f)) {
            extract($r);
            $nitem[]= $name.'('.$unit.')';
            /*
            if ($used_for=="office") {
                $noffice[]= $quantity;
                $nlab[]= 0;
            }else if ($used_for=="lab") {
                $nlab[]= $quantity;
                $noffice[]= 0;
            }
            */
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
    <title>Department Admin Dashboard | Stockpile</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">

    <!-------------------------------------------------- css link 
        ----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/media_dashboard.css">
    <!-------------------------------------------------- bootstrap css link 
        ----------------------------------------------------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <!-------------------------------------------------- font asesome link 
        ----------------------------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    
    <!-------------------------------------------------- google fonts link 
        ----------------------------------------------------------->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins:300&display=swap" rel="stylesheet">
</head>

<body onload="renderDate()">
    <div class="wrapper">
        
        <!------------------------------ side menu ----------------------------------------->
        <div class="side_menu" id="menu">
            <div class="side_menu_close_btn" onclick="side_menu_open()">
                <a><i class="fas fa-window-close"></i></a>
            </div>

            <!----------------------------------------------------profile
                ---------------------------------------------->
            <div id="info" class="admin con_tabs">
                <!------------ show profile pic and name
                ------------->
            </div>

            <!---------------------------------------------------- side manu tabs ------------------------------------>
            <div class="tabs">
                <div class="con_tabs">
                    <a href="home" class="con_tabs_links ac"><i class="fas fa-home"></i>
                        Dashboard</a>

                    <a href="expert_user" class="con_tabs_links"><i class="fas fa-user"></i>
                        Expert Users</a>
                    <a href="stock_groups" class="con_tabs_links"><i class="fas fa-object-group"></i>
                        Stock Groups</a>
                    <a href="stocks" class="con_tabs_links"><i class="fas fa-cubes"></i> Stock Details</a>
                    <a href="orders" class="con_tabs_links"><i class="fas fa-copy"></i> File Details</a>
                    <a href="notifications" class="con_tabs_links">
                        <div id="getcount">
                            <!---------- show notification count
                                ------------------>
                        </div>
                        <i class="fas fa-bell"></i> Notifications
                    </a>
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

        </div> <!------------ end of sidebar ----------------------->

        
        <!---------------------------------------------------top nav ---------------------------------------------->
        
        <div class="top_content">

            
            <div class="top_nav">
                
                <!---------------------------------------------------- heading ------------------------------------------>
                <div class="top_nav_heading">
                 <!-----------------------------------------side menu open close-------------------------------------->
                    <div class="hamburger" onclick="side_menu_open()">
                        <a><i class="fas fa-bars"></i></a>
                    </div>
                    <h3><?php echo $_SESSION['dept_name']; ?> Department</h3>
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

                    <!---------------------------- dropdown notification ------------------------>
                    
                    <div id="notify_records" class="noti">
                        <!-------------------------------- show notificatiions here
                            --------------------------------------->
                    </div>
                    
                    <!---------------------------------------------------- logout
                        ---------------------------------------------->
                    <div class="logout">
                        <a type="button" onclick="getLogout()">Logout</a>
                    </div>


                </div>

            </div>

            <!---------------------------------------------------- content div ---------------------------------------------->

            <div class="content">
              
                <!--------------------------------------------------- welcome admin popup ---------------------------------------------->

                <div class="welcome display">
                    <div class="user_icon">
                        <i class="fas fa-smile"></i>      
                    </div>

                    <div class="msg_body">
                        <h5>Hey, Department Admin</h5>
                        <p>You're finally here, have a look around!</p>

                    </div>
                    <div class="cancel_icon">
                        <i class="fas fa-times-circle" id="close"></i>
                    </div>
                </div>

                <!-------------------------------- overview --------------------------------------->
                <h1>Overview</h1>

                <!------------------------ Recurring stock details  
                    ------------------------------------>
                <div class="heading_recurring">
                    <div class="heading_search">
                        <div class="heading_icon">
                            <i class="fas fa-cubes"></i>
                            <h2>Recurring Stock Details</h2>
                        </div>
                    </div>

                    <!------------------------ chart for recurring stock details  
                    ------------------------------------>
                    <div class="recurring">
                        <div class="chart">
                            <canvas id="myChart1"></canvas>
                        </div>
                    </div>
                </div>
                <!--------------------- end of recurring stock details ------------------------->

                <!------------------------ Non-recurring stock details  
                    ------------------------------------>
                <div class="heading_non_recurring">

                    <div class="heading_search">
                        <div class="heading_icon">
                            <i class="fas fa-cubes"></i>
                            <h2>Non-Recurring Stock Details</h2>
                        </div>
                    </div>

                    <!------------------------ chart for non-recurring stock details  
                    ------------------------------------>
                    <div class="non_recurring">
                        <div class="chart">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>

                </div>
                <!------------------ end of non-recurring stock details --------------------->


                <div class="instruction">

                        <div class="ins_head">

                            <img src="images/Group 10.png" class="ins_pic">


                            <h5>Activities of Department Admin</h5>


                            

                            <p>You can add , edit & delete Expert User for the <?php echo $_SESSION["dept_name"] ;?>, who can manage department's stock records.</p>

                            <p>You can add , edit & delete stock groups which are require for  <?php echo $_SESSION["dept_name"] ;?>.</p>

                            <p>You can see file details which are uploaded by the expert user.</p>

                            <!---<p>You can edit , approve or deny the notifications which are sent by the Department Admins of the college of agriculture.</p>-->

                            <p>You can edit , verify or cancel the notifications received from the expert user.</p>


                            <p>Lastly , You can see your previous activities.</p>
                        </div>
                </div>


            </div>

        </div>
    </div>


    <!---------------------------------------------------- gsap link -------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>
    
    <!---------------------------------------------------- ajax link ---------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    
    <!---------------------------------------------------- js link ---------------------------------------------->
    <script src="js/dashboard.js"></script>
    
    <!-------------------------------------------------- sweet alert link ---------------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-------------------------------------------------- bootstrap js link ----------------------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <!-------------------------- chart js link ---------------------------------------->
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    
    <!-------------------------------------- recurring stock details chart
        ------------------------------------------>

    <script>
        var ctx = document.getElementById('myChart1').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: <?php echo json_encode($ritem);?> ,
                datasets : [{
                    label: 'Office Use',
                    backgroundColor: '#2962ff',
                    borderColor:'#2962ff',
                    borderWidth: 1,
                    pointBorderWidth: 1,
                    data: <?php echo json_encode($roffice);?>
                }, {
                    label: 'Lab Use',
                    backgroundColor: '#82b1ff',
                    borderColor:'#82b1ff',
                    borderWidth: 1,
                    pointBorderWidth: 1,
                    data: <?php echo json_encode($rlab);?>
                }, ]
            },

            // Configuration options go here
            options: {}
        });
    </script>


    <!---------------------------------------------- non-recurring stock details chart
        ----------------------------------------------->

    <script>
        var ctx = document.getElementById('myChart2').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: <?php echo json_encode($nitem);?> ,
                datasets : [{
                    label: 'Office Use',
                    backgroundColor: '#6200ea',
                    borderColor: '#6200ea',
                    borderWidth: 1,
                    pointBorderWidth: 1,
                    data: <?php echo json_encode($noffice);?>
                }, {
                    label: 'Lab Use',
                    backgroundColor: '#b388ff',
                    borderColor: '#b388ff',
                    borderWidth: 1,
                    pointBorderWidth: 1,
                    data: <?php echo json_encode($nlab);?>
                }, ]
            },

            // Configuration options go here
            options: {}
        });
    </script>

</body>

</html>