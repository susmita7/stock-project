<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>college admin dashboard</title>
    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/Mq_dashboard.css">

    <!--------------------------------------------------bootstrap css link----------------------------------------------------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!--------------------------------------------------font asesome link----------------------------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <!--------------------------------------------------google fonts link----------------------------------------------------------->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins:300&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="side_menu">
            <div class="side_menu_close_btn" onclick = "side_menu_close()">
                <button>close</button>
            </div>
            <div class="admin con_tabs">
                <img src="AAU-jorhat.jpg" alt="aau.jpg">
                <h4>Welcome Priya Subhalaxmi Hazrika</h4>
                <a href="#" data-target="super_admin_profile">View Profile</a>
            </div>
            <div class="tabs">
                <div class="con_tabs">
                    <a href="#"  data-target="colleges" class="con_tabs_links"><i class="fas fa-home"></i> Colleges</a>

                    <a href="#" data-target="clg_admin" class="con_tabs_links"><i class="fas fa-user"></i>
                        Clg_admins</a>
                    <a href="#" class="accordion con_tabs_links"><i class="fas fa-bell"></i> Notifications</a>
                    <div class="panel">
                        <a href="#">View</a>
                        <a href="#">Add</a>
                        <a href="#">C</a>
                    </div>
                    <a href="#" class="con_tabs_links"><i class="fas fa-building"></i> Establishment</a>
                </div>
            </div>
            <div class="side_menu_footer">
                <img src="images/stockpileLogo.png">
                <h5>copyright&copy; STOCKPILE,2020</h5>
            </div>

        </div>
        <div class="top_content">
            <div class="hamburger" onclick="side_menu_open()">
                <button>open</button>
            </div>
            <div class="top_nav">
                <h3>Assam Agriculture University</h3>
                <div class="search_bar">
                    <input type="text" placeholder="Search">
                    <i class="fas fa-search"></i>
                </div>
                <div class="logout">
                    <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
            <div class="content">
                <?php include('super_admin_profile.php'); ?>
            </div>
        </div>
    </div>

    <script src="js/dashboard.js"></script>


        <!--------------------------------------------------gsap link----------------------------------------------------------->

        <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/dashboard.js"></script>









    <!--------------------------------------------------bootstrap js link----------------------------------------------------------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>