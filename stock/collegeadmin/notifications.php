<?php require "../config/config.php"; ?>
<?php
     session_start();
     if ($_SESSION['is_ca_login']) {
      //keep user on this page
     }
     else{
      //redirect to login page
      header("Location: login");
     }  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>College Admin Notifications | Stockpile</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/notification.css">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
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
     <!-----------------------------------------side menu open close-------------------------------------->
         <div class="side_menu" id="menu">
            <div class="side_menu_close_btn" onclick="side_menu_open()">
                <a><i class="fas fa-window-close"></i></a>
            </div>
            

            <div id="info" class="admin con_tabs">
                
                <!------------------- show profile pic and name here
                    -------------------->
                
            </div>

            <!--------------------------- tabs -------------------------------->
            <div class="tabs">
                <div class="con_tabs">
                    <a href="home" class="con_tabs_links"><i class="fas fa-home"></i>
                        Dashboard</a>
                    <a href="department" class="con_tabs_links"><i class="fas fa-book"></i>&nbsp Departments</a>

                    <a href="dept_admin" class="con_tabs_links"><i class="fas fa-user"></i>&nbsp Dept Admins</a>
                    <a href="firms" class="con_tabs_links"><i class="fas fa-building"></i>&nbsp Firms</a>
                    <a href="notifications" class="con_tabs_links ac">
                        <div id="getcount">
                            <!---- show the notification count
                                ------------------->
                        </div>
                       <i class="fas fa-bell"></i>&nbsp Notifications</a>
                    <a href="activity" class="con_tabs_links"><i class="fa fa-history" aria-hidden="true"></i>&nbsp Activity Logs</a>
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

        <div class="top_content">
 <!-----------------------------------------nav bar-------------------------------------->
            <div class="top_nav">
                <div class="top_nav_heading">
                 <!-----------------------------------------side menu open close-------------------------------------->
                    <div class="hamburger" onclick="side_menu_open()">
                        <a><i class="fas fa-bars"></i></a>
                    </div>
                    <h3><?php echo $_SESSION["clg_name"] ;?> </h3>
                </div>

                <div class="top_nav_contents">
 <!-----------------------------------------clock-------------------------------------->
                    <div class="clock">
                        <i class="fas fa-clock"></i>
                        <div id="time" onload="showTime()"></div>
                    </div>
 <!----------------------------------------date-------------------------------------->
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
 <!-----------------------------------------notification-------------------------------------->
                    <div class="noti" id="notify_records">

                        <!------------ show notification dropdown here along with the bell icon
                            -------------------------->
                    </div>

                    <div class="logout">
                        <a type="button" onclick="getLogout()">Logout</a>
                    </div>

                </div>

            </div>
 <!----------------------------------------content div------------------------------------->
            <div class="content">
                <div class="college">
                    <div class="heading_btn">

                        <div class="icon_heading">
                            <i class="fas fa-bell"></i>
                            <h1>All Notifications</h1>
                        </div>
                        
                        <div class="item_unit_btn">
                            
                            <!--------------------------search---------------------------------->
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


                    <!----------------------------- show all notifications here
                        --------------------------------->
                    
                </div>



                <!-----------------------------------overlay send--------------------------------------------->



                <div class="overlay_update" id="overlay-send">
                    <a id="cross" onclick="reverse_send()" type="button"><i class="fas fa-times-circle"></i></a>

                    <div class="add_clg_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Notification</h1>

                        </div>
                        <div class="main_add_clg">

                            <!-------------------- send form ---------------------------------->
                            
                            <form id="sendform" method="POST" autocomplete="off">

                                <input type="hidden" id="notify_from" value="<?php echo $_SESSION['clg_id'];?>">

                                <p>To</p>
                                <input type="text" class="form-control form-control-sm" value="Super Admin" required readonly>

                                <p>Title</p>
                                <input type="text" id="notify_title" class="form-control form-control-sm" placeholder="Enter subject" required>


                                <p>Messege</p>
                                <textarea type="text" id="notify_message" class="form-control form-control-sm" placeholder="Enter something" col="2" required></textarea>

                                <div class="add_clg_btn">
                                    <input type="submit" value="Send">
                                </div>

                            </form>

                        </div>
                    </div>
                </div>



                <!-------------------------------- overlay Edit --------------------------------------------->



                <div class="overlay_update" id="overlay-update">
                    <a id="cross" onclick="reverse_update()" type="button"><i class="fas fa-times-circle"></i></a>

                    <div class="add_clg_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Edit Request</h1>

                        </div>
                        <div class="main_add_clg">

                            <!------------------------ request edit form-------------------------------------->
                            <form id="editform" method="POST" autocomplete="off">

                                <input type="hidden" id="edit_id" required>

                                <div class="row">
                                    <div class="col">
                                        <p>Particular Name</p>
                                        <input type="text" class="form-control form-control-sm" id="edit_item"
                                            readonly required>
                                    </div>
                                    <div class="col">
                                        <p>Particular Unit</p>
                                        <input type="text" class="form-control form-control-sm" id="edit_unit"
                                            readonly required>
                                    </div>
                                </div>


                                <p>Quantity</p>
                                <input type="number" id="edit_quantity" class="form-control form-control-sm" required>

                                <div class="add_clg_btn">
                                    <input type="submit" value="Save changes">
                                </div>

                            </form>

                        </div>
                    </div>
                </div>




                <!-----------------------------------------overlay deny---------------------------------->

                <div class="overlay_update" id="overlay-delete">

                    <div class="main_delete">
                        <div class="icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h1>Are You Sure?</h1>

                        <!------------------------ request deny form ----------------------------------->
                        <div class="button">
                            
                            <form id="deleteform" method="POST" autocomplete="off">

                                <input type="hidden" id="denyid" required>

                                <div class="del_btn">
                                    <input type="submit" class="okay" value="Yes">
                                    <a type="button" class="cancel" onclick="reverse_delete()">No</a>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/notification.js"></script>

    <!---------------------------------------------------- sweet-alert link ------------------------------------------------->
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
                url:"action_notification.php",
                type:"post",
                data:{ readallnotifications:readallnotifications },
                success:function(data,status){
                    $('#my_notifications').html(data);
                }
            });
        }

        setInterval(function () {
            showAllNotifications();
            $("#search").val("");
        }, 30000);
    </script>


    <!--------------------------------- read all notofications
        ----------------------------------------->

    <script type="text/javascript">
        function readAll() {
            var readall = "readall";
            $.ajax({
                url:"action.php",
                type:"post",
                data:{ readall:readall },
                success:function(result){
                    var response=$.parseJSON(result);
                    swal(""+response.title , ""+response.text ,""+response.icon);
                    showNotifications();
                    showCount();
                    showAllNotifications();
                }
            });
        }
    </script>



    <!------------------------------- request denial sure 
        ------------------------------------------>
    <script type="text/javascript">

    function getDeny(did) {

        $('#denyid').val(did);
        overlay_delete();
    }
    </script>

    <!-------------------------------- request deny ajax request 
        -------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#deleteform", function (e) {
        e.preventDefault();

        var denyid=$('#denyid').val();          

        $.ajax({
            url:"action_notification.php",
            type: "POST",
            data: { deny:1,denyid:denyid },
            success:function(result){
                var response=$.parseJSON(result);
                swal(""+response.title , ""+response.text ,""+response.icon);
                $('#denyid').val('');
                reverse_delete();
                showAllNotifications();
                showCount();
                showNotifications();
            }
          });
    });
        
    </script>


    <!----------------------------------------- edit request
        ------------------------------------------>
    <script type="text/javascript">

    function getEdit(eid) {

        $('#edit_id').val(eid);

        $.post("action_notification.php", {
                eid:eid
            }, function (data,status) {

                var noti = JSON.parse(data);
                $('#edit_quantity').val(noti.notify_quantity);
                $('#edit_unit').val(noti.notify_unit);
                $('#edit_item').val(noti.notify_item);
            })
        overlay_update();
    }
    </script>

    <!-------------------------------- request edit ajax request 
        -------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#editform", function (e) {
        e.preventDefault();

        var edit_id=$('#edit_id').val();
        var edit_quantity=$('#edit_quantity').val();

        if (edit_quantity<=0) {
            swal("Oops","Quantity cannot be zero or negative!","warning");
        }
        else{
            $.ajax({
                url:"action_notification.php",
                type: "POST",
                data: { edit:1,edit_id:edit_id,edit_quantity:edit_quantity },
                success:function(result){
                    var response=$.parseJSON(result);
                    swal(""+response.title , ""+response.text ,""+response.icon);
                    $('#edit_id').val('');
                    reverse_update();
                    showAllNotifications();
                    showNotifications();
                    showCount();
                }
            });
        }
    });
        
    </script>

    <!----------------------------------------- verify request
        ------------------------------------------>
    <script type="text/javascript">

    function getApprove(aid) {

        var approve_id = aid;

        $.ajax({
                url:"action_notification.php",
                type: "POST",
                data: { approve:1,approve_id:approve_id },
                success:function(result){
                    var response=$.parseJSON(result);
                    swal(""+response.title , ""+response.text ,""+response.icon);
                    showAllNotifications();
                    showNotifications();
                    showCount();
                }
            });

    }
    </script>

    <!----------------------------------------- send request
        ------------------------------------------>

    <script type="text/javascript">
        
    $(document).on("submit", "#sendform", function (e) {
        e.preventDefault();

        var notify_from=$('#notify_from').val();
        var notify_title=$('#notify_title').val();
        var notify_message=$('#notify_message').val();

        if (notify_title.trim()=="" || notify_message.trim()=="") {
            swal("Oops","Please fill up the form!","warning");
        } else if (!notify_title.match(/^[a-zA-Z& ]*$/)) {
            swal("Oops","Numbers & special characters not allowed!","warning");
        }
        else{
            $.ajax({
                url:"action_notification.php",
                type: "POST",
                data: { send:1,notify_from:notify_from,notify_title:notify_title,notify_message:notify_message },
                success:function(result){
                    var response=$.parseJSON(result);
                    swal(""+response.title , ""+response.text ,""+response.icon);
                    $('#notify_title').val("");
                    $('#notify_message').val("");
                    reverse_send();
                    showAllNotifications();
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