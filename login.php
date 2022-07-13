<?php

require_once('config.php');

session_start();

if(isset($_POST['st_submit_btn'])) {
	$st_user = $_POST['st_user'];
	$st_password = $_POST['st_password'];

	// Validation
	if(empty($st_user)){
		$error = "Name Is Requird";
	}
	else if(empty($st_password)){
		$error = "Password Is Requird";
	}
	else {

		$password = SHA1($st_password);

		// Find the login user
		$statement = $pdo->prepare(
			"SELECT id,email,mobile FROM students WHERE (email=? OR mobile=?) AND password=?"
		);
		$statement->execute(array(
			$st_user,
			$st_user,
			$password		
		));
		$loginCount = $statement->rowCount();
		if($loginCount == 1){
			$userData = $statement->fetchAll(PDO::FETCH_ASSOC);
			$_SESSION['st_logedin'] = $userData;

			// GET Verify Status
			$is_email_verified = student('is_email_verified',$_SESSION['st_logedin'][0]['id']);
			$is_mobile_verified = student('is_mobile_verified',$_SESSION['st_logedin'][0]['id']);

			if($is_email_verified == 1 && $is_mobile_verified == 1){
				header("location:dashboard/index.php");
			}
			else {
				header("location:verify.php");
			}
			

		} else {
			$error = 'Username Or Password is wrong!';
		}
	}
}

if(isset($_SESSION['st_logedin'])){
	header("location:verify.php");
};


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<!-- META ============================================= -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	
	<!-- DESCRIPTION -->
	<meta name="description" content="PSMS - Student Login" />
	
	<!-- OG -->
	<meta property="og:title" content="PSMS - Student Login" />
	<meta property="og:description" content="PSMS - Student Login" />
	<meta property="og:image" content="" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- FAVICONS ICON ============================================= -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
	
	<!-- PAGE TITLE HERE ============================================= -->
	<title>PSMS - Student Login</title>
	
	<!-- MOBILE SPECIFIC ============================================= -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
	
	<!-- All PLUGINS CSS ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/assets.css">
	
	<!-- TYPOGRAPHY ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/typography.css">
	
	<!-- SHORTCODES ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/shortcodes/shortcodes.css">
	
	<!-- STYLESHEETS ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link class="skin" rel="stylesheet" type="text/css" href="assets/css/color/color-1.css">
	
</head>
<body id="bg">
<div class="page-wraper">
	<div id="loading-icon-bx"></div>
	<div class="account-form">
		<div class="account-head" style="background-image:url(assets/images/background/bg2.jpg);">
			<a href="index.php"><img src="assets/images/logo-white-2.png" alt=""></a>
		</div>
		<div class="account-form-inner">
			<div class="account-container">
				<div class="heading-bx left">
					<h2 class="title-head">Login to your <span>Account</span></h2>
					<p>Don't have an account? <a href="registration.php">Create one here</a></p>
				</div>	
				<?php if(isset($error)) :?>
				<div class="alert alert-danger">
					<?php echo $error; ?>
				</div>	
				<?php endif;?>
				<?php if(isset($success)) :?>
				<div class="alert alert-success">
					<?php echo $success; ?>
				</div>	
				<?php endif;?>
				<form class="contact-bx" method="POST" action="">
					<div class="row placeani">
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Your Email or Mobile</label>
									<input name="st_user" type="text" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group"> 
									<label>Your Password</label>
									<input name="st_password" type="password" class="form-control" required="">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group form-forget">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="customControlAutosizing">
									<label class="custom-control-label" for="customControlAutosizing">Remember me</label>
								</div>
								<a href="forget-password.php" class="ml-auto">Forgot Password?</a>
							</div>
						</div>
						<div class="col-lg-12 m-b30">
							<button name="st_submit_btn" type="submit" value="Submit" class="btn button-md">Login</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- External JavaScripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/vendors/bootstrap/js/popper.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="assets/vendors/magnific-popup/magnific-popup.js"></script>
<script src="assets/vendors/counter/waypoints-min.js"></script>
<script src="assets/vendors/counter/counterup.min.js"></script>
<script src="assets/vendors/imagesloaded/imagesloaded.js"></script>
<script src="assets/vendors/masonry/masonry.js"></script>
<script src="assets/vendors/masonry/filter.js"></script>
<script src="assets/vendors/owl-carousel/owl.carousel.js"></script>
<script src="assets/js/scripts.js"></script>
<script src="assets/js/contact.js"></script>
</body>

</html>
