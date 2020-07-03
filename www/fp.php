<!DOCTYPE html>
<html>
<head>
	<title>CA Forgot Password</title>
	<style type="text/css">
		@import url(https://fonts.googleapis.com/css?family=Roboto:300);

.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  /*background: #4CAF50;*/
  background: #0abde3;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  /*background: #43A047;*/
  background: #0984e3;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  /*color: #4CAF50;*/
  color: #0abde3;
  text-decoration: none;
  font-size: 15px;
}
.form .register-form {
  display: none;
}

.form .register-form h4{
  color: #0abde3;
}

.form .reset-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  /*background: #76b852;*/ /* fallback for old browsers */
  background: #dfe6e9;
  /*background: -webkit-linear-gradient(right, #76b852, #8DC26F);
  background: -moz-linear-gradient(right, #76b852, #8DC26F);
  background: -o-linear-gradient(right, #76b852, #8DC26F);
  background: linear-gradient(to left, #76b852, #8DC26F);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;  */    
}
	</style>
</head>
<body>

	<!---------------------------------- forgot password form  ----------------------------->
	
	<div class="login-page">

  		<div class="form">

  			<!--------------------------- send otp form
  				--------------------------------->
    		
    		<form id="form1" class="login-form">

          <input type="email" placeholder="Enter Email Id">
				    
      		<button >Send OTP</button>
      			
          <p class="message"> <a type="button" onclick="get_form2()">Login Here</a></p>
    		</form>

    		<!---------------------------- otp submit form
    			------------------------------->

    		<form class="register-form" id="form2">
          <h1>Enter OTP</h1>
          <h4>check your email for the OTP</h4>
    			
          <input type="number" placeholder="Enter OTP">

          <button >Submit</button>
      		<p class="message"> <a type="button" onclick="get_form3()">Login here</a></p>
    		</form>

    		<!--------------------------- reset password form
    			----------------------------------->

    		<form class="reset-form" id="form3">
    			
    			<input type="Password" placeholder="Enter Password">
    			<input type="Password" placeholder="Confirm Password">
      			
          <button>Save</button>
      		<p class="message"> <a href="login">Login Here</a></p>
    		</form>
  		</div>
	</div>

	

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


    <script type="text/javascript">

      function get_form2() {
        $('#form1').css('display', 'none');
        //$('#form2').animate({height: "toggle", opacity: "toggle"}, "slow");
        $('#form2').css('display', 'block');      
      }

      function get_form3() {
        $('#form2').css('display', 'none');
        //$('#form2').animate({height: "toggle", opacity: "toggle"}, "slow");
        $('#form3').css('display', 'block');      
      }
      
             
	</script>




	


</body>
</html>