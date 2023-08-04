<!-- REGISTER / SIGNUP -->
<!DOCTYPE html>
<html lang="en">
<head>
	<title>OPELOTRACK</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../Login_assets/images/logo.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Login_assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Login_assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Login_assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../Login_assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Login_assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Login_assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="../Login_assets/css/main.css">
<!--===============================================================================================-->
    <script src="../Login_assets/vendor/sweetalert2/sweetalert2.min.js"></script>
<!--===============================================================================================-->
	<script src="../Login_assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="register.js"></script>
<!--===============================================================================================-->

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100" style=" padding: 95px 130px 33px 100px !important;">
				<div class="login100-pic js-tilt" data-tilt style="margin-top: 32%;">
					<img src="../Login_assets/images/img-01.jpg" alt="IMG">
					<span class="login100-form-title" style="font-size: 3.5rem;">
						OPELOTRACK
					</span>
				</div>

				<form class="login100-form validate-form" id="signup_form">
					<span class="login100-form-title">
						Sign Up
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Last Name is required">
						<input class="input100" type="text" name="last_name" id="last_name" placeholder="Last Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "First Name is required">
						<input class="input100" type="text" name="first_name" id="first_name" placeholder="First Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100" data-validate = "Middle Name is required">
						<input class="input100" type="text" name="middle_name" id="middle_name" placeholder="Middle Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100" data-validate = "Gender is required">
						<select class="input100" name="gender" id="gender">
                              <option value="">Select Gender...</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Employee ID is required">
						<input class="input100" type="text" name="emp_id" id="emp_id" placeholder="Employee ID" maxlength="6" onkeypress="return isNumberKey(event)">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required">
						<input class="input100" type="text" name="email_id" id="email_id" placeholder="Email ID">
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
					<div class="wrap-input100 validate-input" data-validate = "Repeat Password is required">
						<input class="input100" type="password" name="repeat_password" id="repeat_password" placeholder="Repeat Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<!-- proceess -->
                        <input type="hidden" value="register" name="process">
						<button class="login100-form-btn" id="signup_btn">
							Submit
						</button>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="../index.php">
							Login your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="../Login_assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../Login_assets/vendor/bootstrap/js/popper.js"></script>
	<script src="../Login_assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../Login_assets/vendor/select2/select2.min.js"></script>

<!--===============================================================================================-->
	<script src="../Login_assets/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="../Login_assets/js/main.js"></script>
</body>
</html>