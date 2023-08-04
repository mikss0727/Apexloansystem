<!-- LOGIN PAGE -->

<!DOCTYPE html>
<html lang="en">
<head>
	<title>OPELOTRACK</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
  <link rel="icon" href="custom_assets/pic/logo.png" type="image/png">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login_assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login_assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login_assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="Login_assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login_assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login_assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="Login_assets/css/main.css">
<!--===============================================================================================-->
    <script src="Login_assets/vendor/sweetalert2/sweetalert2.min.js"></script>
<!--===============================================================================================-->
	<script src="Login_assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="login/login.js"></script>
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt style="margin-top: 10%;">
					
					<img src="Login_assets/images/logo.png" alt="IMG">
					<span class="login100-form-title" style="font-size: 2.5rem;">
						APEX FUNDING <br> CORPORATION
					</span>
				</div>

				<form class="login100-form validate-form"  id="login_form">
					<span class="login100-form-title">
						Welcome Back!
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Employee ID is required">
						<input class="input100" type="text" name="emp_id" id="emp_id" placeholder="Employee ID">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" id="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<input type="hidden" value="login" name="process">
						<button class="login100-form-btn"  id="login_btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="register/index.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="Login_assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="Login_assets/vendor/bootstrap/js/popper.js"></script>
	<script src="Login_assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="Login_assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="Login_assets/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="Login_assets/js/main.js"></script>

</body>
</html>