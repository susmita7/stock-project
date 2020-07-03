<?php require "../config/config.php";
//start session
session_start();

//check if super admin already logged in
if (!isset($_SESSION['is_da_login'])) {   
    //keep on the login page
}else{
    //redirect to dashboard
    header("Location: home");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <title>Department Admin Forgot Password | Stockpile</title>



    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/fp.css">


    <!--------------------------------------------------bootstrap css link----------------------------------------------------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!--------------------------------------------------font asesome link----------------------------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <!--------------------------------------------------google fonts link----------------------------------------------------------->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins:300&display=swap" rel="stylesheet">
</head>

<body>

    <div class="wrapper">
        <div class="top_image_bg">
            <svg width="1440px" height="785px" viewBox="0 0 1440 785" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none">

                <defs>
                    <path
                        d="M0.5,26.6599763 C245.403335,110.34268 459.693754,152.184031 643.371256,152.184031 C918.887508,152.184031 1020.98757,1.15256904e-14 1285.21638,0 C1461.36892,0 1662.8327,62.9471662 1889.60771,188.841499 L1812.64786,805 L277.203568,805 L0.5,26.6599763 Z"
                        id="path-1"></path>
                    <filter x="-0.4%" y="-1.0%" width="100.8%" height="102.0%" filterUnits="objectBoundingBox"
                        id="filter-3">
                        <feMorphology radius="5" operator="erode" in="SourceAlpha" result="shadowSpreadInner1">
                        </feMorphology>
                        <feGaussianBlur stdDeviation="5" in="shadowSpreadInner1" result="shadowBlurInner1">
                        </feGaussianBlur>
                        <feOffset dx="0" dy="1" in="shadowBlurInner1" result="shadowOffsetInner1"></feOffset>
                        <feComposite in="shadowOffsetInner1" in2="SourceAlpha" operator="arithmetic" k2="-1" k3="1"
                            result="shadowInnerInner1"></feComposite>
                        <feColorMatrix
                            values="0 0 0 0 0.0235294118   0 0 0 0 0.0980392157   0 0 0 0 0.203921569  0 0 0 0.2 0"
                            type="matrix" in="shadowInnerInner1"></feColorMatrix>
                    </filter>
                </defs>
                <g id="Public-Content" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Home-Page">
                        <g id="Group-3" transform="translate(-312.000000, -20.000000)">
                            <mask id="mask-2" fill="white">
                                <use xlink:href="#path-1"></use>
                            </mask>
                            <g id="Rectangle-5"
                                transform="translate(945.053856, 402.500000) scale(1, -1) translate(-945.053856, -402.500000) ">
                                <use fill="rgba(2,136,209,0.8)" fill-rule="evenodd" xlink:href="#path-1"></use>
                                <use fill="black" fill-opacity="1" filter="url(#filter-3)" xlink:href="#path-1"></use>
                            </g>
                            <path
                                d="M-7.5,720.5 C102.833333,603.833333 241.833333,545.5 409.5,545.5 C661,545.5 775.5,630.5 1027,630.5 C1278.5,630.5 1533.5,435 1785,435 C1952.66667,435 2030.33333,487.675669 2018,593.027006 L2018,1259.15426 L6,1248.78705 L-7.5,720.5 Z"
                                id="Rectangle-5" fill-opacity="0.150000006" fill="#F9FBFD" mask="url(#mask-2)"></path>
                        </g>
                    </g>
                </g>
            </svg>
        </div>
        <div class="container heading_form">
            <div class="row">
                <div class="col-md-6">
                    <div class="heading_text">
                        <h1 id="text_left">Forgot Your Paasword?</h1>
                        <p id="text_left">Don't worry. Just follow the steps as given in the form.</p>
                    </div>
                </div>

                <!---------------------------------------send otp form------------------------->
                <div class="col-md-6">
                    <div class="form_base">



                        <div class="main_form">
                            
                            <!----------------------------email form--------------------------->


                            <form id="form1" method="POST" autocomplete="off">
                                <h1>Enter your valid email address to recieve a verification code.</h1>
                                
                                <div class="input_box">
                                    <input type="email" id="dept_admin_email" required>
                                    <label>Email Id</label>
                                </div>

                                <!-----------------------------------------submit button
                                    ---------------------------->

                                <input type="submit" id="emailsentbtn" class="log-btn" value="Submit">

                                <!-----------------------------------------login here
                                    --------------------------->
                                <div class="login_here">
                                    <a href="../department_login">Login here</a>
                                </div>
                            </form>



                            <!---------------------------------- OTP form 
                                -------------------------------->
                            
                            <form id="form2" method="POST" autocomplete="off">
                                <h1>Enter the verification code which was sent to your entered email address.</h1>
                                
                                <div class="input_box">
                                    <input type="hidden" id="otp_id" required>
                                    <input type="number" id="otp" required>
                                    <label>Verification code</label>
                                </div>
                                
                                <div class="expire">
                                    <h2>Your code will expire in : 10 mins</h2>
                                </div>

                                <!-----------------------------------------------------submit button
                                    ------------------------------------->

                                <input type="submit" class="log-btn" value="Submit">

                                <!-----------------------------------------login here
                                    --------------------------->
                                <div class="login_here">
                                    <a href="../department_login">Login here</a>
                                </div>
                            </form>



                            <!----------------------------------------reset password form
                                --------------------------->
                            <form id="form3" method="POST" autocomplete="off">
                                <h1>Now you're ready to Reset your password.</h1>

                                <input type="hidden" id="dept_admins_id" required>


                                <div class="input_box">
                                    <input type="password" id="pass1" required>
                                    <label>New password</label>

                                    <span toggle="#pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>


                                <div class="input_box">
                                    <input type="password" id="pass2" required>
                                    <label>Confirm password</label>
                                </div>

                                <!-----------------------------------------------------submit button------------------------------------->


                                <input type="submit" class="log-btn" value="Reset password">

                                <!-----------------------------------------login here
                                    --------------------------->
                                <div class="login_here">
                                    <a href="../department_login">Login here</a>
                                </div>
                            </form>



                        </div>



                    </div>
                </div>
            </div>
        </div>
        <!-- back button -->

        <div class="down">
            <ul class="back_btn">
                <li class="back"><a href="../department_login"><i class="fas fa-arrow-circle-left"></i>BACK</a>
                </li>
            </ul>
        </div>


    </div>

    <!--------------------------------------------------gsap link----------------------------------------------------------->

    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>



    <!--------------------------------------------------bootstrap js link----------------------------------------------------------->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>




    <!--------------------------------------------------js
        ----------------------------------------------------------->
    <script type="text/javascript">
        let tl_1 = gsap.timeline({
            defaults: {
                duration: 1.1
            }
        });

        tl_1.from('#text_left', {
            opacity: 0,
            y: -100,
            stagger: .4
        })


        $(".toggle-password").click(function () {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });


        /*
        function get_form2() {
            $('#form1').css('display', 'none');
            $('#form2').css('display', 'block');
        }

        function get_form3() {
            $('#form2').css('display', 'none');
            $('#form3').css('display', 'block');
        }
        */
    </script>





    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <!------------------------------------------------------- js link
        ------------------------------------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!---------------------------------------------------------  ajax link
        ----------------------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <!-------------------------------------------------------  sweet alert
        ----------------------------------------------------------->
    <!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>



    <!-------------------------------------------------- email validation
        ------------------------------------------>

    <script type="text/javascript">
        function validateEmail($emails) {
           var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
           return emailReg.test( $emails );
        }
    </script>



    <!------------------------------ send otp ajax request
        ------------------------------->

    <script type="text/javascript">

    $(document).ready(function (e){
        $( "#form1").on('submit', function (e) {
            e.preventDefault();

            var dept_admin_email=$('#dept_admin_email').val();
       
            if (!validateEmail(dept_admin_email)) {  
                swal.fire("Oops", "Please enter a valid Email Id", "warning");
            } else if (dept_admin_email.trim() == "") { 
                swal.fire("Oops", "Email cannot be empty!", "warning");
            } 
            else {

              $("#emailsentbtn").prop('disabled', true);
              $('#emailsentbtn').val("Please wait");
                
              $.ajax({
                    url:"action_forgot_password.php",
                    type: "POST",
                    data: { sendotp:1,dept_admin_email:dept_admin_email },
                    success:function(result){
    
                        $('#dept_admin_email').val("");
                        $("#emailsentbtn").prop('disabled', false);
                        $('#emailsentbtn').val("Submit");
                        
                        var respon=$.parseJSON(result);

                        if (respon.icon=="error"){
                            swal.fire(""+respon.title , ""+respon.text ,""+respon.icon);
                        }else if (respon.icon=="success") {

                            $('#form1').css('display', 'none');
                            //$('#form2').animate({height: "toggle", opacity: "toggle"}, "slow");
                            $('#form2').css('display', 'block');
                            $('#otp_id').val(respon.currentid);
                        }
                        
                    }
                });
            }
        });
    });        
    </script>




    <!------------------------------ otp submit ajax request
        ------------------------------->

    <script type="text/javascript">

    $(document).ready(function (e){
        $( "#form2").on('submit', function (e) {
            e.preventDefault();

            var otp_id=$('#otp_id').val();
            var otp_val=$('#otp').val();
       
            if (otp_val.trim() == "") { 
            swal.fire("Oops", "OTP cannot be empty!", "warning");
            } 
            else {
                $.ajax({
                    url:"action_forgot_password.php",
                    type: "POST",
                    data: { otp:1,otp_id:otp_id,otp_val:otp_val },
                    success:function(result){
                        
                        var respon=$.parseJSON(result);

                        if (respon.icon=="error"){
                            swal.fire(""+respon.title , ""+respon.text ,""+respon.icon);
                        }else if (respon.icon=="success") {

                            $('#form2').css('display', 'none');
                            //$('#form3').animate({height: "toggle", opacity: "toggle"}, "slow");
                            $('#form3').css('display', 'block');
                            $('#dept_admins_id').val(respon.id);
                        }
                        
                        $('#otp').val("");
                        //$('#otp_id').val("");
                        
                    }
                });
            }
        });
    });        
    </script>


    <!------------------------------ reset password ajax request
        ------------------------------->

    <script type="text/javascript">

    $(document).ready(function (e){
        $( "#form3").on('submit', function (e) {
        e.preventDefault();

        var dept_admin_id=$('#dept_admins_id').val();
        var dept_admin_password=$('#pass1').val();
        var dept_admin_password2=$('#pass2').val();
        
       
       if(dept_admin_password.trim() == "" || dept_admin_password2.trim() == ""){
            swal.fire("Oops", "Password cannot be empty!", "warning");
        } else if (dept_admin_password.length<4 || dept_admin_password2.length<4) { 
          swal.fire("Oops", "Password length is too short!", "warning");
        } else if (dept_admin_password!=dept_admin_password2) { 
          swal.fire("Oops", "Password mismatched!", "warning");
        }
        else {
        
          $.ajax({
            url:"action_forgot_password.php",
            type: "POST",
            data: { resetpassword:1,
                    dept_admin_id:dept_admin_id,
                    dept_admin_password:dept_admin_password
                  },
            success:function(result){
                
                    var respon=$.parseJSON(result);
                    //$('#pass1').val("");
                    //$('#pass2').val("");

                    swal.fire(""+respon.title , ""+respon.text ,""+respon.icon).then(function () {
                        window.location.href = "../department_login";  
                    });
                }
                });
            }
        });
    });        
    </script>


</body>

</html>