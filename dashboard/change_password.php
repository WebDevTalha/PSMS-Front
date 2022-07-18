<?php require_once("header.php"); ?>
<?php

$user_id = $_SESSION['st_logedin'][0]['id'];


if(isset($_POST['change_btn'])){

	$current_password = $_POST['current_password'];
	$new_password = $_POST['new_password'];
	$confirm_new_password = $_POST['confirm_new_password'];

	$db_password = student('password',$user_id);

	if(empty($current_password)){
		$error = "Current Password is requird!";
	}
	else if(empty($new_password)){
		$error = "New Password is requird!";
	}
	else if(empty($confirm_new_password)){
		$error = "Confirm New Password is requird!";
	}
	else if($db_password != SHA1($current_password)){
		$error = "Current Password Is Wrong!";
	}
	else if($new_password != $confirm_new_password){
		$error = "New Password Doesn't Match!";
	}
	else if(strlen($new_password) < 6){
		$error = "Password Must Be More Then 6 Digit!";
	}
	else if($db_password == SHA1($new_password)){
		$error = "Try New Password! You cannot enter the previous password twice.";
	}
	else {
		$update = $pdo->prepare("UPDATE students SET password=?,verification=? WHERE id=?");
		$update->execute(array(SHA1($new_password),0,$user_id));

		
		unset($_SESSION['change_password_form']);

		$success = "Password Updated Successfully!";
	}
}


$verification_count = student('verification',$user_id);
$email_code = student('email_code',$user_id);


if(isset($_POST['st_email_send_btn'])){
	$user_email = student('email',$user_id);

	$code = rand(9999,999999);

	$subject = 'PSMS - Password Verification';
	$message = "<html>
            <head>
                <title>Password Verification</title>
            </head>
        <body>
        <p>Password Verification</p>
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
		$stm = $pdo->prepare("UPDATE students SET email_code=?,verification=? WHERE id=?");
		$stm->execute(array(null,1,$user_id));

		$_SESSION['change_password_form'] = 1;

		$success = "Your Email Verify Success!";
	}
}

?>
<!--Main container start -->
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Profile</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
				<li>Change Password</li>
			</ul>
		</div>	
		<!-- Card -->
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
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

						
						<?php if(isset($_SESSION['change_password_form']) == 1 OR $verification_count == 1) :?>

                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="current_password">Current Password:</label>
                                    <input type="password" name="current_password" class="form-control" id="current_password">
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password:</label>
                                    <input type="password" name="new_password" class="form-control" id="new_password">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_new_password">Confirm New Password:</label>
                                    <input type="password" name="confirm_new_password" class="form-control" id="confirm_new_password">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="change_btn" class="btn btn-success" value="Change Password">
                                </div>
                            </form>						
							
						<?php endif;?>
						<?php if(!isset($_SESSION['change_password_form']) == 1 && $verification_count != 1) :?>
                            <form class="contact-bx" method="POST" action="">
                                <p>We, Will, Send You A Verification Code To change Your Password!</p>
                                <button name="st_email_send_btn" type="submit" class="btn button-md mb-2">Click To Send Email</button>
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
										<button name="st_email_code_btn" type="submit" value="Submit" class="btn button-md">Verify</button>
									</div>
								</div>
							</form>
						<?php endif;?>						
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
	
<?php require_once("footer.php"); ?>