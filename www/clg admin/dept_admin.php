<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dsahboard | Department admin</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">

    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/dept_admin.css">
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

                    <a href="dept_admin.php" class="con_tabs_links ac"><i class="fas fa-user"></i>
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

            <!---------------------------------------college name heading ---------------------------------->
            <div class="top_nav">
                <div class="top_nav_heading">
                    <div class="hamburger">
                        <a><i class="fas fa-bars"  onclick="side_menu_open()"></i></a>
                    </div>
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
                    <!--------------------------------------------logout ---------------------------------->
                    <div class="logout">
                        <a href="#">Logout</a>
                    </div>

                </div>

            </div>



            <div class="content">

                <div class="college">
                    <div class="heading_add_btn">
                        <div class="icon_heading">
                            <i class="fas fa-user"></i>
                            <h1>Department Admins of College of Agriculture</h1>
                        </div>

                        <div class="item_unit_btn">
                            <!-------------------------------------------- search bar---------------------------------->
                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>
                            <!---------------------------------------add department admin buuton ----------------------------->
                            <a type="button" id="add_clg" onclick="overlay_add()">Add admin</a>
                        </div>
                    </div>
                    <!--------------------------------------------table---------------------------------->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="align-middle">Sl no.</th>
                                    <th scope="col" class="align-middle">Avatar</th>
                                    <th scope="col" class="align-middle">Admin's First Name</th>
                                    <th scope="col" class="align-middle">Admin's Last Name</th>
                                    <th scope="col" class="align-middle">Dept Admin Email</th>
                                    <th scope="col" class="align-middle">Dept Admin Ph.No</th>
                                    <th scope="col" class="align-middle">Department Name</th>
                                    <th scope="col" colspan="2" class="align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <tr>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle"><img class=" table_img" src="images/face.jpg"></td>
                                    <td class="align-middle"><?php echo "college admin" ?></td>
                                    <td class="align-middle"><?php echo "college admin" ?></td>
                                    <td class="align-middle"><?php echo "clgadmin@gmail.com" ?></td>
                                    <td class="align-middle"><?php echo "123456789" ?></td>
                                    <td class="align-middle"><?php echo "statistics" ?></td>
                                    <!----------------------------------------update buuton---------------------------------->
                                    <td class="align-middle"><a id="up_clg" class="editbtn" onclick="overlay_update()"
                                            type="button">Update</a>
                                    </td>
                                    <!-----------------------------------------delete button---------------------------------->
                                    <td class="align-middle"><a id="del_ad" type="button"
                                            onclick="overlay_delete()">Delete</a></td>
                                </tr>

                                <tr>
                                    <td class="align-middle">2</td>
                                    <td class="align-middle"><img class=" table_img" src="images/face.jpg"></td>
                                    <td class="align-middle"><?php echo "college admin" ?></td>
                                    <td class="align-middle"><?php echo "super admin" ?></td>
                                    <td class="align-middle"><?php echo "clgadmin@gmail.com" ?></td>
                                    <td class="align-middle"><?php echo "123456789" ?></td>
                                    <td class="align-middle"><?php echo "statistics" ?></td>
                                    <!----------------------------------------update buuton---------------------------------->
                                    <td class="align-middle"><a type="button" id="up_clg" class="editbtn"
                                            onclick="overlay_update()">Update</a>
                                    </td>
                                    <!-----------------------------------------delete button---------------------------------->
                                    <td class="align-middle"><a type="button" id="del_ad"
                                            onclick="overlay_delete()">Delete</a></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>



                </div>


                <!-------------------------------------------overlay add---------------------------------->

                <div class="overlay_add" id="overlay-add">
                    <a id="cross" onclick="reverse_add()"><i class="fas fa-times-circle"></i></a>
                    <div class="add_clg_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Add Department Admin</h1>
                        </div>
                        <!-------------------------------------------form---------------------------------->
                        <div class="main_add_clg">
                            <form action="" method="POST" id="form1">


                                <div class="row">
                                    <div class="col">
                                        <p>First Name</p>
                                        <input type="text" class="form-control form-control-sm" id="first_name_add"
                                            required>
                                    </div>
                                    <div class="col">
                                        <p>Last Name</p>
                                        <input type="text" class="form-control form-control-sm" id="last_name_add"
                                            required>
                                    </div>
                                </div>

                                <p>Admin's Email</p>
                                <input type="email" class="form-control form-control-sm" id="email_add" required>


                                <p>Admin's Password</p>
                                <input type="password" class="form-control form-control-sm" id="admin_pass" required>


                                <p>Confirm Password</p>
                                <input type="password" class="form-control form-control-sm" id="con_pass" required>


                                <p>Department Name</p>
                                <select class="form-control form-control-sm" required>
                                    <option value="" disabled selected>Select College</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                </select>


                                <div class="add_clg_btn"><input type="submit" value="Save"></div>

                            </form>

                        </div>
                    </div>
                </div>






                <!-----------------------------------------overlay update---------------------------------->



                <div class="overlay_update" id="overlay-update">
                    <a id="cross" onclick="reverse_update()"><i class="fas fa-times-circle"></i></a>

                    <div class="up_clg_ad_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Update Department Admin</h1>

                        </div>
                        <!----------------------------------------form---------------------------------->
                        <div class="main_add_clg">
                            <form action="" method="POST" id="form2">
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


                                <p>Admin's Email</p>
                                <input type="text" class="form-control form-control-sm" id="email_up">

                                <p>Department Name</p>

                                <select class="form-control form-control-sm" required>
                                    <option value="" disabled selected>Select College</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                </select>
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
                                    <a type="button" class="cancel" onclick="reverse_delete()">Cancel</a>
                                    <a type="button" class="okay">Yes</a>
                                </div>

                            </form>
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
        <script src="js/dept_admin.js"></script>
        <script src="js/dashboard.js"></script>
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