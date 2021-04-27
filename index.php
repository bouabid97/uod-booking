<!DOCTYPE html>
<html lang="en">
<head>
	<title>UOD Booking</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
            <?php
				session_start();
				if(isset($_POST['login']))
				{
					extract($_POST);
					include 'config.php';
					$sql=mysqli_query($conn,"SELECT * FROM students where neptun_code='$neptun_code' and password='$password'");
					$row  = mysqli_fetch_array($sql);
					if(is_array($row))
					{
						$_SESSION["neptun_code"]=$row['neptun_code'];
						header("Location: bookingPages/landing.php"); 
					}
					else
					{
						$login_err = "Invalid Neptun Code Or Password";
					}
				}
			?>
				<form class="login100-form validate-form" action="index.php" method="POST">
					<span class="login100-form-title p-b-26">
						Welcome
					</span>

					<div class="wrap-input100 validate-input" data-validate="Enter Neptun Code">
						<input class="input100" type="text" name="neptun_code" id="neptun_code">
						<span class="focus-input100" data-placeholder="Neptun Code"></span>
						<span class="invalid-feedback"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password" id="password">
						<span class="focus-input100" data-placeholder="Password"></span>
						<span class="invalid-feedback"></span>
					</div>
                    <div class="login-err">
					    <span>
					       <?php echo isset($login_err)?$login_err:""; ?>
					    </span>
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="login">
								Login
							</button>
						</div>
					</div>

				</form>

			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>