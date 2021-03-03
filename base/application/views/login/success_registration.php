
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

	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/login/"; ?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/login/"; ?>css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-43 text-success">
            <img src="<?= base_url('assets/login/').'images/success.png'?>" width="100" height="100"><br>
            Successful Registration!
					</span>
          <div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							Go back and <?= anchor(base_url(),'Sign in',array('class' => 'btn btn-warning'))?>
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
	<script src="<?php echo base_url()."assets/login/"; ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->

	<script src="<?php echo base_url()."assets/login/"; ?>js/main.js"></script>
</body>
</html>
