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
    <title>Recurring Stock | Stockpile</title>

    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/recurring_adds.css">
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
                    <p type="button" class="accordion con_tabs_links"><i class="fas fa-layer-group"></i> Item & Unit</p>
                    <div class="panel">
                        <a href="stock_item">Stock Items</a>
                        <a href="stock_unit">Stock Unit</a>
                    </div>

                    <p type="button" class="accordion con_tabs_links ac"><i class="fas fa-plus-square"></i> &nbspAdd
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
        <!------------------------------------top contents---------------------------------->
        <div class="top_content">
            <div class="hamburger" onclick="side_menu_open()">
                <a><i class="fas fa-bars"></i></a>
            </div>
            <div class="top_nav">
                <div class="top_nav_heading">
                    <h3><?php echo $_SESSION['dept_name']; ?> Department</h3>
                </div>

                <div class="top_nav_contents">
                    <!-------------------------------------clock---------------------------------->
                    <div class="clock">
                        <i class="fas fa-clock"></i>
                        <div id="time" onload="showTime()"></div>
                    </div>
                    <!---------------------------------------date---------------------------------->
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
                    <!--------------------------------------calculator---------------------------------->
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
                    <!---------------------------------------notification---------------------------------->
                    <div class="noti">
                        <span class="counter">
                            <p>2</p>
                        </span>
                        <i class="fas fa-bell"></i>
                    </div>
                    <!---------------------------------------logout---------------------------------->
                    <div class="logout">
                        <a href="expert_user_logout">Logout</a>
                    </div>

                </div>

            </div>
            <!---------------------------------------content div---------------------------------->
            <div class="content">

                <div class="college">
                    <div class="heading_btn">
                        <div class="icon_heading">
                            <i class="fas fa-cubes"></i>
                            <h1>Stock Register For Recurring Stock</h1>
                        </div>
                        <div class="item_unit_btn">

                            <!--------------------------------------search bar---------------------------------->
                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search" autocomplete="off">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>
                            
                            <!---------------------------------------profile---------------------------------->
                            <a id="add_item" type="button" onclick="overlay_add()">Add Stock</a>
                            <a id="add_unit" type="button" href="recurring_issue">Issue Stock</a>
                        </div>
                    </div>

                    <!---------------------------------------table---------------------------------->
                    <div id="recurring_records" class="table-responsive">
                        
                        <!----------------- show stock register recurring here
                        ---------------------------> 

                    </div>

                </div>

                <!---------------------------------------overlay add---------------------------------->


                <div class="overlay_add" id="overlay-add">
                    <a id="cross" onclick="reverse_add()"><i class="fas fa-times-circle"></i></a>
                    
                    <div class="add_clg_base_div">
                        
                        <div class="heading_for_add_clg">
                            <h1>Add Stock</h1>
                        </div>

                        <div class="main_add_clg">

                            <!------------------------------ stock add form ----------------------------------->
                            <form id="form1" method="POST" autocomplete="off">

                                <div class="row">

                                    <div class="col">
                                        <p>Usage</p>
                                        <select id="used_for" class="form-control form-control-sm" required>
                                            <option value="" disabled selected>Choose one</option>
                                            <option value="office">Office use</option>
                                            <option value="lab">Lab use</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col">
                                        <p>Stock group</p>
                                        <select id="particular_type" class="form-control form-control-sm" onchange="myfun(this.value)" required>

                                            <option value="" selected="" disabled="">Select One</option>
                                              <?php
                                              $category="recurring";
                                              $query = "SELECT * FROM  category_type WHERE category='$category' AND dept_id='".$_SESSION['dept_id']."'";

                                              $fire = mysqli_query($con,$query) or die("can not display data from database. ".mysqli_error($con));

                                              if ($fire) {
                                                  while ($type = mysqli_fetch_array($fire)) {
                                                    ?>
                                                    <option value="<?= $type['type_name']; ?>"><?php echo $type['type_name']; ?></option>
                                                    <?php
                                                  }
                                              }
                                               ?>  
                                        </select>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="col">
                                        <p>Particular name</p>
                                        <select id="particular_name" class="form-control form-control-sm" onchange="myfun2(this.value)" required>

                                            <option value="" selected="" disabled="">Select One</option>
                                        </select>
                                    </div>

                                    <div class="col">
                                        <p>Quantity</p>
                                        <input type="number" class="input form-control form-control-sm" id="quantity" placeholder="Quantity to be added" required>
                                    </div>
                                </div>



                                <div class="row">

                                    <div class="col">
                                        <p>Unit</p>
                                        <select id="unit" class="form-control form-control-sm" required>
                                          <option value="" selected="" disabled="">Select One</option>  
                                        </select>
                                    </div>

                                    <div class="col">
                                        <p>Rate per unit</p>
                                        <input type="number" step="any" class="input form-control form-control-sm" id="price" placeholder="Rate per unit" required>
                                    </div>
                                </div>


                                <div class="row">
                                    
                                    <div class="col">
                                        <p>GST</p>
                                        <input type="number" id="gst_rate" class="input form-control form-control-sm" placeholder="GST in %" required>
                                    </div>

                                    <div class="col">
                                        <p>Total cost</p>
                                        <input type="text" class="form-control form-control-sm" id="total_amount" placeholder="Total amount" required readonly>
                                    </div>
                                </div>

                                <p>Remarks</p>
                                <input type="text" class="form-control form-control-sm" id="remarks" placeholder="write something" required>

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


    <!--------------------------------------------------gsap link----------------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>

    <!---------------------------------------------------------ajax link----------------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    
    <!-----------------------------------------------------------------js links---------------------------------------------->
    <script src="js/dashboard.js"></script>
    <script src="js/calculator.js"></script>
    <script src="js/recurring_add.js"></script>
    
    <!---------------------------------------------------- sweet-alert link ------------------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <!--------------------------------------------------bootstrap js link---------------------------------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <!---------------------------------------------- show pro pic nd name 
        ---------------------------------------------------->
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

    <!------------------------------------------------ get the total amount 
        ----------------------------------------------------->
    <script>
      /*
          $(".input").on('input',function(){

          var a=document.getElementById('quantity').value;
          a=parseFloat(a);

          var b=document.getElementById('price').value;
          b=parseFloat(b);

          document.getElementById('total_amount').value=a*b;
          });
      */
    </script>

    <script type="text/javascript">
        $(".input").on('input',function() {
            var a =parseFloat($("#quantity").val());
            var b =parseFloat($("#price").val());
            var c =parseFloat($("#gst_rate").val());

            if (c<0) { 
               swal("Oops", "GST value cannot be negative!", "warning");
            }else{

                var d =parseFloat(a*b);

                var e =parseFloat(d+(d*(c/100)));
            }

            if(isNaN(e)){
                $("#total_amount").val("");
            }else{
                $("#total_amount").val(e);
            }
        });
    </script>

    <script type="text/javascript">
        function myfun(dataval) {
            $.ajax({
                url:'action_recurring_add.php',
                type:'POST',
                data: { adds1:1,datap : dataval},
                success: function (result) {
                    $('#particular_name').html(result);
                }
            });
        }
    </script>

    <script type="text/javascript">
        function myfun2(data1) {
            $.ajax({
                url:'action_recurring_add.php',
                type:'POST',
                data: { adds2:1,data2 : data1},
                success: function (result) {
                    $('#unit').html(result);
                }
            });
        }
    </script>

    <!--------------------------------- show stock register table 
        --------------------------------------->
    <script type="text/javascript">
        $(document).ready(function(){
            showStocks();
        });
        
        function showStocks() {
            var readstock = "readstock";
            $.ajax({
                url:"action_recurring_add.php",
                type:"post",
                data:{ readstock:readstock },
                success:function(data,status){
                    $('#recurring_records').html(data);
                }
            });
        }
    </script>


    <!---------------------------------------------- stock add ajax request 
        ----------------------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#form1", function (e) {
        e.preventDefault();

        var used_for            = $("#used_for").val();
        var particular_type     = $("#particular_type").val();
        var particular_name     = $("#particular_name").val();
        var quantity            = parseInt($("#quantity").val());
        var unit                = $("#unit").val();
        var price               = parseFloat($("#price").val());
        var total_amount        = parseFloat($("#total_amount").val());
        var remarks             = $("#remarks").val();
        var dept_id             = $("#dept_id").val();
        var gst_rate            = parseInt($("#gst_rate").val());


       if(used_for.trim() == "" || particular_type.trim() == "" || particular_name.trim() == "" || unit.trim() == "" || remarks.trim() == ""){
          swal("Oops", "Form fields cannot be empty!", "warning");
        } else if (quantity<=0) { 
          swal("Oops", "Quantity cannot be zero or negative!", "warning");
        } else if (price<=0) { 
          swal("Oops", "Rate cannot be zero or negative!", "warning");
        }  else if (gst_rate<0) { 
          swal("Oops", "GST value cannot be negative!", "warning");
        } else if (isNaN(total_amount)) { 
          swal("Oops", "Total amount cannot be null or zero or negative!", "warning");
        } else if (!remarks.match(/^[a-zA-Z& ]*$/)) {
          swal("Oops", "No special characters & numbers allowed", "warning");
        }
        else {
          $.ajax({
            url:"action_recurring_add.php",
            type: "POST",
            data: { add:1,used_for:used_for,particular_type:particular_type,particular_name:particular_name,quantity:quantity,unit:unit,price:price,total_amount:total_amount,remarks:remarks,dept_id:dept_id },
            success:function(data){
                var getmsgs=$.parseJSON(data);
                swal(""+getmsgs.title , ""+getmsgs.text ,""+getmsgs.icon);
                $("#used_for").val("");
                $("#particular_type").val("");
                $("#particular_name").val("");
                $("#quantity").val("");
                $("#unit").val("");
                $("#price").val("");
                $("#total_amount").val("");
                $("#remarks").val("");
                
                reverse_add();
                showStocks();
            }
          });
        }
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