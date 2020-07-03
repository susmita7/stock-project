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
    <title>Reurring Stock Issue | Stockpile</title>


    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/recurring_issues.css">
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
     <!-----------------------------------------side menu open close-------------------------------------->
        <div class="side_menu" id="menu">
            <div class="side_menu_close_btn" onclick="side_menu_open()">
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
                    <a href="home" class="con_tabs_links"><i class="fas fa-home"></i> Dashboard</a>
                    <p type="button" class="accordion con_tabs_links"><i class="fas fa-layer-group"></i> Item & Unit</p>
                    <div class="panel">
                        <a href="stock_item">Stock Items</a>
                        <a href="stock_unit">Stock Units</a>
                    </div>

                    <p type="button" class="accordion con_tabs_links"><i class="fas fa-plus-square"></i> Add
                        Stock</p>
                    <div class="panel">
                        <a href="recurring_add">Recurring</a>
                        <a href="non_recurring_add">Non-Recurring</a>
                    </div>

                    <p type="button" class="accordion con_tabs_links ac"><i class="fas fa-minus-square"></i> Issue Stock</p>
                    <div class="panel">
                        <a href="recurring_issue">Recurring</a>
                        <a href="non_recurring_issue">Non-Recurring</a>
                    </div>

                    <a href="damage" class="con_tabs_links"><i class="fas fa-chain-broken"></i> Damage Stock</a>
                    
                    <a href="order" class="con_tabs_links"><i class="fas fa-copy"></i> Order & Files</a>

                    <a href="notifications" class="con_tabs_links">
                        <div id="getcount">
                            <!------------ show count ----------------->
                        </div>
                        <i class="fas fa-bell"></i> Notifications</a>
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
        <!-------------------------------------------top nav------------------------------------------->
        <div class="top_content">

            <div class="top_nav">
                <!--------------------------------------heading------------------------------------------>
                <div class="top_nav_heading">
                 <!-----------------------------------------side menu open close-------------------------------------->
                    <div class="hamburger" onclick="side_menu_open()">
                        <a><i class="fas fa-bars"></i></a>
                    </div>
                    <h3><?php echo $_SESSION['dept_name']; ?> Department</h3>
                </div>

                <div class="top_nav_contents">
                    <!--------------------------------------clock------------------------------------------->
                    <div class="clock">
                        <i class="fas fa-clock"></i>
                        <div id="time" onload="showTime()"></div>
                    </div>
                    <!--------------------------------------date------------------------------------------>
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
                    <!---------------------------------------calculator------------------------------------------->
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
                                <button class="number" id="00">00</button>
                                <button class="number" id="0">0</button>
                                <button class="operator" id=".">.</button>
                                <button class="operator" id="=">=</button>
                            </div>
                        </div>
                    </div>

                    <!------------------------------------notification
                        ------------------------------------------->
                    
                    <div class="noti" id="notify_records">
                        
                        <!-------------------- show drop down notifications here
                            ----------------------->
                    </div>
                    
                    <!------------------------------------------------logout
                        ----------------------------------------->
                    <div class="logout">
                        <a type="button" onclick="getLogout()">Logout</a>
                    </div>


                </div>

            </div>
            <!---------------------------------------------------content div
                ------------------------------------------->
            <div class="content">


                <div id="get_warning">
                    
                    <!--------------------- get the waring
                        ------------------>
                </div>

                <div class="college">
                    <div class="heading_btn">
                        <div class="icon_heading">
                            <i class="fas fa-cubes"></i>
                            <h1>Receiver Details For Recurring Stock</h1>
                        </div>
                        <div class="item_unit_btn">
                            <!-----------------------------------------search bar------------------------------------->
                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search" autocomplete="off">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>
                            <!--------------------------------------------------unit+item btn------------------------------------------>
                            <a id="add_unit" type="button" onclick="overlay_issue()">Issue Stock</a>
                            <a id="add_item" type="button" href="recurring_add" type="button">Add Stock</a>

                        </div>
                    </div>
                    
                    <!---------------------------------------table---------------------------------->
                    <div id="receiver_recurring_records" class="table-responsive">
                        
                        <!----------------- show receiver table for recurring stock here
                        ---------------------------> 

                    </div>
                </div>


                <!--------------------------------------------overlay for issue stock ------------------------------------------>

                <div class="overlay_add" id="overlay-issue">
                    <a id="cross" onclick="reverse_add()"><i class="fas fa-times-circle"></i></a>
                    <div class="add_clg_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Issue Stock</h1>
                        </div>

                        <div class="main_add_clg">

                            <!----------------------------- issue form ----------------------------------->
                            <form id="form1" method="POST" autocomplete="off">

                                <div class="row">
                                    <div class="col">
                                        <p>Usage</p>
                                        <select id="used_for" class="form-control form-control-sm" onchange="getGroup()" required>
                                            <option value="" disabled selected>Select one</option>
                                            <option value="office">Office use</option>
                                            <option value="lab">Lab use</option>
                                        </select>
                                    </div>

                                    <div class="col">
                                        <p>Stock group</p>
                                        <select id="particular_type" class="form-control form-control-sm"  onchange="getItems(this.value)" required>
                                            <option value="" selected="" disabled="">Select One</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col">

                                        <p>Item</p>
                                        <select id="particular_name" class="form-control form-control-sm" onchange="getUnit(this.value)" required>
                                           <option value="" disabled selected>Select Items</option>
                                        </select>

                                    </div>
                                    <div class="col">
                                        <p>Unit</p>
                                        <select id="unit" class="form-control form-control-sm" onchange="getQuantity()" required>
                                          <option value="" disabled selected>Select Unit</option>
                                        </select>
                                    </div>

                                </div>



                                <div class="row">
                                    <div class="col">
                                        
                                        <p>Available Quantity</p>
                                        
                                        <input type="number" id="previous_stock" class="form-control form-control-sm" placeholder="Quantity Available" readonly required>
                                        
                                    </div>

                                    <div class="col">
                                        <p>Issue Quantity</p>
                                        <input type="number" id="issued_quantity" class="form-control form-control-sm" placeholder="Quantity to be issued" required>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col">
                                        <p>Receiver's Name</p>
                                        <input type="text" id="receiver_name" class="form-control form-control-sm" placeholder="Receiver's Name" required>
                                    </div>

                                    <div class="col">
                                        <p>Receiver's Contact No.</p>
                                        <input type="number" id="contact_no" class="form-control form-control-sm" placeholder="Receiver's Mobile No." required>
                                    </div>
                                </div>

                                <p>Remarks</p>
                                <input type="text" class="form-control form-control-sm" id="remarks" placeholder="Remarks / Purpose" required>


                                <input type="hidden" id="dept_id" value="<?php echo $_SESSION['dept_id'];?>">

                                <div class="add_clg_btn">
                                    <input type="submit" value="Save">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>



    <!--------------------------------------------------gsap link
        ----------------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>
    
    <!---------------------------------------------------- ajax link 
        ------------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    
    <!---------------------------------------------------js link 
        ------------------------------------------------->
    <script src="js/main_dashboard.js"></script>
    <script src="js/calculator.js"></script>
    <script src="js/recurring_issue.js"></script>
    
    <!---------------------------------------------------- sweet-alert link 
        ------------------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <!--------------------------------------------------bootstrap js link
        ---------------------------------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    
    <!---------------------------------------------- show stock receiver table 
        --------------------------------------->
    <script type="text/javascript">
        $(document).ready(function(){
            showReceiver();
        });
        
        function showReceiver() {
            var readreceiver = "readreceiver";
            $.ajax({
                url:"action_recurring_issue.php",
                type:"post",
                data:{ readreceiver:readreceiver },
                success:function(data,status){
                    $('#receiver_recurring_records').html(data);
                }
            });
        }
    </script>

    <!-------------------------------------------- get stock group
        ---------------------------------------->

    <script type="text/javascript">
        function getGroup() {
            $.ajax({
                url:'action_recurring_issue.php',
                type:'POST',
                data: { group:1 },
                success: function (result) {
                    $('#particular_type').html(result);
                }
            });
        }
    </script>

    <!---------------------------------------- get items
        -------------------------------------->

    <script type="text/javascript">
        function getItems(dataval) {
            $.ajax({
                url:'action_recurring_issue.php',
                type:'POST',
                data: { adds1:1,datap : dataval},
                success: function (result) {
                    $('#particular_name').html(result);
                }
            });
        }
    </script>

    <!-------------------------------------------- get units
        --------------------------------------->

    <script type="text/javascript">
        function getUnit(data1) {
            $.ajax({
                url:'action_recurring_issue.php',
                type:'POST',
                data: { adds2:1,data2 : data1},
                success: function (result) {
                    $('#unit').html(result);
                }
            });
        }
    </script>


    
    <!-------------------------------------  get the available stock quantity  
        ------------------------------>
    
    <script type="text/javascript">
      
      function getQuantity() {

        var used_for =$("#used_for").val();
        var particular_name=$("#particular_name").val();
        var unit=$("#unit").val();
        if (used_for.trim()=="" || particular_name.trim()=="" || unit.trim()=="") {
            swal("Oops", "Form fields cannot be empty!", "warning");
        } else{
          $.ajax({
              url:'action_recurring_issue.php',
              type:'POST',
              data: { adds3:1,used_for:used_for,particular_name:particular_name,unit:unit },
              success: function (results) {
                  $('#previous_stock').val(results);
                }
            });
        }      
      }
    </script>

    <!---------------------------------------------- stock issue ajax request 
        ----------------------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#form1", function (e) {
        e.preventDefault();

        var used_for            = $("#used_for").val();
        var particular_type     = $("#particular_type").val();
        var particular_name     = $("#particular_name").val();
        var unit                = $("#unit").val();
        var previous_stock      = parseInt($("#previous_stock").val());
        var issued_quantity     = parseInt($("#issued_quantity").val());
        var remarks             = $("#remarks").val();
        var receiver_name       = $("#receiver_name").val();
        //var receiver_dept       = $("#receiver_dept").val();
        var contact_no          = $("#contact_no").val();
        var dept_id             = $("#dept_id").val();


       if(used_for.trim() == "" || particular_type.trim() == "" || particular_name.trim() == "" || unit.trim() == "" || remarks.trim() == "" || receiver_name.trim() == "" || contact_no.trim() == ""){
          swal("Oops", "Form fields cannot be empty!", "warning");
        } else if (previous_stock<=0) { 
          swal("Oops", "Quantity not available!", "warning");
        } else if (issued_quantity<=0) { 
          swal("Oops", "Quantity cannot be zero or negative!", "warning");
        } else if (previous_stock<issued_quantity) { 
          swal("Oops", "Issue quantity cannot be bigger than available quantity!", "warning");
        } else if (!remarks.match(/^[a-zA-Z ]*$/) || !receiver_name.match(/^[a-zA-Z ]*$/)) {
          swal("Oops", "No special characters & numbers allowed", "warning");
        } else if (contact_no.length!=10) {
          swal("Oops", "Enter a valid 10 digit mobile no", "warning");
        }
        else {
          $.ajax({
            url:"action_recurring_issue.php",
            type: "POST",
            data: { add:1,used_for:used_for,particular_type:particular_type,particular_name:particular_name,unit:unit,previous_stock:previous_stock,issued_quantity:issued_quantity,remarks:remarks,receiver_name:receiver_name,contact_no:contact_no,dept_id:dept_id },
            success:function(data){
                var getmsgs=$.parseJSON(data);
                swal(""+getmsgs.title , ""+getmsgs.text ,""+getmsgs.icon);
                $("#used_for").val("");
                $("#particular_type").val("");
                $("#particular_name").val("");
                $("#unit").val("");
                $("#previous_stock").val("");
                $("#issued_quantity").val("");
                $("#remarks").val("");
                $("#receiver_name").val("");
                //$("#receiver_dept").val("");
                $("#contact_no").val("");
                
                reverse_add();
                showReceiver();
                showWarning();
            }
          });
        }
    });
        
    </script>

    <!------------------------------------------------------------- searching 
        --------------------------------------------------------->

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



    <!------------------------------------------------ less stock warning 
        ----------------------------------------------->

    <script type="text/javascript">
        
        $(document).ready(function () {
            showWarning();
        });

        function showWarning() {

            var stock = "stock";
            
            $.ajax({
                url:"action_recurring_add.php",
                type:"post",
                data:{ stock:stock },
                success:function(data,status){
                    $('#get_warning').html(data);
                    showRedWarning();
                    showYellowWarning();
                }
            });
        }
    
    </script>

    

    <!---------------------------------------------- yellow warning
        ---------------------------------->
    <script type="text/javascript">

        $(document).ready(function () {
            showYellowWarning();
        });

        
        function showYellowWarning() {

            //$(".warning_yellow").css('display', 'flex');

            
            //setTimeout(function () {
                //$(".warning_yellow").fadeOut(1000);
            //}, 5000);
            
            
            $("#close1").click(function () {
                $(".warning_yellow").css('display', 'none');
            });
        }
        
    </script>


    <!---------------------------------------------- red warning 
        ---------------------------------------->

    <script type="text/javascript">

        $(document).ready(function () {
            showRedWarning();
        });

        function showRedWarning() {


            //$(".warning_red").css('display', 'flex');

            //setTimeout(function () {
              //  $(".warning_red").fadeOut(1000);
            //}, 5000);
        
            $("#close").click(function () {
                $(".warning_red").css('display', 'none');
            });
        }
    </script>
</body>

</html>