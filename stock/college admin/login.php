<?php require "../config/config.php";
//start session
session_start();

//check if college admin already logged in
if (!isset($_SESSION['is_ca_login'])) {   
    //keep on the login page
}else{
    //redirect to dashboard
    header("Location: home");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <title>College Admin Login | Stockplie</title>

    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/login.css">
    
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
                <!-- Generator: sketchtool 46.2 (44496) - http://www.bohemiancoding.com/sketch -->
                <!-- <title>610DB696-9225-4F91-9183-981111765968</title> -->
                <desc>Created with sketchtool.</desc>
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
                        <h2 id="text_left">COLLEGE ADMIN</h2>
                        <p id="text_left">Enter your details and start journey with us.</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form_base">
                        <h1>LOGIN HERE</h1>


                        <div class="main_form">
                            <!------------------------------------------------email & password--------------------------->
                            <form id="loginform" method="POST" autocomplete="off">
                                <div class="input_box">
                                    <input type="email" id="clg_admin_email" value="<?php if(isset($_COOKIE["clg_email"])) { echo $_COOKIE["clg_email"]; } ?>" autocomplete="off" required>
                                    <label>Email ID</label>
                                </div>
                                <div class="input_box">
                                    <input type="password" id="pass" autocomplete="current-password" required>
                                    <label>Password</label>

                                    <span toggle="#pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <!------------------------------------------------ Remember me--------------------------->

                                <div class="remember-me">
                                    <label class="container-check">Remember me
                                        <input id="remembers" type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>




                                <!-----------------------------------------------------submit button------------------------------------->

                                <button type="submit" class="log-btn">Submit</button>
                            </form>
                        </div>

                        <div class="copyright">
                            <p>All Rights Reserved by &copy;STOCKPILE,2020</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- back button -->

        <div class="down">
            <ul class="back_btn">
                <li class="back"><a href="../"><i class="fas fa-arrow-circle-left"></i>BACK</a>
                </li>
            </ul>
        </div>


    </div>



    <!--------------------------------------------------gsap link----------------------------------------------------------->

    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>






    <!--------------------------------------------------bootstrap js link----------------------------------------------------------->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

    <!--------------------------------------------------js link----------------------------------------------------------->


    <script src="js/login.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>



    <!---------------------------------------------------- sweet-alert link ------------------------------------------------->
    <!---
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>




    <script type="text/javascript">
        function validateEmail($email) {
           var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
           return emailReg.test( $email );
        }
    </script>


    <!---------- Login ajax request ------------------>
    <script type="text/javascript">
        
    $(document).on("submit", "#loginform", function (e) {
        e.preventDefault();

        var clg_admin_email=$('#clg_admin_email').val();
        var clg_admin_password=$('#pass').val();

        //var remember=document.getElementById("remember").checked;

        if (document.getElementById("remembers").checked==true) {
            var testing=0;
        }
        if (document.getElementById("remembers").checked==false) {
            var testing=1;
        }

        if(clg_admin_email.trim() == "" || clg_admin_password.trim() == ""){
          swal.fire("Oops", "Whitesapces Not Allowed!", "warning");
        } else if (!validateEmail(clg_admin_email)) {
          swal.fire("Oops", "Please Enter a Valid Email ID!", "warning");
        }
        else {
          $.ajax({
            url:"action_login.php",
            type: "POST",
            data: { login:1,clg_admin_email:clg_admin_email,clg_admin_password:clg_admin_password,testing:testing },
            success:function(results){
                var get=$.parseJSON(results);
                
                if (get.icon=="error"){
                    swal.fire(""+get.title , ""+get.text ,""+get.icon);
                }else if (get.icon=="success") {

                    const Toast = Swal.mixin({
                       toast: true,
                       position: 'top-end',
                       showConfirmButton: false,
                       timer: 2000,
                       timerProgressBar: true,
                       onOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                    icon: 'success',
                    title: 'Signed in successfully'
                    }).then(function () {
                           window.location.href = "home";
                        });
                    }
                }
            });
        }
    });
        
    </script>

    
</body>

</html>