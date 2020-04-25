<?php require "../config/config.php"; ?>
<?php
     session_start();
     //if ($_SESSION['is_sa_login']) {
      //keep user on page
     //}
     //else{
      //redirect on loginpage
      //header("Location: super_admin_login_register.php");
     //}  
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Profile</title>
    <!------------------------------------------------css link--------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/super_admin_profile.css">

    <!--------------------------------------------------bootstrap css link----------------------------------------------------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!--------------------------------------------------font asesome link----------------------------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <!--------------------------------------------------google fonts link----------------------------------------------------------->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins:300&display=swap" rel="stylesheet">



    <script>
        (function (e, t, n) {
            var r = e.querySelectorAll("html")[0];
            r.className = r.className.replace(/(^|\s)no-js(\s|$)/, "$1js$2")
        })(document, window, 0);
    </script>
</head>

<body>
    <div class="main_profile">
        <div class="heading_pro">
            <h1>YOUR PROFILE</h1>
            <img src="images/face.jpg" class="pro_pic">
        </div>


        <div class="details">
            <div class="left_content">
                <h3>Name :</h3>
                <h3>Email ID :</h3>
            </div>
            <div class="right_content">
                <h3>Kaushik Kamal Bordoloi</h3>
                <h3>superadmin@gmail.com</h3>
            </div>
        </div>
        <div class="up_re_btn">
            <a id="up_pro" name="update" href="#" onclick="update_pro()">Update Profile</a>
            <a id="re_pass" href="#">Reset Password</a>
        </div>
    </div>


    <div class="update_profile_page" id="update">
        <!-- <h1>update profile</h1> -->
        <div class="heading_pro">
            <h1>UPDATE PROFILE</h1>
<!---------------------------------php---------------------------->
<?php
         $query   = "SELECT * FROM super_admin WHERE sup_admin_id=1";
         $fire    = mysqli_query($con,$query) or die("can not fetch data.".mysqli_error($con));
         
         $sup_admin  = mysqli_fetch_assoc($fire);
?>



            <!--<img src="images/face.jpg" class="pro_pic">--->
            <?php echo '<img src="'.$sup_admin["sup_admin_img_link"].'" class="pro_pic">';?>

            <div class="box">

                <input type="file" name="file-2[]" id="file-2" class="inputfile inputfile-2"
                    data-multiple-caption="{count} files selected" multiple />
                <label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                        <path
                            d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                    </svg> <span>upload image</span></label>
            </div>
        </div>


        <div class="main_update">
            <form action="" method="POST">
                <p>Name</p>
                <div class="input-group" id="text-field">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <a href="#">
                                <i class="fas fa-envelope-open-text"></i>
                            </a>
                        </div>
                    </div>
                    <input type="text" value="<?php echo $sup_admin['sup_admin_name'] ?>" class="form-control" >
                </div>

                <p>Email ID</p>
                <div class="input-group" id="text-field">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <a href="#">
                                <i class="fas fa-envelope-open-text"></i>
                            </a>
                        </div>
                    </div>
                    <input type="email" value="<?php echo $sup_admin['sup_admin_email'] ?>" class="form-control" >
                </div>
              <div class="update_btn"><input type="submit" value="Update"></div>
                
            </form>

        </div>
    </div>


    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
    <!-- <script src="js/dashboard.js"></script>-->
    <script src="js/super_admin_update.js"></script>



    <!--------------------------------------------------bootstrap js link----------------------------------------------------------->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>