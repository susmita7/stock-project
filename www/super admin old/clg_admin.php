<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AAU|colleges</title>
    <!--------------------------------------------------css link----------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/clg_admin.css">
</head>

<body>

    <div class="college">
    <div class="heading_add_btn">
        <h1>College Admins of AAU</h1>
        <a id="add_clg" href="#" onclick="overlay_add()">Add Admin</a>
</div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">College Admin ID</th>
                        <th scope="col">College Admin Name</th>
                        <th scope="col">College Admin Email</th>
                        <th scope="col">College Admin Password</th>
                        <th scope="col">College Admin Ph.No</th>
                        <th scope="col">College Admin pic</th>
                        <th scope="col">College ID</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo "1" ?></td>
                        <td><?php echo "college admin" ?></td>
                        <td><?php echo "clgadmin@gmail.com" ?></td>
                        <td><?php echo "1234" ?></td>
                        <td><?php echo "908957586" ?></td>
                        <td><?php echo "" ?></td>
                        <td><?php echo "1" ?></td>
                        <td><a id="up_clg" href="#" class="editbtn" onclick="overlay_update()">Update</a></td>
                        <td><a id="del_ad" href="#">Delete</a></td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Mark</td>
                        <td>Mark</td>
                        <td>Mark</td>
                        <td>Mark</td>
                        <td>Mark</td>
                        <td><a id="up_clg" href="#" class="editbtn" onclick="overlay_update()">Update</a></td>
                        <td><a id="del_ad" href="#">Delete</a></td>
                    </tr>
                </tbody>
            </table>

        </div>
        


    </div>




    <div class="overlay_add" id="overlay-add">
        <a id="cross" onclick="reverse_add()"><i class="fas fa-times-circle"></i></a>
        <div class="add_clg_base_div">
            <div class="heading_for_add_clg">
                <h1>Add College Admin</h1>
            </div>

            <div class="main_add_clg">
                <form action="" method="POST">


                    <p>College Admin's Name</p>
                    <div class="input-group" id="text-field">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <a>
                                    <i class="fas fa-envelope-open-text"></i>
                                </a>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="college admin's name">
                    </div>


                    <p>College Admin's Email</p>
                    <div class="input-group" id="text-field">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <a>
                                    <i class="fas fa-envelope-open-text"></i>
                                </a>
                            </div>
                        </div>
                        <input type="email" class="form-control" placeholder="college admin's email">
                    </div>


                    <p>College Admin's Password</p>
                    <div class="input-group" id="text-field">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <a>
                                    <i class="fas fa-envelope-open-text"></i>
                                </a>
                            </div>
                        </div>
                        <input type="password" class="form-control" placeholder="password">
                    </div>


                    <p>Confirm Password</p>
                    <div class="input-group" id="text-field">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <a>
                                    <i class="fas fa-envelope-open-text"></i>
                                </a>
                            </div>
                        </div>
                        <input type="password" class="form-control" placeholder="confirm password">
                    </div>


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

        <div class="up_clg_ad_base_div">
            <div class="heading_for_add_clg">
                <h1>Update College Admin</h1>

            </div>
            <div class="main_add_clg">
                <form action="" method="POST">
                    <p>College Admin's Name</p>
                    <div class="input-group" id="text-field">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <a>
                                    <i class="fas fa-envelope-open-text"></i>
                                </a>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="college admin's name" id="admin_name">
                    </div>
                    <p>College Admin's Email</p>
                    <div class="input-group" id="text-field">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <a>
                                    <i class="fas fa-envelope-open-text"></i>
                                </a>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="name" id="college admin's email">
                    </div>
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



        <!-- script  -->
        <!--------------------------------------------------gsap link----------------------------------------------------------->

        <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js">
        </script>


        <script src="js/college_admin.js"></script>

        <!--------------------------------------------------bootstrap js link----------------------------------------------------------->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
        </script>
</body>

</html>