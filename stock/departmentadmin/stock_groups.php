<?php require "../config/config.php"; ?>
<?php
     session_start();
     if ($_SESSION['is_da_login']) {
      //keep user on this page
     }
     else{
      //redirect to login page
        header("Location: ../choose") ;
     }  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock Groups under Departments | Stockpile</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/stock_group.css">
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
        <!------------------------------ side menu ----------------------------------------->
        <div class="side_menu" id="menu">
            <div class="side_menu_close_btn" onclick="side_menu_open()">
                <a><i class="fas fa-window-close"></i></a>
            </div>

            <!----------------------------------------------------profile
                ---------------------------------------------->

            <div id="info" class="admin con_tabs">
                <!----------------------- show profile pic nd name here
                    ---------------------------->
            </div>

            <!---------------------------------------------------- side manu tabs ------------------------------------>
            <div class="tabs">
                <div class="con_tabs">
                    <a href="home" class="con_tabs_links"><i class="fas fa-home"></i>
                        Dashboard</a>

                    <a href="expert_user" class="con_tabs_links"><i class="fas fa-user"></i>
                        Expert Users</a>
                    <a href="stock_groups" class="con_tabs_links ac"><i class="fas fa-object-group"></i>
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

        </div>
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

                    <!-------------------------------------------notification 
                        ---------------------------------->
                    <div id="notify_records" class="noti">
                        <!-------------------------------- show notificatiions here
                            --------------------------------------->
                    </div>

                    <!---------------------------------------------------- logout---------------------------------------------->
                    <div class="logout">
                        <a type="button" onclick="getLogout()">Logout</a>
                    </div>


                </div>

            </div>

            <div class="content">



                <div class="college">
                    <div class="heading_add_btn">
                        <div class="icon_heading">
                            <i class="fas fa-object-group"></i>
                            <h1>Stock Groups Under <?php echo $_SESSION['dept_name']; ?></h1>
                        </div>
                        <div class="item_unit_btn">
                            <!-------------------------------------------- search bar---------------------------------->
                            <div class="search_bar">
                                <input autocomplete="off" type="text" placeholder="search" id="search">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>
                            <!---------------------------------------add department admin buuton ----------------------------->
                            <a type="button" id="add_clg" onclick="overlay_add()">Add stock group</a>
                        </div>
                    </div>

                    <div id="group_records" class="table-responsive">

                        <!------------ show records here
                            --------------------->
            
                    </div>



                </div>


                <!---------------------------------------overlay add ----------------------------->

                <div class="overlay_add" id="overlay-add">
                    <a id="cross" onclick="reverse_add()" type="button"><i class="fas fa-times-circle"></i></a>
                    <div class="add_clg_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Add Stock Group</h1>
                        </div>
                        <!-------------------------- add form----------------------------->
                        <div class="main_add_clg">
                            <form id="form1" method="POST" autocomplete="off">

                                <p>Type Name</p>
                                <input type="text" class="form-control form-control-sm" id="type_name" required>


                                <p>Category Name</p>
                                <select class="form-control form-control-sm" id="category" required>
                                    <option value="" disabled selected>Select Category</option>
                                    <option value="recurring">Recurring</option>
                                    <option value="non-recurring">Non-recurring</option>
                                </select>

                                <input type="hidden" id="dept_id" value="<?php echo $_SESSION['dept_id'];?>">


                                <div class="add_clg_btn">
                                    <input type="submit" value="Save">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>



                <!---------------------------------------overlay update ----------------------------->


                <div class="overlay_update" id="overlay-update">
                    <a id="cross" onclick="reverse_update()" type="button"><i class="fas fa-times-circle"></i></a>

                    <div class="up_clg_ad_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Update Stock Group</h1>

                        </div>
                        <div class="main_add_clg">
                            <!------------------------update form ----------------------------->
                            <form id="form2" method="POST" autocomplete="off">

                                <input type="hidden" id="type_id">

                                <p>Type Name</p>
                                <input type="text" class="form-control form-control-sm" id="name_type" required>

                                <p>Category Name</p>

                                <input type="text" class="form-control form-control-sm" id="cat" readonly="" required="">


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

    <!--------------------------------- overlay-delete ------------------------------------>
                <div class="overlay_update" id="overlay-delete">

                    <div class="main_delete">
                        <div class="icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                            <h1>Are You Sure?</h1>
                        

                        <div class="button">
                            <form id="deleteform">
                                
                                <input type="hidden" id="deleteid">
            
                                <div class="del_btn"> 
                                    <a type="button" class="cancel" onclick="reverse_delete()">Cancel</a>
                                    <input type="submit" class="okay" value="Yes">
                                </div>

                            </form>
                        </div>
                    </div>

                </div>



    <!--------------------------------------------------gsap link----------------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>
    <!--------------------------------------------------ajax link----------------------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!--------------------------------------------------js link----------------------------------------------------------->
    <script src="js/dashboard.js"></script>
    <script src="js/stock_group.js"></script>
    <!---------------------------------------------------- sweet-alert link ------------------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--------------------------------------------------bootstrap js link----------------------------------------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    

    <!--------------------------------------- show stockgroup table 
        --------------------------------------->
    <script type="text/javascript">
        $(document).ready(function(){
            showGroups();
        });
        
        function showGroups() {
            var readgroup = "readgroup";
            $.ajax({
                url:"action_stock_groups.php",
                type:"post",
                data:{ readgroup:readgroup },
                success:function(data,status){
                    $('#group_records').html(data);
                }
            });
        }
    </script>


    <!--------------------------------------- stock group add ajax request 
        ---------------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#form1", function (e) {
        e.preventDefault();

        var type_name      = $("#type_name").val();
        var category       = $("#category").val();
        var dept_id        = $("#dept_id").val();


       if(type_name.trim() == "" || category.trim() == ""){
          swal("Oops", "Name cannot be empty", "warning");
        } else if (!type_name.match(/^[a-zA-Z& ]*$/)) {
          swal("Oops", "No special characters & numbers allowed", "warning");
        }
        else {
          $.ajax({
            url:"action_stock_groups.php",
            type: "POST",
            data: { add:1,type_name:type_name,category:category,dept_id:dept_id },
            success:function(data){
                var getmsgs=$.parseJSON(data);
                swal(""+getmsgs.title , ""+getmsgs.text ,""+getmsgs.icon);
                $("#type_name").val("");
                $("#category").val("");
                reverse_add();
                showGroups();
            }
          });
        }
    });
        
    </script>


    <!--------------------- get the stock group details to be updated 
        -------------------------------------->
    <script type="text/javascript">

    function getGroup(id) {

      $('#type_id').val(id);

        $.post("action_stock_groups.php", {
                id:id
            }, function (data,status) {

                var admin = JSON.parse(data);
                $('#name_type').val(admin.type_name);
                $('#cat').val(admin.category);
            })  
      overlay_update();
    }
    </script>

    <!-------------------------------- stock group update ajax request 
        -------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#form2", function (e) {
        e.preventDefault();

        var type_id=$('#type_id').val();
        var type_name=$('#name_type').val();
       
       if(type_name.trim() == ""){
          swal("Oops", "Whitesapces Not Allowed!", "warning");
        } else if (!type_name.match(/^[a-zA-Z ]*$/)) {
          swal("Oops", "No special characters & numbers allowed", "warning");
        }
        else {
          $.ajax({
            url:"action_stock_groups.php",
            type: "POST",
            data: { upd:1,type_id:type_id,type_name:type_name },
            success:function(result){
                var response=$.parseJSON(result);
                swal(""+response.title , ""+response.text ,""+response.icon);
                reverse_update();
                showGroups();
            }
          });
        }
    });
        
    </script>



    <!------------------------- delete stock grp
        ----------------------------->
    
    <script type="text/javascript">

    function getDelgroup(delid) {

        $('#deleteid').val(delid);

        overlay_delete();
    }
    </script>




    <!---------------------------- overlay for delete in-out
        ----------------->

    <script type="text/javascript">

    function overlay_delete(){
        let over=document.getElementById("overlay-delete");
        gsap.to(over , {duration:.5, opacity:1 , display:'block'});
    }

    function reverse_delete(){
        let cross=document.getElementById("overlay-delete");
        gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

    }
    
    </script>


    <!-------------------------------- stock group delete ajax request 
        -------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#deleteform", function (e) {
        e.preventDefault();

        var delid=$('#deleteid').val();          

        $.ajax({
            url:"action_stock_groups.php",
            type: "POST",
            data: { del:1,delid:delid },
            success:function(result){
                var response=$.parseJSON(result);
                swal(""+response.title , ""+response.text ,""+response.icon);
                reverse_delete();
                showGroups();
            }
          });
    });
        
    </script>


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