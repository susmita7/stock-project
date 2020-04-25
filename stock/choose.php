<?php require "./config/config.php";
session_start();

if (!isset($_SESSION['is_da_login'])){
    //keep on the page
}else{   
    //redirect on home page
    header("Location: ./department admin/home");
}

if (!isset($_SESSION['is_eu_login'])){
    //keep on the page
}else{   
    //redirect on home page
    header("Location: ./expert user/home");
}  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <title>Choose College & Department | Stockpile</title>

    <!--------------------------------------------------css 
        link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/clg_dept_form.css">
    <link rel="stylesheet" type="text/css" href="css/mq_clg_dept_form.css">


    <!--------------------------------------------------font asesome 
        link------------------------------>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

    <!--------------------------------------------------google fonts 
        link------------------------------->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins:300&display=swap" rel="stylesheet">

    <!--------------------------------------------------MDB css 
        link-------------------------------------------------->
    <link rel="stylesheet" href="css/mdb.min.css">

</head>

<body>

    <!----------------------------------- main div ------------------------------------------->
    <div class="wrapper">

        <!------------------------------ background div --------------------------------------->
        <div class="top_image_bg">

            <!------------------------------------------ start svg ------------------------------------------------->
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
            <!------------------------- end of svg ------------------------------------------------>
        </div>
        <!----------------------------- end of background div ------------------------------------>


        <!------------------------------------- form div ------------------------------------------->

        <div class="base">

            <div class="heading_form">

                <div class="heading_text">
                    <h1 id="text_left">STOCKPILE</h1>
                    <p id="text_left">Enter your details and start journey with us.</p>
                </div>

                <div class="form_base">
                    <h1>College And</h1>
                    <h2>Department selection</h2>


                    <div class="main_form">

                        <!----------------------------college and department selection form--------------------------->
                        <form id="chooseform" method="POST" autocomplete="off">
                            <div class="input_box">
                                
                                <!--Blue select-->
                                <select class="mdb-select md-form colorful-select dropdown-primary" id="clg_id" name="clg_id" onchange="myfunc(this.value)" required>
                                    <option value="" disabled selected>Select College</option>
                                <?php
                                    $query = "SELECT * FROM college";
                                    $fire = mysqli_query($con,$query);
                                    while ($rows = mysqli_fetch_array($fire)) {
                                ?>
                                    <option value="<?php echo $rows['clg_id']; ?>"><?php echo $rows['clg_name']; ?></option>
                                <?php
                                    }
                                ?>
                                </select>

                                <!--/Blue select-->
                            </div>

                            <div class="input_box">
                                
                                <!--Blue select-->
                                <select class="mdb-select md-form colorful-select dropdown-primary" name="dept_name" id="dept_name" required>
                                    <option value="" disabled selected>Select Department</option>
                                </select>

                                <!--/Blue select-->
                            </div>

                            <!-------------------------  submit button  -------------------------->

                            <button type="submit" name="next_btn" class="log-btn">NEXT</button>
                        </form>
                        
                    </div>

                    <div class="copyright">
                        <p>All Rights Reserved by &copy;STOCKPILE,2020</p>
                    </div>

                </div>
            </div>
        </div>
        <!---------------------------------------- end of form div ---------------------------------->

        <!-- back button -->

        <div class="down">
            <ul class="back_btn">
                <li class="back">
                    <a href="/stock"><i class="fas fa-arrow-circle-left"></i>BACK</a>
                </li>
            </ul>
        </div>
    </div>











    
    <!--------------------------------------------------gsap link----------------------------------------------------------->
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>



    <!--------------------------------------------------bootstrap js link----------------------------------------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <!--------------------------------------------------js 
    link----------------------------------------------------------->
    <script src="js/login.js"></script>

    <!--------------------------------------------------MDB js link----------------------------------------------------------->
    <script src="js/mdb.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.mdb-select').materialSelect();
        });
    </script>

    <!------------------------------ get the depts after choosing college
        --------------------------->
    <script type="text/javascript">
        function myfunc(datavalue) {
            $.ajax({
                url:'action_choose.php',
                type:'POST',
                data: { add:1,datavalue:datavalue },
                success: function (result) {
                    $('#dept_name').html(result);
                }
            });
        }
    </script>

    <!------------------------------- check if this clg-dept combination exist and redirect to dept login page
        ----------------------------------------------------------------->
    <script type="text/javascript">
        
    $(document).on("submit", "#chooseform", function (e) {
        e.preventDefault();

        var clg_id=$('#clg_id').val();
        var dept_name=$('#dept_name').val();

        //check if dept_name is empty

        if(clg_id.trim() == "" || dept_name.trim() == ""){
          swal.fire("Oops", "Cannot be empty!", "warning");
        }
        else {
          $.ajax({
            url:"action_choose.php",
            type: "POST",
            data: { choose:1,clg_id:clg_id,dept_name:dept_name },
            success:function(results){
                var get=$.parseJSON(results);
                if (get.icon=="error"){
                    swal.fire(""+get.title , ""+get.text ,""+get.icon);
                }else if (get.icon=="success") {
                    window.location.href = "dept_login";
                }
            }
        })
      }
    });
        
    </script>


</body>

</html>