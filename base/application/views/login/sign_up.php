
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= $title ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?php echo base_url()."assets/login/"; ?>images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/login/"; ?>vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/login/"; ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/login/"; ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/login/"; ?>vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/login/"; ?>vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/login/"; ?>vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/login/"; ?>vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/login/"; ?>vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/login/"; ?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/login/"; ?>css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" id="rgtn_form" action="<?= base_url().'index.php/ctrl_investor/insert_investor'?>" method="POST">
					<span class="login100-form-title p-b-43">
						InvestGlez Loging
					</span>
          <div class="wrap-input100 validate-input" data-validate = "First name is required">
						<input class="input100" type="text" name="first_name" id='first_name'>
						<span class="focus-input100"></span>
						<span class="label-input100">First Name</span>
					</div>
          <div class="wrap-input100 validate-input" data-validate = "Last name is required">
						<input class="input100" type="text" name="last_name" id='last_name'>
						<span class="focus-input100"></span>
						<span class="label-input100">Last Name</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" id="email">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>
          <div class="wrap-input100 validate-input" data-validate = "DOB is required">
						<input class="input100" type="text" name="dob" id='dob'>
						<span class="focus-input100"></span>
						<span class="label-input100">DOB</span>
					</div><hr>
          <div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="username" id='username'>
						<span class="focus-input100"></span>
						<span class="label-input100">Username</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pswd" id="pswd">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>
          <div class="wrap-input100 validate-input" data-validate="Confirm Password is required">
						<input class="input100" type="password" name="r_pswd" id="r_pswd">
						<span class="focus-input100"></span>
						<span class="label-input100">Confirm Password</span>
					</div>


					<div class="container-login100-form-btn">
						<button class="login100-form-btn" id="sign_up_btn">
							Register
						</button>
					</div>

					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							or sign in <?= anchor('welcome','Here')?>
						</span>
					</div>

				</form>

				<div class="login100-more" style="background-image: url('<?php echo base_url()."assets/login/"; ?>images/login_bg.jpeg');">
				</div>
			</div>
		</div>
	</div>





<!--===============================================================================================-->
	<script src="<?php echo base_url()."assets/login/"; ?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()."assets/login/"; ?>vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()."assets/login/"; ?>vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url()."assets/login/"; ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()."assets/login/"; ?>vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()."assets/login/"; ?>vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url()."assets/login/"; ?>vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()."assets/login/"; ?>vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

	<script src="<?php echo base_url()."assets/login/"; ?>js/main.js"></script>

	<script src="<?php echo base_url()."assets/"; ?>js/sign_up.js"></script>

  <script type="text/javascript">
  $(document).ready(function(){
    var date_input=$('input[name="dob"]'); //our date input has the name "date"
    var container=$('#dob').length>0 ? $('#dob').parent() : "body";
    date_input.datepicker({
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
    })
    })
  </script>
</body>
</html>
