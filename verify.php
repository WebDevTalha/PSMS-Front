<?php

require_once('config.php');

session_start();

if(!isset($_SESSION['st_logedin'])){
	header('location:login.php');
}

$user_id = $_SESSION['st_logedin'][0]['id'];

if(isset($_POST['st_email_send_btn'])){
	$user_email = student('email',$user_id);

	$code = rand(9999,999999);

	$subject = 'PSMS - Email Verification';
	$message = "<html>
            <head>
                <title>Email Verification</title>
            </head>
        <body>
        <p>Email Verification</p>
        <table>
			<tbody>
			<tr>
				<th>Code: </th>
				<th>".$code."</th>
			</tr>
			</tbody>
        </table>
        <p>Thanks</p>
        </body>
    </html>";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	$send_mail = mail($user_email,$subject,$message,$headers);

	if($send_mail == true){
		$stm = $pdo->prepare("UPDATE students SET email_code=? WHERE id=?");
		$stm->execute(array($code,$user_id));

		$_SESSION['email_code_send'] = 1;

		$success = 'Code Send Success, Please Check Your Register Eamil!';
	}
	else {
		$error = 'Email sent failed';
	}
}


if(isset($_POST['st_email_code_btn'])){
	$st_code = $_POST['st_email_code'];
	$db_code = student('email_code',$user_id);

	if(empty($st_code)){
		$error = "Email Code Is Requird!";
	}
	else if($st_code != $db_code){
		$error = "Email Code Does't Match!";
	}
	else {		
		$stm = $pdo->prepare("UPDATE students SET email_code=?,is_email_verified=? WHERE id=?");
		$stm->execute(array(null,1,$user_id));

		unset($_SESSION['email_code_send']);
		$success = "Your Email Verify Success!";
	}
}

$email_code_count = student('email_code',$user_id);


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
	<meta name="description" content="PSMS - Student Verifition" />
	
	<!-- OG -->
	<meta property="og:title" content="PSMS - Student Verifition" />
	<meta property="og:description" content="PSMS - Student Verifition" />
	<meta property="og:image" content="" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- FAVICONS ICON ============================================= -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
	
	<!-- PAGE TITLE HERE ============================================= -->
	<title>PSMS - Student Verifition</title>
	
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
					<h2 class="title-head">Student<span>Verifition</span></h2>
					<p><u><?php echo student('name', $_SESSION['st_logedin'][0]['id']);?></u> Please Verify Your Account</p>
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

				<?php 
				$email_status = student('is_email_verified',$_SESSION['st_logedin'][0]['id']);
				$mobile_status = student('is_mobile_verified',$_SESSION['st_logedin'][0]['id']);

				if(isset($_SESSION['st_logedin']) AND $email_status == 1){
					header("location:dashboard/index.php");
				};				
				?>

				<p>Email: 
					<?php 
						if($email_status == 1){
							echo '<span class="badge badge-success">Verified</span>';
						} else {
							echo '<span class="badge badge-danger"> Not Verified</span>';
						}
					?>
				</p>
				<p>Mobile: 
					<?php 
						if($mobile_status == 1){
							echo '<span class="badge badge-success">Verified</span>';
						} else {
							echo '<span class="badge badge-danger"> Not Verified</span> <small clsss="text-sm">This Service Currently Disabled</small>';
						}
					?>
				</p>
				<?php if(isset($_SESSION['email_code_send']) == 1 OR $email_code_count != null) :?>

				<form class="contact-bx" method="POST" action="">
					<div class="row placeani">
						<div class="col-lg-12">
							<button name="st_email_send_btn" type="submit" class="btn button-md mb-2">Resend Email</button>
						</div>
					</div>
				</form>
					
				<form class="contact-bx" method="POST" action="">
					<div class="row placeani">
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Type Your Code</label>
									<input name="st_email_code" type="text" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-lg-12 m-b30">
							<button name="st_email_code_btn" type="submit" value="Submit" class="btn button-md">Verify Email</button>
						</div>
					</div>
				</form>

				<?php endif;?>

				<?php
				if($email_status != 1 && $email_code_count == null) :?>
				<form class="contact-bx" method="POST" action="">
					<div class="row placeani">
						<div class="col-lg-12">
							<button name="st_email_send_btn" type="submit" class="btn button-md mb-2">Click To Verify Email</button>
						</div>
					</div>
				</form>
				<?php endif;?>


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
