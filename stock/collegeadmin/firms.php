<?php require "../config/config.php"; ?>
<?php
    session_start();
    if ($_SESSION['is_ca_login']) {
      //keep user on this page
    }else{
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
    <title>Firms | Stockpile</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    
    <!----------------------------------------------------------- css link
        ----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/firms.css">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/media_dashboard.css">
    <!----------------------------------------------------------- bootstrap css link ------------------------------------------------------------>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <!----------------------------------------------------------- font asesome link ----------------------------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    
    <!----------------------------------------------------------- google fonts link ----------------------------------------------------------->
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

                <!-------------------------- show profile pic and name here 
                    ---------------------------------->
        
            </div>

            <!--------------------------- tabs -------------------------------->
            <div class="tabs">
                <div class="con_tabs">
                    <a href="home" class="con_tabs_links"><i class="fas fa-home"></i>
                        Dashboard</a>
                    <a href="department" class="con_tabs_links"><i class="fas fa-book"></i>&nbsp Departments</a>

                    <a href="dept_admin" class="con_tabs_links"><i class="fas fa-user"></i>&nbsp Dept Admins</a>
                    <a href="firms" class="con_tabs_links ac"><i class="fas fa-building"></i>&nbsp Firms</a>
                    <a href="notifications" class="con_tabs_links">
                        <div id="getcount">
                            <!---- show the notification count
                                ------------------->
                        </div>
                       <i class="fas fa-bell"></i>&nbsp Notifications</a>
                    <a href="activity" class="con_tabs_links"><i class="fa fa-history" aria-hidden="true"></i>&nbsp Activity Logs</a>
                </div>
            </div>
            
            
            <!-------------------------------------------- copyright ---------------------------------->
            <div class="side_menu_footer">

                <div class="logo_title">
                    <img src="images/favicon.png">
                    <h3>STOCKPILE</h3>
                </div>
                <h5>All rights reserved,copyright&copy; STOCKPILE,2020</h5>
            </div>

        </div>
        <!-------------------------------------------- top nav ---------------------------------->
        <div class="top_content">

            <!---------------------------------------college name heading ---------------------------------->
            <div class="top_nav">
                <div class="top_nav_heading">
                 <!-----------------------------------------side menu open close-------------------------------------->
                    <div class="hamburger" onclick="side_menu_open()">
                        <a><i class="fas fa-bars"></i></a>
                    </div>
                    
                    <h3><?php echo $_SESSION["clg_name"] ;?> </h3>
                </div>

                <div class="top_nav_contents">
                    <!---------------------------------------clock ---------------------------------->
                    <div class="clock">
                        <i class="fas fa-clock"></i>
                        <div id="time" onload="showTime()"></div>
                    </div>
                    <!-------------------------------------------- date ---------------------------------->
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
                    <div class="noti" id="notify_records">

                        <!------------ show notification dropdown here along with the bell icon
                            -------------------------->
                    </div>
                    
                    <!--------------------------------------------logout ---------------------------------->
                    <div class="logout">
                        <a type="button" onclick="getLogout()">Logout</a>
                    </div>

                </div>

            </div>

            <!-------------------------------------------- main content div ---------------------------------->
            <div class="content">



                <div class="college">
                    <div class="heading_add_btn">
                        
                        <!-----------------------------------------heading of table ---------------------------------->
                        <div class="icon_heading">
                           <i class="fas fa-building"></i>
                            <h1>Firms Under <?php echo $_SESSION["clg_name"] ;?></h1>
                        </div>
                        <div class="item_unit_btn">

                            <!-------------------------------------------- search bar---------------------------------->
                            <div class="search_bar">
                                <input type="text" placeholder="search" id="search" autocomplete="off">
                                <div class="icon"> <i class="fas fa-search"></i></div>
                            </div>

                            <!---------------------------------------add firm buuton ----------------------------->
                            <a id="add_clg" type="button" onclick="overlay_add()">Add firm</a>
                        </div>
                    </div>

                    <!--------------------------------------------table ---------------------------------->
                    <div id="firms_records" class="table-responsive">
                        
                        <!---------------- show the firm records here
                            ------------------>

                    </div>

                </div>
                <!--------------------------------------------overlay add ---------------------------------->

                <div class="overlay_add" id="overlay-add">
                    <a id="cross" onclick="reverse_add()"><i class="fas fa-times-circle"></i></a>
                    <div class="add_clg_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Add Firm</h1>
                        </div>
                        <!----------------------------------- add form ---------------------------------->

                        <div class="main_add_clg">
                            <form id="form1" method="POST" autocomplete="off">

                                <input type="hidden" id="clg_id" value="<?php echo $_SESSION["clg_id"] ;?>">

                                <p>Firm's Name</p>
                                <input type="text" class="form-control form-control-sm" id="firm_name" required>

                                <p>Owner's Name</p>
                                <input type="text" class="form-control form-control-sm" id="owner_name" required>

                                <p>Email Id</p>
                                <input type="email" class="form-control form-control-sm" id="firm_email" required>

                                <p>Phone No</p>
                                <input type="number" class="form-control form-control-sm" id="firm_mobile" required>

                                <p>Address</p>
                                <input type="text" class="form-control form-control-sm" id="firm_address" required>
                                
                                <div class="add_clg_btn">
                                    <input type="submit" value="Save">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>



                <!------------------------------------------overlay update ---------------------------------->

                <div class="overlay_update" id="overlay-update">
                    <a id="cross" onclick="reverse_update()"><i class="fas fa-times-circle"></i></a>

                    <div class="add_clg_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Update Firm</h1>
                        </div>
                        <!------------------------------update form ---------------------------------->
                        <div class="main_add_clg">
                            <form id="form2" method="POST" autocomplete="off">

                                <input type="hidden" id="firm_id">
                                
                                <p>Firm's Name</p>
                                <input type="text" class="form-control form-control-sm" id="name_firm" required>

                                <p>Owner's Name</p>
                                <input type="text" class="form-control form-control-sm" id="name_owner" required>

                                <p>Email Id</p>
                                <input type="email" class="form-control form-control-sm" id="email_firm" required>

                                <p>Phone No</p>
                                <input type="number" class="form-control form-control-sm" id="mobile_firm" required>

                                <p>Address</p>
                                <input type="text" class="form-control form-control-sm" id="address_firm" required>

                                <div class="add_clg_btn">
                                    <input type="submit" value="Save Changes">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>




    <!------------------------------------------overlay email---------------------------------->

                <div class="overlay_update" id="overlay-email">
                    <a id="cross" type="button" onclick="reverse_email()"><i class="fas fa-times-circle"></i></a>

                    <div class="send_email_base_div">
                        <div class="heading_for_add_clg">
                            <h1>Send Mail</h1>
                        </div>

                        <!------------------------- send email form ---------------------------------->
                        <div class="main_add_clg">

                            <form id="emailform" method="POST" autocomplete="off">

                                <input type="hidden" id="firm_ids" required>

                                <p>From</p>
                                <input type="text" class="form-control form-control-sm" id="our_email" value="stockpile52@gmail.com" required readonly>

                                <div class="row">
                                    <div class="col">
                                        <p>Firm Name</p>
                                        <input type="text" id="name_firms" class="form-control form-control-sm" required readonly>
                                    </div>
                                    <div class="col">
                                        <p>Owner Name</p>
                                        <input type="text" id="name_owners" class="form-control form-control-sm" required readonly>
                                    </div>
                                </div>

                                <p>To</p>
                                <input type="email" class="form-control form-control-sm" id="email_firms" required readonly>

                                <p>Subject</p>
                                <input type="text" class="form-control form-control-sm" id="subject" placeholder="Enter subject" required>

                                <p>Compose Email</p>
                                <textarea  class="form-control form-control-sm" col="2" id="body" placeholder="Write something" required></textarea>
                                

                                <div class="add_clg_btn">
                                    <input id="emailsentbtn" type="submit" value="Send">
                                </div>

                            </form>

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
                        
                        <!-------------------------- delete form ----------------------------->
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



    <!--------------------------------------------------------------- gsap link
        -------------------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>
    
    <!--------------------------------------------------------------- ajax link
        -------------------------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    
    <!----------------------------------------------------------------- js links
        --------------------------------------------------------------->
    <script src="js/firms.js"></script>
    <script src="js/dashboard.js"></script>
    
    <!---------------------------------------------------------------- sweet-alert link 
        ----------------------------------------------------------------->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <!---------------------------------------------------------------- bootstrap js link
        ------------------------------------------------------------------>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    


    <!--------------------------------------- show Firms table 
        ------------------------------>
    <script type="text/javascript">
        $(document).ready(function(){
            showFirms();
        });
        
        function showFirms() {
            var readfirms = "readfirms";
            $.ajax({
                url:"action_firms.php",
                type:"post",
                data:{ readfirms:readfirms },
                success:function(data,status){
                    $('#firms_records').html(data);
                }
            });
        }
    </script>



    <!--------------------------------------- email validaton
        --------------------------------->
    <script type="text/javascript">
        function validateEmail($email) {
           var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
           return emailReg.test( $email );
        }
    </script>



    <!-------------------------------------------- firm add ajax request 
        -------------------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#form1", function (e) {
        e.preventDefault();

        var clg_id       = $("#clg_id").val();
        var firm_name    = $("#firm_name").val();
        var owner_name   = $("#owner_name").val();
        var firm_email   = $("#firm_email").val();
        var firm_mobile  = $("#firm_mobile").val();
        var firm_address = $("#firm_address").val();


       if(firm_name.trim() == "" || owner_name.trim() == "" || firm_address.trim()==""){
          swal("Oops", "Whitesapces not allowed!", "warning");
        } else if (!validateEmail(firm_email)) {
          swal("Oops", "Please enter a valid Email Id!", "warning");
        } else if(firm_mobile.length!=10){
          swal("Oops", "Please enter a 10 digit mobile number!", "warning");
        } else if (!firm_name.match(/^[a-zA-Z& ]*$/) || !owner_name.match(/^[a-zA-Z ]*$/)) {
          swal("Oops", "Name should contain letters only!", "warning");
       }
        else {
          $.ajax({
            url:"action_firms.php",
            type: "POST",
            data: { add:1,firm_name:firm_name,owner_name:owner_name,firm_email:firm_email,firm_mobile:firm_mobile,firm_address:firm_address,clg_id:clg_id },
            success:function(data){
                var getmsgs=$.parseJSON(data);
                swal(""+getmsgs.title , ""+getmsgs.text ,""+getmsgs.icon);
                $("#firm_name").val("");
                $("#owner_name").val("");
                $("#firm_email").val("");
                $("#firm_mobile").val("");
                $("#firm_address").val("");
                reverse_add();
                showFirms();
            }
          });
        }
    });
        
    </script>


    <!------------------------------------- get the firm details to be updated 
        -------------------------------------->
    <script type="text/javascript">

    function getFirm(id) {

      $('#firm_id').val(id);

        $.post("action_firms.php", {
                id:id
            }, function (data,status) {

                var firm = JSON.parse(data);
                $('#name_firm').val(firm.firm_name);
                $('#name_owner').val(firm.owner_name);
                $('#email_firm').val(firm.firm_email);
                $('#mobile_firm').val(firm.firm_mobile);
                $('#address_firm').val(firm.firm_address);
            })  
      overlay_update();
    }
    </script>

    
    <!------------------------------------------------ firm update ajax request 
        -------------------------------->
    <script type="text/javascript">

    $(document).on("submit", "#form2", function (e) {
        e.preventDefault();

        var firm_id    =$('#firm_id').val();
        var name_firm  =$('#name_firm').val();
        var name_owner =$('#name_owner').val();
        var email_firm =$('#email_firm').val();
        var mobile_firm =$('#mobile_firm').val();
        var address_firm =$('#address_firm').val();


        if(name_firm.trim() == "" || name_owner.trim() == "" || address_firm.trim()==""){
          swal("Oops", "Whitesapces not allowed!", "warning");
        } else if (!validateEmail(email_firm)) {
          swal("Oops", "Please enter a valid Email Id!", "warning");
        } else if (!name_firm.match(/^[a-zA-Z& ]*$/) || !name_owner.match(/^[a-zA-Z ]*$/)) {
          swal("Oops", "Name should contain letters only!", "warning");
        } else if(mobile_firm.length!=10){
          swal("Oops", "Please enter a 10 digit mobile number!", "warning");
        }
        else {
          $.ajax({
            url:"action_firms.php",
            type: "POST",
            data: { upd:1,firm_id:firm_id,name_firm:name_firm,name_owner:name_owner,email_firm:email_firm,mobile_firm:mobile_firm,address_firm:address_firm },
            success:function(result){
                var response=$.parseJSON(result);
                swal(""+response.title , ""+response.text ,""+response.icon);
                reverse_update();
                showFirms();
            }
          });
        }
    });

    </script>

    <!----------------------------------- overlay for delete in-out ------------------------>

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



    <!------------------------------------- delete firm get id to be deleted
        ----------------------------->
    
    <script type="text/javascript">

    function delFirm(delid) {

        $('#deleteid').val(delid);

        overlay_delete();
    }
    </script>



    <!----------------------------------------- firm delete ajax request 
        ----------------------------------->
    <script type="text/javascript">
    
    $(document).on("submit", "#deleteform", function (e) {
        e.preventDefault();

        var delid=$('#deleteid').val();          

        $.ajax({
            url:"action_firms.php",
            type: "POST",
            data: { del:1,delid:delid },
            success:function(result){
                var response=$.parseJSON(result);
                swal(""+response.title , ""+response.text ,""+response.icon);
                reverse_delete();
                showFirms();
            }
          });
    });
        
    </script>



    



    <!---------------------------------------- get the firm details to send email 
        -------------------------------------->
    <script type="text/javascript">

    function getMail(id) {

      $('#firm_ids').val(id);

        $.post("action_firms.php", {
                id:id
            }, function (data,status) {

                var firms = JSON.parse(data);
                $('#name_firms').val(firms.firm_name);
                $('#name_owners').val(firms.owner_name);
                $('#email_firms').val(firms.firm_email);
            })  
      overlay_email();
    }
    </script>

    
    <!------------------------------------------ send mail to firm ajax request 
        --------------------------------------->
    <script type="text/javascript">

    $(document).on("submit", "#emailform", function (e) {
        e.preventDefault();

        var our_email=$('#our_email').val();
        var to_email =$('#email_firms').val();
        var subject  =$('#subject').val();
        var body     =$('#body').val();
        var firm_name=$('#name_firms').val();


        if(subject.trim() == "" || body.trim() == ""){
          swal("Oops", "Whitesapces not allowed!", "warning");
        } else if (!validateEmail(to_email) || !validateEmail(our_email)) {
          swal("Oops", "Please enter a valid Email Id!", "warning");
        } else if(!subject.match(/^[a-zA-Z& ]*$/)){
          swal("Oops", "Subject should contain letters only!", "warning");
        }
        else {
            $("#emailsentbtn").prop('disabled', true);
            $('#emailsentbtn').val("Please wait");
          $.ajax({
            url:"action_firms.php",
            type: "POST",
            data: { send:1,our_email:our_email,to_email:to_email,subject:subject,body:body,firm_name:firm_name },
            success:function(result){
                var response=$.parseJSON(result);
                swal(""+response.title , ""+response.text ,""+response.icon);
                $('#subject').val("");
                $('#body').val("");
                reverse_email();
                showFirms();
                $("#emailsentbtn").prop('disabled', false);
                $('#emailsentbtn').val("Send");
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
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>


</body>

</html>