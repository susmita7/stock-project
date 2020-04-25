<?php require "../config/config.php";
session_start();  
  // check if super admin logged in or not
  if ($_SESSION['is_sa_login']) {
     //keep admin on page
  }
  else{
     //redirect to loginpage
     header("Location: login");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Colleges of AAU | Stockpile</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">

    <!------------------------- css links -------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/college.css">
    <link rel="stylesheet" type="text/css" href="css/main_dashboard.css">

    <!--------------------------------------  bootstrap css link  ---------------------------------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!--------------------------------------  font asesome link  ------------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

    <!--------------------------------------  google fonts link  -------------------------------------------->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins:300&display=swap" rel="stylesheet">
</head>

<body onload="renderDate()">

    <div class="wrapper">

        <!--------------------------------  side menu  --------------------------------------------->
        <div class="side_menu">

            <div class="side_menu_close_btn" onclick="side_menu_close()">
                <a><i class="fas fa-window-close"></i></a>
            </div>

            <div id="info" class="admin con_tabs">
            
            </div>

            <!------------------------------------------tabs-------------------------------------->
            <div class="tabs">
                <div class="con_tabs">
                    <a href="home" class="con_tabs_links"><i class="fas fa-home"></i>
                        Home</a>
                    <a href="faculty" class="con_tabs_links"><i class="fas fa-user-friends"></i> Faculties</a>
                    <a href="college" class="con_tabs_links ac"><i class="fas fa-book"></i>&nbsp Colleges</a>

                    <a href="clg_admin" class="con_tabs_links"><i class="fas fa-user"></i>&nbsp
                        Clg_admins</a>
                    <a href="notifications" class="con_tabs_links"><span class="counter_side_noti">
                            <p>2</p>
                        </span><i class="fas fa-bell"></i>&nbsp notifications</a>
                </div>
            </div>

            <div class="side_menu_footer">
                <img src="images/stockpileLogo1.png">
                <h5>All rights reserved,copyright&copy; STOCKPILE,2020</h5>
            </div>

        </div>
        <!-----------------------  end of side menu  ------------------------------>

        <!------------------------  top content  -------------------------------------->
        <div class="top_content">

            <!-----------------  responsive sidebar  ---------------------->
            <div class="hamburger" onclick="side_menu_open()">
                <a><i class="fas fa-bars"></i></a>
            </div>

            <!-----------------  navbar  ----------------------->
            <div class="top_nav">

                <!-----------  top heading  ------------------>
                <div class="top_nav_heading">
                    <h3>Assam Agricultural University</h3>
                </div>

                <div class="top_nav_contents">
                    
                    <!------------  clock  ----------------------> 
                    <div class="clock">
                        <i class="fas fa-clock"></i>
                        <div id="time" onload="showTime()"></div>
                    </div>
                    
                    <!------------  date  --------------------->
                    <div class="date">

                        <i class="fas fa-calendar-day"></i>

                        <?php

                            date_default_timezone_set("Asia/kolkata");

                            echo date("d-m-y");

                        ?>

                        <i class="fas fa-angle-down" id="angle_arrow" onclick="show_calendar()"></i>
                        
                        <!-------------  celender  ------------------>
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
                        <!----------------  end celender  ------------------------>

                    </div>
                    <!---------------  end date  -----------------> 

                    <!----------- notification bell ----------->
                    <div class="noti">
                        <span class="counter">
                            <p>2</p>
                        </span>
                        <i class="fas fa-bell" class="noti_bell"></i>
                    </div>

                    <!------------- logout button ------------->
                    <div class="logout">
                        <a href="super_admin_logout">Logout</a>
                    </div>

                </div>

            </div>
            <!----------------------- end of navbar -------------------------->

            <div class="content">

            <!----------------------  main contents  --------------------------------->
                <div class="college">
                <!----------------------- displayed contents -------------------------------->
                    
                    <div class="heading_add_btn">
                        <div class="icon_heading">
                            <i class="fas fa-book"></i>
                            <h1>Colleges Under AAU</h1>
                        </div>
                        <div class="item_unit_btn">
                            <div class="search_bar">
                                <input id="myInput" type="text" placeholder="search">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>

                            <!------------- add clg button --------------->
                            <a type="button" id="add_clg" onclick="overlay_add()">Add College</a>
                        </div>
                    </div>

                    <!----------------- show college table here -------------------->
                    <div id="clg_records" class="table-responsive">

                        <!----------------- college records shown here
                            --------------------->

                    </div>
                </div>
                <!------------------------ end of displayed contents -------------------->

                <!-------------------  add college overlay  -------------------->
                <div class="overlay_add" id="overlay-add">

                    <a id="cross" onclick="reverse_add()"><i class="fas fa-times-circle"></i></a>

                    <div class="add_clg_base_div">

                        <div class="heading_for_add_clg">
                            <h1>Add College</h1>
                        </div>
                        
                        <!------------------------------  add clg form  ----------------------------------->
                        <div class="main_add_clg">

                            <form id="form1" method="POST" autocomplete="off">
                                <p>College Name</p>
                                <input type="text" id="clg_name" class="form-control form-control-sm" required>

                                <p>Faculty Name</p>
                                <select class="form-control form-control-sm" id="faculty_id" required>
                                <?php
                                   $query = "SELECT * FROM  faculty";
                                   $fire = mysqli_query($con,$query) or die("can not display data from database. ".mysqli_error($con));?>
                                   <option value="" disabled selected>Select Faculty</option>
                                   <?php
                                   while ($rows = mysqli_fetch_array($fire)) {
                                ?>
                                  <option value="<?= $rows['faculty_id']; ?>"><?php echo $rows['faculty_name']; ?></option>
                                <?php
                                }?>
                                </select>
                    
                                
                                <!------------------------ add button ----------------------------------------->
                                <div class="add_clg_btn">
                                    <input type="submit" value="Add">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--------------------------- end of add college overlay ------------------------>

                <!--------------------------  update college overlay  ---------------------------->
                <div class="overlay_update" id="overlay-update">

                    <a id="cross" onclick="reverse_update()"><i class="fas fa-times-circle"></i></a>

                    <div class="add_clg_base_div">

                        <div class="heading_for_add_clg">
                            <h1>Update College</h1>
                        </div>

                        <div class="main_add_clg">

                            <form id="form2" method="POST" autocomplete="off">
                                <input type="hidden" id="id_clg" required>

                                <p>College Name</p>
                                <input type="text" id="name_clg" class="form-control form-control-sm" required>
                                
                                <p>Faculty Name</p>
                                <input type="text" id="name_faculty" class="form-control form-control-sm" readonly required>

                                <div class="add_clg_btn">
                                    <input type="submit" value="Update">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!------------------------ end of update college overlay ----------------------->

            </div>
            <!-------------------------  end of main contents  ----------------------------->
        </div>
    </div>
    
    
    <!--------------------------------------------------gsap link----------------------------------------------------------->

    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/college.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <!--------------------------------------------------bootstrap js link----------------------------------------------------------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>



    <!----------------- show pro pic nd name ------------------------------>
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

    <!----------------- show colleges table ------------------------------>
    <script type="text/javascript">
        $(document).ready(function(){
            showColleges();
        });
        
        function showColleges() {
            var readclg = "readclg";
            $.ajax({
                url:"action_clg.php",
                type:"post",
                data:{ readclg:readclg },
                success:function(data,status){
                    $('#clg_records').html(data);
                }
            });
        }
    </script>
     
    <!---------- clg add ajax request ------------------>
    <script type="text/javascript">
        
    $(document).on("submit", "#form1", function (e) {
        e.preventDefault();

        var clg_name=$('#clg_name').val();
        var faculty_id=$('#faculty_id').val();

       if(clg_name.trim() == ""){
          swal("Oops", "Whitesapces Not Allowed!", "warning");
       }else if(!clg_name.match(/^[a-zA-Z ]*$/)){
          swal("Oops", "Only letters & whitesapces allowed!", "warning");
       }
        else {
          $.ajax({
            url:"action_clg.php",
            type: "POST",
            data: { add:1,clg_name: clg_name,faculty_id:faculty_id },
            success:function(res){
                var getmsg=$.parseJSON(res);
                swal(""+getmsg.title , ""+getmsg.text ,""+getmsg.icon);
                $('#clg_name').val("");
                $('#faculty_id').val("");
                reverse_add();
                showColleges();          
            }
          });
        }
    });
        
    </script>


    <!--------------- get the college details to be updated --------------->
    <script type="text/javascript">
        
        function getClg(id) {
          $('#id_clg').val(id);

          $.post("action_clg.php", {
                id:id
            }, function (data,status) {

                var clgs = JSON.parse(data);
                $('#name_clg').val(clgs.clg_name)
                $('#name_faculty').val(clgs.faculty_name)
            }
          );
          overlay_update();
        }
    </script>

    <!---------- clg update ajax request ------------------>
    <script type="text/javascript">
        
    $(document).on("submit", "#form2", function (e) {
        e.preventDefault();

        var id_clg=$('#id_clg').val();
        var name_clg=$('#name_clg').val();

       if(name_clg.trim() == ""){
          swal("Oops", "Whitesapces Not Allowed!", "warning");
       }else if(!name_clg.match(/^[a-zA-Z ]*$/)){
          swal("Oops", "Only letters & whitesapces allowed!", "warning");
       }
        else {
          $.ajax({
            url:"action_clg.php",
            type: "POST",
            data: { name_clg:name_clg,id_clg:id_clg },
            success:function(result){
                var getmsgs=$.parseJSON(result);
                swal(""+getmsgs.title , ""+getmsgs.text ,""+getmsgs.icon);
                reverse_update();
                showColleges();
            }
          });
        }
    });
        
    </script>
    
    <!------------- searching ------------------------->
    <script>
        $(document).ready(function(){
           $("#myInput").on("keyup", function() {
               var value = $(this).val().toLowerCase();
               $("#myTable tr").filter(function() {
                 $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
               });
           });
        });
    </script>

</body>

</html>