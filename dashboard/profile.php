<?php require_once("header.php"); ?>
<?php

$user_id = $_SESSION['st_logedin'][0]['id'];

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
$profile_photo = $result[0]['profile_photo'];

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
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
                        <table class="table">
                            <tr>
                                <div class="user-profile"><img src="<?php 
                                if($profile_photo != null){
                                    echo $profile_photo;
                                } else {
                                    echo "assets/uploads/user.png";
                                }
                                ?>"></div>
                            </tr>
                            <tr>
                                <td><b>Name:</b></td>
                                <td><?php echo $name; ?></td>
                            </tr>
                            <tr>
                                <td><b>Email:</b></td>
                                <td><?php echo $email; 
                                if($email_status == 1){
                                    echo '&nbsp;&nbsp; <i title="Verified" class="text-success fa-solid fa-circle-check"></i>';
                                } else {
                                    echo '&nbsp;&nbsp; <i title="Unverified" class="text-danger fa-solid fa-circle-xmark"></i>';
                                }
                                ?></td>
                            </tr>
                            <tr>
                                <td><b>Mobile:</b></td>
                                <td><?php echo $mobile;
                                if($mobile_status == 1){
                                    echo '&nbsp;&nbsp; <i title="Verified" class="text-success fa-solid fa-circle-check"></i>';
                                } else {
                                    echo '&nbsp;&nbsp; <i title="Unverified" class="text-danger fa-solid fa-circle-xmark"></i>';
                                }
                                ?></td>
                            </tr>
                            <tr>
                                <td><b>Father's Name:</b></td>
                                <td><?php echo $father_name; ?></td>
                            </tr>
                            <tr>
                                <td><b>Mother's Name:</b></td>
                                <td><?php echo $mother_name; ?></td>
                            </tr>
                            <tr>
                                <td><b>Gendar:</b></td>
                                <td><?php echo $gendar; ?></td>
                            </tr>
                            <tr>
                                <td><b>Brithday:</b></td>
                                <td><?php echo $birthday; ?></td>
                            </tr>
                            <tr>
                                <td><b>Address:</b></td>
                                <td><?php echo $address; ?></td>
                            </tr>
                            <tr>
                                <td><b>Roll:</b></td>
                                <td><?php echo $roll; ?></td>
                            </tr>
                            <tr>
                                <td><b>Current Calss:</b></td>
                                <td><?php echo $roll; ?></td>
                            </tr>
                            <tr>
                                <td><b>Registration Date:</b></td>
                                <td><?php echo $registration_date; ?></td>
                            </tr>
                            <tr>
                                <td><a href="edit_profile.php" class="btn btn-warning">Edit Profile</a></td>
                            </tr>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
</main>
	
<?php require_once("footer.php"); ?>