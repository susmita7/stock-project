<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | college Admins</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/clg_admin.css">
    <link rel="stylesheet" type="text/css" href="css/main_dashboard.css">

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

            <!------------------------------------- admin profile ----------------------------->

            <div class="admin con_tabs">
                <img src="images/face.jpg" alt="aau.jpg">
                <h4>Welcome Priya</h4>
                <a href="super_Admin_profile.php">View Profile</a>
            </div>
            <!------------------------------------- side-tabs ----------------------------->

            <div class="tabs">
                <div class="con_tabs">
                    <a href="super_admin_dashboard_home.php" class="con_tabs_links"><i class="fas fa-home"></i>
                        Home</a>
                    <a href="faculty.php" class="con_tabs_links"><i class="fas fa-user-friends"></i> Faculties</a>
                    <a href="college.php" class="con_tabs_links"><i class="fas fa-book"></i>&nbsp Colleges</a>

                    <a href="clg_admin.php" class="con_tabs_links ac"><i class="fas fa-user"></i>&nbsp
                        Clg_admins</a>
                    <a href="#" class="con_tabs_links"><span class="counter_side_noti">
                            <p>2</p>
                        </span><i class="fas fa-bell"></i>&nbsp Notifications</a>
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

        <!------------------------------------- top nav ----------------------------->

        <div class="top_content">
            <div class="hamburger" onclick="side_menu_open()">
                <a><i class="fas fa-bars"></i></a>
            </div>
            <div class="top_nav">
                <div class="top_nav_heading">
                    <h3>Assam Agriculture University</h3>
                </div>

                <div class="top_nav_contents">
                    <!------------------------------------- clock ----------------------------->
                    <div class="clock">
                        <i class="fas fa-clock"></i>
                        <div id="time" onload="showTime()"></div>
                    </div>
                    <!------------------------------------- date ----------------------------->
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
                    <!-------------------------------------------- notification ----------------------------------->
                    <div class="noti">
                        <span class="counter">
                            <p>2</p>
                        </span>
                        <i class="fas fa-bell" class="noti_bell"></i>
                    </div>
                    <!-------------------------------------------- logout ----------------------------------->
                    <div class="logout">
                        <a href="#">Logout</a>
                    </div>


                </div>

            </div>

            <!------------------------------------- conteny div ----------------------------->

            <div class="content">
                <div class="college">
                    <div class="heading_add_btn">
                        <div class="icon_heading">
                            <i class="fas fa-user"></i>
                            <h1>College Admins of Assam Agriculture University</h1>
                        </div>
                        <div class="item_unit_btn">

                            <!-------------------------------------------- search-bar ----------------------------------->


                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>
                            <!-------------------------------------------- add-college btn ----------------------------------->


                            <a id="add_clg" onclick="overlay_add()" type="button">Add Admin</a>
                        </div>
                    </div>


                    <!-----------------------------------------------table ----------------------------------->



                    <div id="" class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                <th scope="col" class="align-middle">Profile</th>
                                    <th scope="col" class="align-middle">Admin's First Name</th>
                                    <th scope="col" class="align-middle">Admin's Last Name</th>
                                    <th scope="col" class="align-middle">Admin's Email</th>
                                    <th scope="col" class="align-middle">Admin's Ph.No</th>
                                    <th scope="col" class="align-middle">College Name</th>
                                    <th scope="col" colspan="2" class="align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <tr>
                                <td class="align-middle"><img class=" table_img" src="images/face.jpg"></td>
                                    <td class="align-middle"><?php echo "college" ?></td>
                                    <td class="align-middle"><?php echo "admin" ?></td>
                                    <td class="align-middle"><?php echo "clgadmin@gmail.com" ?></td>
                                    <td class="align-middle"><?php echo "123456789" ?></td>
                                    <td class="align-middle"><?php echo "statistics" ?></td>
                                    <td class="align-middle"><a id="up_clg" type="button" class="editbtn"
                                            onclick="overlay_update()">Update</a>
                                    </td>
                                    <td class="align-middle"><a id="del_ad" type="button">Delete</a></td>
                                </tr>

                                <tr>
                                <td class="align-middle"><img class=" table_img" src="images/face.jpg"></td>
                                    <td class="align-middle"><?php echo "college" ?></td>
                                    <td class="align-middle"><?php echo "admin" ?></td>
                                    <td class="align-middle"><?php echo "admin@gmail.com" ?></td>
                                    <td class="align-middle"><?php echo "903456789" ?></td>
                                    <td class="align-middle"><?php echo "statistics" ?></td>
                                    <td class="align-middle"><a id="up_clg" type="button" class="editbtn"
                                            onclick="overlay_update()">Update</a>
                                    </td>
                                    <td class="align-middle"><a id="del_ad" type="button">Delete</a></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>



                </div>


                <!------------------------------------- overlay-add ------------------------------->



                <div class="overlay_add" id="overlay-add">
                    <a id="cross" onclick="reverse_add()" type="button"><i class="fas fa-times-circle"></i></a>
                    <div class="add_clg_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Add College Admin</h1>
                        </div>

                        <div class="main_add_clg">

                            <!------------------------------------- form ----------------------------->

                            <form action="" method="POST">


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
                                <input type="password" class="form-control form-control-sm" id="password" required>


                                <p>Confirm Password</p>
                                <input type="password" class="form-control form-control-sm" id="con_password" required>


                                <p>College Name</p>
                                <select class="form-control form-control-sm" required id="clg_name_ad">
                                    <option value="" disabled selected>Select College</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                </select>


                                <div class="add_clg_btn"><input type="submit" value="Save"></div>
                            </form>

                        </div>
                    </div>
                </div>






                <!----------------------------------------- overlay-update ------------------------------------>



                <div class="overlay_update" id="overlay-update">
                    <a type="button" id="cross" onclick="reverse_update()"><i class="fas fa-times-circle"></i></a>

                    <div class="up_clg_ad_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Update College Admin</h1>

                        </div>
                        <div class="main_add_clg">

                            <!------------------------------------- form ----------------------------->
                            <form action="" method="POST" form="form2">
                                <div class="row">
                                    <div class="col">
                                        <p>First Name</p>
                                        <input type="text" class="form-control form-control-sm" id="first_name_up"
                                            required>
                                    </div>
                                    <div class="col">
                                        <p>Last Name</p>
                                        <input type="text" class="form-control form-control-sm" id="last_name_up"
                                            required>
                                    </div>
                                </div>

                                <p>Admin's Email</p>
                                <input type="email" class="form-control form-control-sm" id="email_up" required>

                                <p>college Name</p>

                                <select class="form-control form-control-sm" id="clg_name_up" required>
                                    <option value="" disabled selected>Select College</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                </select>

                                <div class="add_clg_btn"><input type="submit" value="Save changes"></div>

                            </form>

                        </div>
                    </div>



                </div>



            </div>
        </div>
    </div>


    <!--------------------------------------------------gsap link----------------------------------------------------------->

    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <!------------------------------------- js link ----------------------------->

    <script src="js/dashboard.js"></script>
    <script src="js/college_admin.js"></script>

    <!------------------------------------- sweet-alert ----------------------------->

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



    <!--------------------------------------------------bootstrap js link----------------------------------------------------------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <!-------------------------------------------------- searching --------------------------------------------->

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