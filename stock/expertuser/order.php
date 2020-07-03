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
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <title>Order & File Details | Stockpile</title>

    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/order.css">
    <link rel="stylesheet" type="text/css" href="css/main_dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/media_dashboard.css">
    <!--------------------------------------------------bootstrap css link------------------------------------------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <!--------------------------------------------------font asesome link-------------------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    
    <!--------------------------------------------------google fonts link-------------------------------------------------->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins:300&display=swap" rel="stylesheet">

    <!--------------------------------------------------input file button script
        ------------------------------------------------->
    <script>
        (function (e, t, n) {
            var r = e.querySelectorAll("html")[0];
            r.className = r.className.replace(/(^|\s)no-js(\s|$)/, "$1js$2")
        })(document, window, 0);
    </script>

</head>

<body onload="renderDate()">
    <div class="wrapper">
         <div class="side_menu" id="menu">
          <!-----------------------------------------side menu open close-------------------------------------->
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

                    <p type="button" class="accordion con_tabs_links"><i class="fas fa-minus-square"></i> Issue Stock</p>
                    <div class="panel">
                        <a href="recurring_issue">Recurring</a>
                        <a href="non_recurring_issue">Non-Recurring</a>
                    </div>

                    <a href="damage" class="con_tabs_links"><i class="fas fa-chain-broken"></i> Damage Stock</a>
                    
                    <a href="order" class="con_tabs_links ac"><i class="fas fa-copy"></i> Order & Files</a>

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
        <!--------------------------------------top contents---------------------------------->
        <div class="top_content">
 <!-----------------------------------------top heading-------------------------------------->
            <div class="top_nav">
                <div class="top_nav_heading">
                 <!-----------------------------------------side menu open close-------------------------------------->
                    <div class="hamburger" onclick="side_menu_open()">
                        <a><i class="fas fa-bars"></i></a>
                    </div>
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
                                <button class="number" id="00">00</button>
                                <button class="number" id="0">0</button>
                                <button class="operator" id=".">.</button>
                                <button class="operator" id="=">=</button>
                            </div>
                        </div>

                    </div>
                    
                    <!-------------------------------------------notification ---------------------------------->
                    
                    <div class="noti" id="notify_records">
                        
                        <!------------ show drop down notifications here
                            ------------------------>
                    </div>
                    
                    <!----------------------------------------logout--------------------------------->

                    <div class="logout">
                        <a type="button" onclick="getLogout()">Logout</a>
                    </div>

                </div>

            </div>

            <!----------------------------------------content div---------------------------------->

            <div class="content">
                <div class="college">
                    <div class="heading_btn">

                        <div class="icon_heading">
                            <i class="fas fa-layer-group"></i>
                            <h1>Orders & Files Details</h1>
                        </div>
                        
                        <div class="item_unit_btn">

                            <!----------------------------search table---------------------------------->
                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search" autocomplete="off">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>
                            
                            <!------------------------------send request button button-------------------------->
                            <a id="add_item" onclick="overlay_uploads()" type="button">File upload</a>
                            <a id="add_item" onclick="overlay_order()" type="button">Generate order</a>

                        </div>
                    </div>

                    <!---------------------------------order & file records table---------------------------------->
                    <div id="file_records" class="table-responsive">

                        <!--------------------- show file & order table here
                            ---------------------->
                        
                    </div>
                </div>

                <!----------------------------------overlay for upload file--------------------------------------->

                <div class="overlay_update" id="overlay-upload">
                    <a id="cross" onclick="reverse_upload()"><i class="fas fa-times-circle"></i></a>

                    <div class="up_clg_ad_base_div">

                        <div class="heading_for_add_clg">
                            <h1>Upload File</h1>
                        </div>

                        <div class="main_add_clg">
                            
                            <form id="uploadform" method="POST" enctype="multipart/form-data">

                                <input type="hidden" name="file_id" id="file_id" required>

                                <p>Approved Id</p>
                                <input type="number" class="form-control form-control-sm" id="approved_id" name="approved_id" required readonly>

                                <div class="box">
                                    <!--------------------------------------------choose file ---------------------------------------------------->
                                    
                                    <input type="file" name="file" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
                                    
                                    <label for="file-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                            height="17" viewBox="0 0 20 17">
                                            <path
                                                d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                                        </svg> <span>Choose file</span></label>
                                </div>

                                <input type="hidden" name="act" id="act" value="update"> 

                                <div class="add_clg_btn">
                                    <input type="submit" value="Upload">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>




                <!---------------------------------- update overlay for send request---------------------------------->


                <div class="overlay_add" id="overlay-order">
                    <a id="cross" onclick="reverse_order()"><i class="fas fa-times-circle"></i></a>
                    <div class="add_clg_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Request Order</h1>
                        </div>

                        <div class="main_add_clg">
                            <form id="requestform" method="POST" autocomplete="off">

                                <input type="hidden" id="dept_id" value="<?php echo $_SESSION['dept_id'];?>" required>

                                <input type="hidden" id="notify_type" value="1" required>


                                <p>Subject</p>
                                <input type="text" id="notify_title" class="form-control form-control-sm" value="Request For Stock" required readonly>

                                <div class="row">

                                    <div class="col">
                                        <p>Item Name</p>
                                        <select id="notify_item" class="form-control form-control-sm" onchange="myfun2(this.value)" required>
                                            <option value="" selected="" disabled="">Select One</option>
                                                <?php
                                                $query = "SELECT * FROM  items WHERE dept_id='".$_SESSION['dept_id']."'";

                                                $fire = mysqli_query($con,$query) or die("can not display data from database. ".mysqli_error($con));

                                                if ($fire) {
                                                    while ($item = mysqli_fetch_array($fire)) {
                                                    ?>
                                                        <option value="<?= $item['item_name']; ?>"><?php echo $item['item_name']; ?></option>
                                                    <?php
                                                    }
                                                }
                                                ?>  
                                        </select>
                                    </div>

                                    <div class="col">
                                        <p>Item Unit</p>
                                        <select id="notify_unit" class="form-control form-control-sm" required>
                                            <option value="" selected="" disabled="">Select One</option>  
                                        </select>
                                    </div>
                                </div>

                                <p>Required quantity</p>
                                <input type="number" id="notify_quantity" class="form-control form-control-sm" placeholder="Enter Quantity" required>
  
                                <p>Message</p>
                                <textarea id="notify_message" class="form-control form-control-sm" rows="2" placeholder="Enter Something" required></textarea>

                                <div class="add_clg_btn">
                                    <input type="submit" value="Send">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!----------------------------------insert overlay for upload file for------------------------------------->

                <div class="overlay_update" id="overlay-uploads">
                    <a id="cross" onclick="reverse_uploads()"><i class="fas fa-times-circle"></i></a>

                    <div class="up_clg_ad_base_div">

                        <div class="heading_for_add_clg">
                            <h1>Upload File</h1>
                        </div>

                        <div class="main_add_clg">
                            
                            <form id="uploadforms" method="POST" enctype="multipart/form-data">

                                <p>Approved Id</p>
                                <input type="number" class="form-control form-control-sm" id="approved_ids" name="approved_ids" required>

                                <div class="box">
                                    <!--------------------------------------------choose file ---------------------------------------------------->
                                    
                                    <input type="file" name="files" id="files" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
                                    
                                    <label for="files">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                            height="17" viewBox="0 0 20 17">
                                            <path
                                                d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                                        </svg> <span>Choose file</span></label>
                                </div>

                                <input type="hidden" name="acts" id="acts" value="insert"> 

                                <div class="add_clg_btn">
                                    <input type="submit" value="Upload">
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
    <script src="js/main_dashboard.js"></script>
    <script src="js/order.js"></script>
    <script src="js/calculator.js"></script>
    <script src="js/custom-file-input.js"></script>
    
    <!---------------------------------------------------- sweet-alert link ------------------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <!--------------------------------------------------bootstrap js link---------------------------------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>




    <!-------------------------------------------------- show files table 
        -------------------------------------------->
    <script type="text/javascript">
        $(document).ready(function(){
            showFiles();
        });
        
        function showFiles() {
            var readfile = "readfile";
            $.ajax({
                url:"action_orders.php",
                type:"post",
                data:{ readfile:readfile },
                success:function(data,status){
                    $('#file_records').html(data);
                }
            });
        }

        setInterval(function () {
            $('#search').val("");
            showFiles();
        }, 30000);
    </script>


    <!--------------------------------------------- get units
        ------------------------------------>

    <script type="text/javascript">
        function myfun2(data1) {
            $.ajax({
                url:'action_orders.php',
                type:'POST',
                data: { adds2:1,data2 : data1},
                success: function (result) {
                    $('#notify_unit').html(result);
                }
            });
        }
    </script>



    <!---------------------------------------------- send notification ajax request 
        ----------------------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#requestform", function (e) {
        e.preventDefault();

        var dept_id             = $("#dept_id").val();
        var notify_type         = parseInt($("#notify_type").val());
        var notify_title        = $("#notify_title").val();
        var notify_item         = $("#notify_item").val();
        var notify_quantity     = parseInt($("#notify_quantity").val());
        var notify_unit         = $("#notify_unit").val();
        var notify_message      = $("#notify_message").val();
        

       if(notify_title.trim() == "" || notify_message.trim() == ""){
          swal("Oops", "Form fields cannot be empty!", "warning");
        } else if (notify_type!=1) { 
          swal("Oops", "Something went wrong", "warning");
        } else if (notify_quantity<=0) { 
          swal("Oops", "Quantity cannot be zero or negative!", "warning");
        } else if (!notify_title.match(/^[a-zA-Z& ]*$/)) {
          swal("Oops", "No special characters & numbers allowed", "warning");
        }
        else {
          $.ajax({
            url:"action_orders.php",
            type: "POST",
            data: { add:1,dept_id:dept_id,notify_type:notify_type,notify_title:notify_title,notify_item:notify_item,notify_quantity:notify_quantity,notify_unit:notify_unit,notify_message:notify_message },
            success:function(data){
                var getmsgs=$.parseJSON(data);
                swal(""+getmsgs.title , ""+getmsgs.text ,""+getmsgs.icon);
                $("#notify_item").val("");
                $("#notify_quantity").val("");
                $("#notify_unit").val("");
                $("#notify_message").val("");
                reverse_order();
            }
          });
        }
    });
        
    </script>


    <!--------------------------------- get the file details to be updated 
        -------------------------------------->
    <script type="text/javascript">

    function getFile(id) {

      $('#file_id').val(id);

        $.post("action_orders.php", {
                id:id
            }, function (data,status) {
                var files = JSON.parse(data);
                $('#approved_id').val(files.approved_id);
            })
      overlay_upload();
    }
    </script>

    <!------------------------------------ upload file for update data ajax request 
        ------------------------------------>
    <script type="text/javascript">
        
    $(document).on("submit", "#uploadform", function (e) {
        e.preventDefault();

        var act  = $('#act').val();
        var file_id  = $('#file_id').val();
        var file = $('#file-2').val();

        if (file=='') {
            swal("Oops", "Please select file", "warning");
        }else{

            var property=document.getElementById("file-2").files[0];

            var image_name=property.name;

            var image_extension=image_name.split('.').pop().toLowerCase();

            var image_size=property.size;
            
            if (property=='') {
                swal("Oops", "File name cannot be empty", "warning");
            } else if ($.inArray(image_extension,['png','jpg','jpeg','pdf'])== -1) {
                swal("Oops", "Invalid File Format", "warning");
                $("#file-2").val('');
            } else if (image_size>2000000) {
                swal("Oops", "File size is too big", "warning");
                $("#file-2").val('');
            }
            else {
                $.ajax({
                    url:"action_orders.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(result){
                        var response=$.parseJSON(result);
                        swal(""+response.title , ""+response.text ,""+response.icon);
                        $("#file-2").val('');
                        reverse_upload();
                        showFiles();
                    }
                });
            }
        }
    });
        
    </script>


    <!------------------------------------ upload file for insert data ajax request 
        ------------------------------------>
    <script type="text/javascript">
        
    $(document).on("submit", "#uploadforms", function (e) {
        e.preventDefault();

        var acts  = $('#acts').val();
        var approved_ids  = $('#approved_ids').val();
        var files = $('#files').val();

        if (files=='') {
            swal("Oops", "Please select file", "warning");
        }else{

            var property=document.getElementById("files").files[0];

            var image_name=property.name;

            var image_extension=image_name.split('.').pop().toLowerCase();

            var image_size=property.size;
            
            if (property=='') {
                swal("Oops", "File name cannot be empty", "warning");
            } else if ($.inArray(image_extension,['png','jpg','jpeg','pdf'])== -1) {
                swal("Oops", "Invalid File Format", "warning");
                $("#files").val('');
            } else if (image_size>2000000) {
                swal("Oops", "File size is too big", "warning");
                $("#files").val('');
            } else if (approved_ids<=0) {
                swal("Oops", "ID cannot be zero or negative", "warning");
            } else if (approved_ids.length!=6) {
                swal("Oops", "Invalid length", "warning");
            }
            else {
                $.ajax({
                    url:"action_orders.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(result){
                        var response=$.parseJSON(result);
                        swal(""+response.title , ""+response.text ,""+response.icon);
                        $("#approved_ids").val('');
                        $("#files").val('');
                        reverse_uploads();
                        showFiles();
                    }
                });
            }
        }
    });
        
    </script>



    <!------------------------------------------------------------- searching 
        ----------------------------------------------->

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