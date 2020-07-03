<?php require "../config/config.php"; ?>
<?php
     session_start();
     if ($_SESSION['is_sa_login']) {
      //keep user on this page
     }
     else{
      //redirect to login page
      header("Location: login");
      die();
     }  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Super Admin Notifications | Stockpile</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">

    <!--------------------------------------------------------------- css link
        ----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/notification.css">
    <link rel="stylesheet" type="text/css" href="css/main_dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/media_dashboard.css">
    <!------------------------------------------------------------ bootstrap css link ----------------------------------------------------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!----------------------------------------------------------- font asesome link
        ----------------------------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

    <!------------------------------------------------------------ google fonts link ----------------------------------------------------------->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins:300&display=swap" rel="stylesheet">
</head>

<body onload="renderDate()">

    <div class="wrapper">
     <!-----------------------------------------side menu open close-------------------------------------->
         <div class="side_menu" id="menu">
            <div class="side_menu_close_btn" onclick="side_menu_open()">
                <a><i class="fas fa-window-close"></i></a>
            </div>

            <!-----------------------------------profile------------------------------------------>

            <div id="info" class="admin con_tabs">

                <!---------------- showing pro pic & name here
                    ----------------->

            </div>

            <!------------------------------------------tabs-------------------------------------->
            <div class="tabs">
                <div class="con_tabs">
                    <a href="home" class="con_tabs_links"><i class="fas fa-home"></i> Dashboard</a>
                    <a href="faculty" class="con_tabs_links"><i class="fas fa-user-friends"></i> Faculties</a>
                    <a href="college" class="con_tabs_links"><i class="fas fa-book"></i>&nbsp Colleges</a>

                    <a href="clg_admin" class="con_tabs_links"><i class="fas fa-user"></i>&nbsp Clg Admins</a>
                    <a href="notifications" class="con_tabs_links ac">
                        <div id="getcount">
                            
                        </div>
                        <i class="fas fa-bell"></i>&nbsp Notifications</a>
                    <a href="activity" class="con_tabs_links"><i class="fa fa-history" aria-hidden="true"></i>&nbsp Activity Logs</a>
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

            <div class="top_nav">
                <div class="top_nav_heading">
                 <!-----------------------------------------side menu open close-------------------------------------->
                    <div class="hamburger" onclick="side_menu_open()">
                        <a><i class="fas fa-bars"></i></a>
                    </div>
                    <h3>Assam Agricultural University</h3>
                </div>

                <div class="top_nav_contents">
                    <!-------------------------------------time------------------------------------------>
                    <div class="clock">
                        <i class="fas fa-clock"></i>
                        <div id="time" onload="showTime()"></div>
                    </div>
                    <!-------------------------------------date------------------------------------------>
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
                    <div id="notify_records" class="noti">
                       <!-------------------- show drop down notifications here
                        -------------------->
                        
                    </div>

                    <div class="logout">
                        <a type="button" onclick="getLogout()">Logout</a>
                    </div>


                </div>

            </div>

            <div class="content">
                <div class="college">
                    <div class="heading_btn">
                        <div class="icon_heading">
                            <i class="fas fa-bell"></i>
                            <h1>All Notifications</h1>
                        </div>
                        <div class="item_unit_btn">
                            <!-----------------------------------search---------------------------------->
                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search" autocomplete="off">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>
                            <a type="button" id="add_item" onclick="readAll()">Read all</a>
                            <a type="button" id="add_unit" onclick="overlay_send()">Send</a>
                        </div>
                    </div>
                </div>

                <div id="my_notifications">

                    <!--------------- showing all notification contents here
                        ------------------------->  
                </div>


                
            <!----------------------------------- overlay send --------------------------->

                <div class="overlay_update" id="overlay-send">
                    <a id="cross" onclick="reverse_send()" type="button"><i class="fas fa-times-circle"></i></a>

                    <div class="add_clg_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Notification</h1>

                        </div>
                        <div class="main_add_clg">

                            <!---------------------- send notification form ------------------->
                            
                            <form id="sendform" method="POST" autocomplete="off">

                                <p>To College Admin</p>
                                <select class="form-control form-control-sm" id="clg_id" required>
                                <?php
                                   $query = "SELECT * FROM  college";
                                   $fire = mysqli_query($con,$query) or die("can not display data from database. ".mysqli_error($con));?>
                                   <option value="" disabled selected>Select College</option>
                                   <?php
                                   while ($rows = mysqli_fetch_array($fire)) {
                                ?>
                                  <option value="<?= $rows['clg_id']; ?>"><?php echo $rows['clg_name']; ?></option>
                                <?php
                                }?>
                                </select>
                                
                                <p>Title</p>
                                <input type="text" class="form-control form-control-sm" placeholder="Enter Title" id="notify_title" required>


                                <p>Messege</p>
                                <textarea type="text" class="form-control form-control-sm" col="2" placeholder="Write Something" id="notify_message" required></textarea>

                                <div class="add_clg_btn">
                                    <input type="submit" value="Send">
                                </div>

                            </form>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <!--------------------------------------------------gsap link ----------------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>

    <!--------------------------------------------------- ajax link
        ---------------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <!--------------------------------------------------- js link
        ----------------------------------------------------->
    <script src="js/dashboard.js"></script>
    <script src="js/notification.js"></script>

    <!-------------------------------------------------- sweet alert ---------------------------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <!--------------------------------------------------bootstrap js link----------------------------------------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>





    <!--------------------------------------- show all notifications in content div
        --------------------------------------->
    <script type="text/javascript">
        
        $(document).ready(function(){
            showAllNotifications();
        });
        
        function showAllNotifications() {
            var readallnotifications = "readallnotifications";
            $.ajax({
                url:"action_notifications.php",
                type:"post",
                data:{ readallnotifications:readallnotifications },
                success:function(data,status){
                    $('#my_notifications').html(data);
                }
            });
        }

        setInterval(function () {
            showAllNotifications();
        }, 30000);
    </script>
    


    <!---------------------------------- send notification to SA ajax request 
        ------------------------------------->
    
    <script type="text/javascript">
        
    $(document).on("submit", "#sendform", function (e) {
        e.preventDefault();

        var notify_title= $("#notify_title").val();
        var notify_message = $("#notify_message").val();
        var clg_id =$("#clg_id").val();


       if(notify_title.trim() == "" || notify_message.trim() == ""){
          swal("Oops", "Whitesapces not allowed!", "warning");
        } else if(!notify_title.match(/^[a-zA-Z ]*$/)){
          swal("Oops", "Title should contain letters only!", "warning");
        } 
        else {
          $.ajax({
            url:"action_notifications.php",
            type: "POST",
            data: { send:1,clg_id:clg_id,notify_title:notify_title,notify_message:notify_message },
            success:function(data){
                var getmsgs=$.parseJSON(data);
                swal(""+getmsgs.title , ""+getmsgs.text ,""+getmsgs.icon);
                $("#clg_id").val("");
                $("#notify_message").val("");
                $("#notify_title").val("");
                reverse_send();
            }
          });
        }
    });
        
    </script>

    <!------------------------------------------------------------- searching 
        ----------------------------------------------->

    <script>
        $(document).ready(function () {
            $("#search").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#mydiv ").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

</body>

</html>