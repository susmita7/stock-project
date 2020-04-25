<?php require "../config/config.php"; ?>
<?php
     session_start();
     if ($_SESSION['is_eu_login']) {
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
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <title>Stock Items | Stockpile</title>

    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/stock_item.css">
    <link rel="stylesheet" type="text/css" href="css/main_dashboard.css">
    <!--------------------------------------------------bootstrap css link------------------------------------------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!--------------------------------------------------font asesome link-------------------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <!--------------------------------------------------google fonts link-------------------------------------------------->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins:300&display=swap" rel="stylesheet">
</head>

<body onload="renderDate()">
    <div class="wrapper">
        <div class="side_menu">
            <div class="side_menu_close_btn" onclick="side_menu_close()">
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
                    <a href="home" class="con_tabs_links"><i class="fas fa-home"></i>
                        Home</a>
                    <p type="button" class="accordion con_tabs_links ac"><i class="fas fa-layer-group"></i> Item & Unit</p>
                    <div class="panel">
                        <a href="stock_item">Stock Items</a>
                        <a href="stock_unit">Stock Unit</a>
                    </div>

                    <p type="button" class="accordion con_tabs_links"><i class="fas fa-plus-square"></i> &nbspAdd
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

                    <a href="damage" class="con_tabs_links"><i class="fas fa-toolbox"></i>Damage stock</a>
                
                    <a href="orders" class="con_tabs_links"><i class="fas fa-copy"></i> Orders</a>
                    <a href="notifications" class="con_tabs_links"><span class="counter_side_noti">
                            <p>2</p>
                        </span><i class="fas fa-bell"></i> Notifications</a>

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
        <!--------------------------------------top contents---------------------------------->
        <div class="top_content">
            <div class="hamburger" onclick="side_menu_open()">
                <a><i class="fas fa-bars"></i></a>
            </div>
            <div class="top_nav">
                <div class="top_nav_heading">
                    <h3><?php echo $_SESSION['dept_name']; ?> Department</h3>
                </div>

                <div class="top_nav_contents">
                    <!--------------------------------------clock---------------------------------->
                    <div class="clock">
                        <i class="fas fa-clock"></i>
                        <div id="time" onload="showTime()"></div>
                    </div>
                    <!----------------------------------------date---------------------------------->
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
                    <!----------------------------------------calculator---------------------------------->
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
                                <button class="empty" id="empty"></button>
                                <button class="number" id="0">0</button>
                                <button class="operator" id=".">.</button>
                                <button class="operator" id="=">=</button>
                            </div>
                        </div>

                    </div>
                    <!----------------------------------------notification---------------------------------->
                    <div class="noti">
                        <span class="counter">
                            <p>2</p>
                        </span>
                        <i class="fas fa-bell"></i>
                    </div>
                    <!----------------------------------------logout--------------------------------->

                    <div class="logout">
                        <a href="expert_user_logout">Logout</a>
                    </div>

                </div>

            </div>

            <!----------------------------------------content div---------------------------------->

            <div class="content">

                <div class="college">
                    <div class="heading_btn">
                        <div class="icon_heading">
                            <i class="fas fa-layer-group"></i>
                            <h1>Stock Items</h1>
                        </div>
                        <div class="item_unit_btn">

                            <!----------------------------------------search---------------------------------->
                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search" autocomplete="off">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>

                            <!------------------------------add item unit  button-------------------------->
                            <a id="add_item" onclick="overlay_add()" type="button">Add Item</a>
                            <a id="add_unit" href="stock_unit">Add Unit</a>

                        </div>
                    </div>

                    <!-----------------------------------------table---------------------------------->
                    <div id="item_records" class="table-responsive">

                        <!--------------------- show item table here
                            ---------------------->
                        
                    </div>



                </div>

                <!-----------------------------------------overlay add---------------------------------->


                <div class="overlay_add" id="overlay-add">
                    <a id="cross" onclick="reverse_add()"><i class="fas fa-times-circle"></i></a>
                    <div class="add_clg_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Add Stock Item</h1>
                        </div>

                        <div class="main_add_clg">

                            <!------------------------------ add form------------------------------>
                            <form id="form1" method="POST" autocomplete="off">

                                <p>Item Name</p>
                                <input type="text" class="form-control form-control-sm" id="item_name" required>


                                <p>Item Type</p>
                                <select id="type_id" class="form-control form-control-sm" required>
                    
                                <?php
                                  $query = "SELECT * FROM  category_type WHERE dept_id='".$_SESSION['dept_id']."'";

                                  $fire = mysqli_query($con,$query) or die("can not display data from database. ".mysqli_error($con));

                                  ?>
                                  <option value="" disabled="" selected="">Select Type</option>
                                  <?php
                                  if ($fire) {
                                      while ($type = mysqli_fetch_array($fire)) {
                                        ?>
                                        <option value="<?= $type['type_id']; ?>"><?php echo $type['type_name']; ?></option>
                                        <?php
                                      }
                                  }
                                ?>          
                                </select>

                                <input type="hidden" id="dept_id" value="<?php echo $_SESSION['dept_id'];?>">


                                <div class="add_clg_btn">
                                    <input type="submit" value="Save">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>


                <!-----------------------------------------overlay update---------------------------------->




                <div class="overlay_update" id="overlay-update">
                    <a id="cross" onclick="reverse_update()"><i class="fas fa-times-circle"></i></a>

                    <div class="up_clg_ad_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Update Stock Item</h1>

                        </div>
                        <div class="main_add_clg">

                            <!---------------------- update form -------------------------->
                            <form id="form2" method="POST" autocomplete="off">

                                <input type="hidden" id="item_id" required="">

                                <p>Item Name</p>
                                <input type="text" id="items_name" class="form-control form-control-sm" required="">

                                <p>Item Type</p>
                                <input type="text" id="type_name" class="form-control form-control-sm" required="" readonly="">

                                <div class="add_clg_btn">
                                    <input type="submit" value="Save changes">
                                </div>

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

                            <!------------------------------- delete form ------------------------------>
                            <form id="deleteform" method="POST" autocomplete="off">
                                
                                <input type="hidden" id="deleteid" required>

                                <div class="del_btn">
                                    <a type="button" class="cancel" onclick="reverse_delete()">Cancel</a>
                                    <input type="submit" class="okay" value="Yes" >
                                    
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

    <!---------------------------------------------------------ajax link----------------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    
    <!-----------------------------------------------------------------js links---------------------------------------------->
    <script src="js/dashboard.js"></script>
    <script src="js/stock_item.js"></script>
    <script src="js/calculator.js"></script>
    
    <!---------------------------------------------------- sweet-alert link ------------------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <!--------------------------------------------------bootstrap js link---------------------------------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <!------------------------------------ show pro pic nd name 
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


    <!--------------------------------------- show stock items table 
        --------------------------------------->
    <script type="text/javascript">
        $(document).ready(function(){
            showItems();
        });
        
        function showItems() {
            var readitem = "readitem";
            $.ajax({
                url:"action_stock_item.php",
                type:"post",
                data:{ readitem:readitem },
                success:function(data,status){
                    $('#item_records').html(data);
                }
            });
        }
    </script>

    <!-------------------------------------------- validate email
        ------------------------------------>

    <script type="text/javascript">
        function validateEmail($email) {
           var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
           return emailReg.test( $email );
        }
    </script>


    <!--------------------------------------- stock item add ajax request 
        ---------------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#form1", function (e) {
        e.preventDefault();

        var item_name     = $("#item_name").val();
        var type_id       = $("#type_id").val();
        var dept_id       = $("#dept_id").val();


       if(item_name.trim() == ""){
          swal("Oops", "Name cannot be empty", "warning");
        } else if (!item_name.match(/^[a-zA-Z& ]*$/)) {
          swal("Oops", "No special characters & numbers allowed", "warning");
        }
        else {
          $.ajax({
            url:"action_stock_item.php",
            type: "POST",
            data: { add:1,item_name:item_name,type_id:type_id,dept_id:dept_id },
            success:function(data){
                var getmsgs=$.parseJSON(data);
                swal(""+getmsgs.title , ""+getmsgs.text ,""+getmsgs.icon);
                $("#item_name").val("");
                $("#type_id").val("");
                reverse_add();
                showItems();
            }
          });
        }
    });
        
    </script>


    <!--------------------------------- get the stock item details to be updated 
        -------------------------------------->
    <script type="text/javascript">

    function getItem(id) {

      $('#item_id').val(id);

        $.post("action_stock_item.php", {
                id:id
            }, function (data,status) {

                var admin = JSON.parse(data);
                $('#items_name').val(admin.item_name);
                $('#type_name').val(admin.type_name);
            })  
      overlay_update();
    }
    </script>

    <!------------------------------------ stock item update ajax request 
        ------------------------------------>
    <script type="text/javascript">
        
    $(document).on("submit", "#form2", function (e) {
        e.preventDefault();

        var item_id     =$('#item_id').val();
        var item_name   =$('#items_name').val();
       
       if(item_name.trim() == ""){
          swal("Oops", "Whitesapces Not Allowed!", "warning");
        } else if (!item_name.match(/^[a-zA-Z& ]*$/)) {
          swal("Oops", "No special characters & numbers allowed", "warning");
        }
        else {
          $.ajax({
            url:"action_stock_item.php",
            type: "POST",
            data: { upd:1,item_id:item_id,item_name:item_name },
            success:function(result){
                var response=$.parseJSON(result);
                swal(""+response.title , ""+response.text ,""+response.icon);
                reverse_update();
                showItems();
            }
          });
        }
    });
        
    </script>



    <!---------------------------------------------- delete stock item
        --------------------------------------->
    
    <script type="text/javascript">

    function getDelitem(delid) {

        $('#deleteid').val(delid);

        overlay_delete();
    }
    </script>




    <!------------------------------------------- overlay for delete in-out
        --------------------------------------------->

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


    <!-------------------------------------- stock item delete ajax request 
        -------------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#deleteform", function (e) {
        e.preventDefault();

        var delid=$('#deleteid').val();          

        $.ajax({
            url:"action_stock_item.php",
            type: "POST",
            data: { del:1,delid:delid },
            success:function(result){
                var response=$.parseJSON(result);
                swal(""+response.title , ""+response.text ,""+response.icon);
                reverse_delete();
                showItems();
            }
          });
    });
        
    </script>


    

    <!------------------------------------------------------------- searching 
        ----------------------------------------------------------->

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