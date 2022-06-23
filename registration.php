<?php 

require_once('config.php');

if(isset($_POST['st_submit_btn'])) {
	$st_name = $_POST['st_name'];
	$st_email = $_POST['st_email'];
	$st_mobile = $_POST['st_mobile'];
	$st_father = $_POST['st_father'];
	$st_father_mobile = $_POST['st_father_mobile'];
	$st_mother = $_POST['st_mother'];
	$st_gender = $_POST['st_gender'];
	$st_birthday = $_POST['st_birthday'];
	$st_address = $_POST['st_address'];
	$st_password = $_POST['st_password'];

	// Count Mobile And Email
	$countEmail = pfRowCount('email', $st_email);
	$countMobile = pfRowCount('mobile', $st_email);

	// Validation
	if(empty($st_name)){
		$error = "Name Is Requird";
	}
	else if(empty($st_email)){
		$error = "Email Is Requird";
	}
	else if(!filter_var($st_email, FILTER_VALIDATE_EMAIL)){
		$error = "Email Is Not Valid";
	}
	else if($countEmail != 0){
		$error = "This Email Is Already Used";
	}
	else if(empty($st_mobile)){
		$error = "Mobile Is Requird";
	}
	else if($countMobile != 0){
		$error = "This Mobile Is Already Used";
	}
	else if(empty($st_father)){
		$error = "Father's Name Is Requird";
	}
	else if(empty($st_father_mobile)){
		$error = "Father's Mobile Is Requird";
	}
	else if(empty($st_mother)){
		$error = "Mother's Name Is Requird";
	}
	else if(empty($st_birthday)){
		$error = "Birth Date Is Requird";
	}
	else if(empty($st_address)){
		$error = "Address Is Requird";
	}
	else if(empty($st_password)){
		$error = "Password Is Requird";
	}
	else {
		$date = date("Y-m-d H:i:s");

		$password = SHA1($st_password);

		$statement = $pdo->prepare("INSERT INTO students(name,email,mobile,father_name,father_mobile,mother_name,gender,birthday,address,password,register_date) VALUE(?,?,?,?,?,?,?,?,?,?)");
		$result = $statement->execute(array($st_name,$st_email,$st_mobile,$st_father,$st_father_mobile,$st_mother,$st_gender,$st_birthday,$st_address,$password,$date));

		if($result == true){
			$success = 'Student Registration Successfull!';
		} else {
			$error = 'Student Registration Failed!';
		}


	}


}

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
	<meta name="description" content="PSMS - Student Registration" />
	
	<!-- OG -->
	<meta property="og:title" content="PSMS - Student Registration" />
	<meta property="og:description" content="PSMS - Student Registration" />
	<meta property="og:image" content="" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- FAVICONS ICON ============================================= -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
	
	<!-- PAGE TITLE HERE ============================================= -->
	<title>PSMS - Student Registration</title>
	
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
					<h2 class="title-head">Student <span>Registration</span></h2>
					<p>Login Your account? <a href="login.php">Click here</a></p>
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
									<label>Your Name</label>
									<input name="st_name" type="text" class="form-control" value="<?php if(isset($st_name)){
										echo $st_name;
									} ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Your Email Address</label>
									<input name="st_email" type="email" class="form-control" value="<?php if(isset($st_email)){
										echo $st_email;
									} ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Your Mobile Number</label>
									<input name="st_mobile" type="text" class="form-control" value="<?php if(isset($st_mobile)){
										echo $st_mobile;
									} ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Your Father's Name</label>
									<input name="st_father" type="text" class="form-control" value="<?php if(isset($st_father)){
										echo $st_father;
									} ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Your Father's Mobile</label>
									<input name="st_father_mobile" type="text" class="form-control" value="<?php if(isset($st_father_mobile)){
										echo $st_father_mobile;
									} ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Your Mother's Name</label>
									<input name="st_mother" type="text" class="form-control" value="<?php if(isset($st_mother)){
										echo $st_mother;
									} ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label>Gender:</label><br>
								<label><input type="radio" name="st_gender" value="Male" checked> Male</label> &nbsp;&nbsp;
								<label><input type="radio" name="st_gender" value="Female" > Female</label>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label for="st_birthday">Birthday:</label><br>
								<div class="input-group">
									<input type="date" name="st_birthday" class="form-control" id="st_birthday">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Your Address</label>
									<input name="st_address" type="text" class="form-control" value="<?php if(isset($st_address)){
										echo $st_address;
									} ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group"> 
									<label>Your Password</label>
									<input name="st_password" type="password" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-lg-12 m-b30">
							<button name="st_submit_btn" type="submit" value="Submit" class="btn button-md">Sign Up</button>
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
