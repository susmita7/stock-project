<?php require "../config/config.php"; ?>
<?php
     session_start();
     if ($_SESSION['is_ca_login']) {
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
	<title>Notify</title>
	<!--------------------------------------------------bootstrap css link----------------------------------------------------------->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
		<h1>Notifications</h1>
		<div id="notify_records">
		</div>
	</div>
<!---
	<div class="container">

        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
		  <div class="toast-header">
		    <svg class="rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice"
		      focusable="false" role="img">
		      <rect fill="#007aff" width="100%" height="100%" /></svg>
		    <strong class="mr-auto">Bootstrap</strong>
		    <small class="text-muted">just now</small>
		    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
		      <span aria-hidden="true">&times;</span>
		    </button>
		  </div>
		  <div class="toast-body">
		    See? Just like this.
		  </div>
		</div>

		<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
		  <div class="toast-header">
		    <svg class="rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice"
		      focusable="false" role="img">
		      <rect fill="#007aff" width="100%" height="100%" /></svg>
		    <strong class="mr-auto">Bootstrap</strong>
		    <small class="text-muted">2 seconds ago</small>
		    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
		      <span aria-hidden="true">&times;</span>
		    </button>
		  </div>
		  <div class="toast-body">
		    Heads up, toasts will stack automatically
		  </div>
		</div>
	</div>
	------------------->

	<!------------------------------
		--------------------bootstrap js link---------------------------------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!--------------------------------------- show department admin table 
        --------------------------------------->
    <script type="text/javascript">
    	//$('.toast').toast('show');
    	
        $(document).ready(function(){
            showNotifications();
        });
        
        function showNotifications() {
            var readnotify = "readnotify";
            $.ajax({
                url:"action_notifications.php",
                type:"post",
                data:{ readnotify:readnotify },
                success:function(data,status){
                    $('#notify_records').html(data);
                }
            });
        }
    </script>

</body>
</html>