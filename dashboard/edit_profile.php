<?php require_once("header.php"); ?>
<?php

$user_id = $_SESSION['st_logedin'][0]['id'];
$profile_photo = student('profile_photo', $user_id);


$stm = $pdo->prepare("SELECT * FROM students WHERE id=?");
$stm->execute(array($user_id));
$result = $stm->fetchAll(PDO::FETCH_ASSOC);

$name = $result[0]['name'];
$email = $result[0]['email'];
$email_status = $result[0]['is_email_verified'];
$mobile = $result[0]['mobile'];
$mobile_status = $result[0]['is_mobile_verified'];
$father_name = $result[0]['father_name'];
$mother_name = $result[0]['mother_name'];
$gendar = $result[0]['gender'];
$birthday = $result[0]['birthday'];
$address = $result[0]['address'];
$roll = $result[0]['roll'];
$current_class = $result[0]['current_class'];
$registration_date = $result[0]['register_date'];


if(isset($_POST['info_update_btn'])){
	$name = $_POST['name'];
	$father_name = $_POST['father_name'];
	$mother_name = $_POST['mother_name'];
	$gender = $_POST['gender'];
	$birthday = $_POST['birthday'];
	$address = $_POST['address'];
	$photo = $_FILES['photo'];
    $target_dir = "assets/uploads/"; 

	if(empty($name)){
		$error = "Name Is Requird!";
	}
	else if(empty($father_name)){
		$error = "Father Name Is Requird!";
	}
	else if(empty($mother_name)){
		$error = "Mother Name Is Requird!";
	}
	else if(empty($gendar)){
		$error = "Gender Is Requird!";
	}
	else if(empty($birthday)){
		$error = "Birth Date Is Requird!";
	}
	else if(empty($address)){
		$error = "Address Is Requird!";
	}
	else if(empty($photo['name'])){
		$error = "Photo Is Requird!";
	}
	else {
		// take photo extention
        $size = $_FILES['photo']['size'];
        $temp_name = $_FILES["photo"]["tmp_name"];
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


		// Photo Conditions
		if($fileType != 'png' && $fileType != 'jpg'){
            $eror = "photo must be png or jpg";
        }
        elseif($size >= 5000000){
            $eror = "photo less then 5MB";
        }
        else {
            // image same in file
            $name_prefix = rand(99,999999999999);
            $new_photo_name = $target_dir . $name_prefix . '.' . $fileType;


            $upload = move_uploaded_file($temp_name, $new_photo_name);

			$statement = $pdo->prepare("UPDATE students SET name=?,father_name=?,mother_name=?,gender=?,birthday=?,address=?,profile_photo=? WHERE id=?");
			$update_query = $statement->execute(
				array(
					$name,
					$father_name,
					$mother_name,
					$gendar,
					$birthday,
					$address,
					$new_photo_name,
					$user_id
				)
			);

			if($update_query == true){
				$success = "Profile Info Updated!";

			}
			else {
				$error = "Profile Info Update Failed!";
			}
		}
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
				<li>Profile</li>
			</ul>
		</div>	
		<div class="row">
			<!-- Your Profile Views Chart -->
			<div class="col-lg-12 m-b30">
				<div class="widget-box">
					<div class="wc-title">
						<h4>Edit Profile</h4>
					</div>
					<div class="widget-inner">
						<form class="edit-profile m-b30" action="" method="POST" enctype="multipart/form-data">
							<div class="">
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
								<div class="form-group row">
									<div class="col-sm-10  ml-auto">
										<h3>Edit Personal Details</h3>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Full Name</label>
									<div class="col-sm-7">
										<input class="form-control" name="name" type="text" value="<?php echo $name; ?>">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Email</label>
									<div class="col-sm-7">
										<input class="form-control" type="text" value="<?php echo $email; ?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Mobile</label>
									<div class="col-sm-7">
										<input class="form-control" type="text" value="<?php echo $mobile; ?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Father's Name</label>
									<div class="col-sm-7">
										<input class="form-control" name="father_name" type="text" value="<?php echo $father_name; ?>">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Mother's Name</label>
									<div class="col-sm-7">
										<input class="form-control" name="mother_name" type="text" value="<?php echo $mother_name; ?>">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Gender</label>
									<div class="col-sm-7">
										<label><input 
										<?php if($gendar == "Male"){echo "checked";} ?> type="radio" value="Male" name="gender" id=""> Male</label> <br>

										<label><input 
										<?php if($gendar == "Female"){echo "checked";} ?> type="radio" value="Female" name="gender" id=""> Female</label>

									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Birthday</label>
									<div class="col-sm-7">
										<input class="form-control" name="birthday" type="date" value="<?php echo $birthday; ?>">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Address</label>
									<div class="col-sm-7">
										<input class="form-control" name="address" type="text" value="<?php echo $address; ?>">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Upload Photo</label>
									<div class="col-sm-7">

										<div class="photo_wrapper">
											<div class="avatar-upload">
												<div class="avatar-edit">
													<input type='file' name="photo" id="imageUpload"/>
													<label for="imageUpload"></label>
												</div>
												<div class="avatar-preview">
													<div id="imagePreview" style="background-image: url(<?php if($profile_photo == null){
														echo 'assets/uploads/user.png';
													} else {
														echo $profile_photo;
													} ?>);">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="">
								<div class="">
									<div class="row">
										<div class="col-sm-2">
										</div>
										<div class="col-sm-7">
											<button type="submit" name="info_update_btn" class="btn info_update_btn">Save changes</button>
											<button type="reset" class="btn-secondry">Reset</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Your Profile Views Chart END-->
		</div>
	</div>
</main>

<?php require_once("footer.php"); ?>

<script>
	function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});

</script>