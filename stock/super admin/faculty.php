<?php require "../config/config.php"; ?>
<?php
     session_start();
     if ($_SESSION['is_sa_login']) {
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
    <title>Faculties of AAU | Stockpile</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">

    <!--------------------------------------------------css 
    link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/faculty.css">
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

            <!------------------------------------------profile-------------------------------------->
            <div id="info" class="admin con_tabs">

            <!---------------------- 
                here shows the profile pic and name of the super_admin
            ------------>
                
            </div>

            <!------------------------------------------tabs-------------------------------------->
            <div class="tabs">
                <div class="con_tabs">
                    <a href="home" class="con_tabs_links"><i class="fas fa-home"></i>
                        Home</a>
                    <a href="faculty" class="con_tabs_links ac"><i class="fas fa-user-friends"></i> Faculties</a>
                    <a href="college" class="con_tabs_links"><i class="fas fa-book"></i>&nbsp Colleges</a>

                    <a href="clg_admin" class="con_tabs_links"><i class="fas fa-user"></i>&nbsp
                        Clg_admins</a>
                    <a href="notifications" class="con_tabs_links"><span class="counter_side_noti">
                            <p>2</p>
                        </span><i class="fas fa-bell"></i>&nbsp notifications</a>
                </div>
            </div>

            <!------------------------------------------copyright-------------------------------------->
            <div class="side_menu_footer">
                <img src="images/stockpileLogo1.png">
                <h5>All rights reserved,copyright&copy; STOCKPILE,2020</h5>
            </div>

        </div>
        <div class="top_content">
            <div class="hamburger" onclick="side_menu_open()">
                <a><i class="fas fa-bars"></i></a>
            </div>
            <div class="top_nav">
                <div class="top_nav_heading">
                    <h3>Assam Agricultural University</h3>
                </div>

                <div class="top_nav_contents">
                    <!-------------------------------------------time------------------------------------->
                    <div class="clock">
                        <i class="fas fa-clock"></i>
                        <div id="time" onload="showTime()"></div>
                    </div>
                    <!-------------------------------------------date-------------------------------------->
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
                    <!------------------------------------------notification------------------------------------->
                    <div class="noti">
                        <span class="counter">
                            <p>2</p>
                        </span>
                        <i class="fas fa-bell" class="noti_bell"></i>
                    </div>
                    <!------------------------------------------logout------------------------------------->
                    <div class="logout">
                        <a href="super_admin_logout">Logout</a>
                    </div>

                </div>

            </div>

            <div class="content">

                <div class="college">
                    <div class="heading_add_btn">

                        <div class="icon_heading">
                            <i class="fas fa-user-friends"></i>
                            <h1>Faculties Under AAU</h1>
                        </div>

                        <div class="item_unit_btn">
                            <!-----------------------------------------search-------------------------------------->
                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search" autocomplete="off">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>
                            <!-----------------------------------------add faculty-------------------------------------->
                            <a type="button" id="add_clg" onclick="overlay_add()">Add Faculty</a>
                        </div>

                    </div>

                    <!-------------------------------------------table-------------------------------------->
                    <div id="faculty_records" class="table-responsive">

                        <!------------------- faculties records table will be shown here
                            -------------------->
                    
                    </div>

                </div>


                <!------------------------------------------------------------overlay add------------------------------------------->

                <div class="overlay_add" id="overlay-add">
                    <a id="cross" onclick="reverse_add()"><i class="fas fa-times-circle"></i></a>
                    <div class="add_clg_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Add Faculty</h1>
                        </div>


                        <div class="main_add_clg">
                            <!-------------------------------------------form-------------------------------------->
                            <form id="form1" method="POST" autocomplete="off">
                                <p>Faculty Name</p>
                                <input type="text" class="form-control form-control-sm" id="faculty_name" required>

                                <div class="add_clg_btn">
                                    <input type="submit" value="Add">
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                <!--------------------------------------------------overlay update--------------------------------------------->



                <div class="overlay_update" id="overlay-update">
                    <a id="cross" onclick="reverse_update()"><i class="fas fa-times-circle"></i></a>

                    <div class="add_clg_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Update Faculty</h1>

                        </div>
                        <div class="main_add_clg">
                            <!-------------------------------------------form-------------------------------------->
                            <form id="form2" method="POST" autocomplete="off">

                                <input type="hidden" id="id_faculty">
                                <p>Faculty Name</p>
                                <input type="text" class="form-control form-control-sm" id="name_faculty" required>

                                <div class="add_clg_btn">
                                    <input type="submit" value="Save changes">
                                </div>

                            </form>

                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>


    <!--------------------------------------------------gsap link------------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>
    <!-------------------------------------------------- ajax link --------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-------------------------------------------------- js link --------------------------------------------->
    <script src="js/dashboard.js"></script>
    <script src="js/faculty.js"></script>
    <!-------------------------------------------------- sweet alert --------------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--------------------------------------------------bootstrap js link------------------------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <!----------------------------------- show pro pic nd name
        -------------------------------------->
    <script type="text/javascript">
        $(document).ready(function(){
            showDatas();
        });
        
        function showDatas() {
            var read = "read";
            $.ajax({
                url:"action.php",
                type:"post",
                data:{ read:read },
                success:function(data,status){
                    $('#info').html(data);
                }
            });
        }
    </script>



    <!---------------------------------- show faculties table 
        ------------------------------------->
    <script type="text/javascript">
        $(document).ready(function(){
            showFaculties();
        });
        
        function showFaculties() {
            var readfaculty = "readfaculty";
            $.ajax({
                url:"action_faculty.php",
                type:"post",
                data:{ readfaculty:readfaculty },
                success:function(data,status){
                    $('#faculty_records').html(data);
                }
            });
        }
    </script>


    <!---------- faculty add ajax request ------------------>
    <script type="text/javascript">
        
    $(document).on("submit", "#form1", function (e) {
        e.preventDefault();

        var faculty_name=$('#faculty_name').val();

       if(faculty_name.trim() == ""){
          swal("Oops", "Whitesapces Not Allowed!", "warning");
       }else if(!faculty_name.match(/^[a-zA-Z ]*$/)){
          swal("Oops", "Only letters & whitesapces allowed!", "warning");
       }
        else {
          $.ajax({
            url:"action_faculty.php",
            type: "POST",
            data: {  faculty_name: faculty_name  },
            success:function(res){
                var getmsg=$.parseJSON(res);
                swal(""+getmsg.title , ""+getmsg.text ,""+getmsg.icon);
                $('#faculty_name').val("");
                reverse_add();
                showFaculties();
            }
          });
        }
    });
        
    </script>

    <!--------------- get the faculty details to be updated --------------->
    <script type="text/javascript">
        
        function getFaculty(id) {
          $('#id_faculty').val(id);

          $.post("action_faculty.php", {
                id:id
            }, function (data,status) {

                var faculty = JSON.parse(data);
                $('#name_faculty').val(faculty.faculty_name)
            }
          );
          overlay_update();
        }
    </script>

    <!---------- faculty update ajax request ------------------>
    <script type="text/javascript">
        
    $(document).on("submit", "#form2", function (e) {
        e.preventDefault();

        var id_faculty=$('#id_faculty').val();
        var name_faculty=$('#name_faculty').val();

       if( name_faculty.trim() == ""){
          swal("Oops", "Whitesapces Not Allowed!", "warning");
       } else if(!name_faculty.match(/^[a-zA-Z ]*$/)){
          swal("Oops", "Only letters & whitesapces allowed!", "warning");
       }
        else {
          $.ajax({
            url:"action_faculty.php",
            type: "POST",
            data: { upd:1,name_faculty:name_faculty,id_faculty:id_faculty },
            success:function(result){
                var getmsgs=$.parseJSON(result);
                swal(""+getmsgs.title , ""+getmsgs.text ,""+getmsgs.icon);
                reverse_update();
                showFaculties();
            }
          });
        }
    });
        
    </script>


    <!-------------------------------------------------- searching 
        --------------------------------------------->

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