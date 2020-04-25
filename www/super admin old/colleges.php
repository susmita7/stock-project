<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AAU|colleges</title>
    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/colleges.css">
    <!--------------------------------------------------google fonts link----------------------------------------------------------->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins:300&display=swap" rel="stylesheet">

    <style>


    </style>
</head>

<body>


    <div class="college">
        <div class="heading_add_btn">
        <h1>Colleges Under Assam Agriculture University</h1>
        <a id="add_clg" href="#" onclick="overlay_add()">Add College</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">College ID</th>
                        <th scope="col">College Name</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo "1" ?></td>
                        <td><?php echo "susmita" ?></td>
                        <td><a id="up_clg" class="editbtn" href="#" onclick="overlay_update()">Update</a></td>
                    </tr>
                    <tr>
                        <td><?php echo "1" ?></td>
                        <td><?php echo "priya" ?></td>
                        <td><a id="up_clg" class="editbtn" href="#" onclick="overlay_update()">Update</a></td>
                    </tr>
                </tbody>
            </table>

        </div>
        
    </div>


    <div class="overlay_add" id="overlay-add">
        <a id="cross" onclick="reverse_add()"><i class="fas fa-times-circle"></i></a>
        <div class="add_clg_base_div">
            <div class="heading_for_add_clg">
                <h1>Add College</h1>
            </div>


            <div class="main_add_clg">
                <form action="" method="POST">
                    <p>College Name</p>
                    <div class="input-group" id="text-field">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <a>
                                    <i class="fas fa-envelope-open-text"></i>
                                </a>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="college name">
                    </div>
                    <div class="add_clg_btn"><input type="submit" value="Submit"></div>

                </form>

            </div>
        </div>
    </div>





    <div class="overlay_update" id="overlay-update">
        <a id="cross" onclick="reverse_update()"><i class="fas fa-times-circle"></i></a>

        <div class="add_clg_base_div">
            <div class="heading_for_add_clg">
                <h1>Update College</h1>

            </div>
            <div class="main_add_clg">
                <form action="" method="POST">
                    <p>College Name</p>
                    <div class="input-group" id="text-field">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <a>
                                    <i class="fas fa-envelope-open-text"></i>
                                </a>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="college name" id="clg_name">
                    </div>
                    <div class="add_clg_btn"><input type="submit" value="submit"></div>

                </form>

            </div>
        </div>
    </div>





    <!-- script  -->
    <!--------------------------------------------------gsap link----------------------------------------------------------->

    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js"></script>


    <script src="js/college.js"></script>

    <!--------------------------------------------------bootstrap js link----------------------------------------------------------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>






</body>

</html>