<?php require "../config/config.php"; ?>
<?php
     session_start();
     if ($_SESSION['is_sa_login']) {
      //keep user on this page
     }
     else{
      //redirect to login page
      header("Location: login");
     }  
?>
<!DOCTYPE html>
<html>
<head>
	<title>notify</title>
	<!--------------------------------------------------bootstrap css link----------------------------------------------------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<center><h1>Notificantions</h1></center>
		<form id="notify" method="POST" autocomplete="off">

			<input type="hidden" id="type" value="1">

			<label>Title</label>
			<input type="text" class="form-control" id="notify_title" placeholder="Enter title" required><br>

			<label>College Admin of</label>
			<select id="clg_id" class="form-control" required>
	            <?php
	                $query = "SELECT * FROM  college";
	                $fire = mysqli_query($con,$query) or die("can not display data from database. ".mysqli_error($con));?>
	                	<option value="" disabled selected>Select College</option>
	                <?php
	                    while ($rows = mysqli_fetch_array($fire)) {
	                ?>
	                    <option value="<?= $rows['clg_id']; ?>"><?php echo $rows['clg_name']; ?></option>
	                <?php
	            }?>
	        </select><br>
	        
	        <label>Message</label>
			<input type="text" id="notify_message" class="form-control" placeholder="type something" required><br>

			<input class="btn btn-success" type="submit" value="Send">
		</form>
	</div>


	<!--------------------------------------------------bootstrap js link----------------------------------------------------------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>



	<!---------- clg admin add ajax request ------------------>
    <script type="text/javascript">
        
    $(document).on("submit", "#notify", function (e) {
        e.preventDefault();

        var type		 	= parseInt($("#type").val());
        var notify_title 	= $("#notify_title").val();
        var notify_message  = $("#notify_message").val();
        //var from  		= $("#from").val();
        var clg_id 			= $("#clg_id").val();


       if(notify_title.trim() == "" || notify_message.trim() == ""){
          swal("Oops", "Whitesapces Not Allowed!", "warning");
        } else if(!notify_title.match(/^[a-zA-Z ]*$/) || !notify_message.match(/^[a-zA-Z ]*$/)){
          swal("Oops", "Only letters & whitesapces allowed!", "warning");
        }
        else {
          $.ajax({
            url:"action_notifications.php",
            type: "POST",
            data: { add:1,type:type,notify_title:notify_title,notify_message:notify_message,clg_id:clg_id },
            success:function(data){
                var getmsgs=$.parseJSON(data);
                alert(""+getmsgs.title , ""+getmsgs.text ,""+getmsgs.icon);
                //swal(""+getmsgs.title , ""+getmsgs.text ,""+getmsgs.icon);
                $("#notify_title").val("");
                $("#notify_message").val("");
                $("#clg_id").val("");
                //reverse_add();
                //showCollegeadmins();
            }
          });
        }
    });
        
    </script>
</body>
</html>