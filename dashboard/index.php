<?php require_once("header.php"); ?>

<?php


$stm=$pdo->prepare("SELECT current_class FROM students");
$stm->execute(array());
$count = $stm->rowCount();

$stm2=$pdo->prepare("SELECT id FROM teachers");
$stm2->execute(array());
$count2 = $stm2->rowCount();

$stm3=$pdo->prepare("SELECT id FROM class");
$stm3->execute(array());
$count3 = $stm3->rowCount();

?>

	<!--Main container start -->
	<main class="ttr-wrapper">
		<div class="container-fluid">
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Dashboard</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>Dashboard</li>
				</ul>
			</div>	
			<!-- Card -->
			<div class="row">
				<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
					<div class="widget-card widget-bg1">					 
						<div class="wc-item">
							<h4 class="wc-title">
								Total Students
							</h4>
							<span class="wc-des">
								All Values
							</span>
							<span class="wc-stats">
								<span class="counter"><?php echo $count; ?></span>
							</span>		
							<div class="progress wc-progress">
								<div class="progress-bar" role="progressbar" style="width: 78%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<span class="wc-progress-bx">
								<span class="wc-change">
									Change
								</span>
								<span class="wc-number ml-auto">
									78%
								</span>
							</span>
						</div>				      
					</div>
				</div>
				<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
					<div class="widget-card widget-bg2">					 
						<div class="wc-item">
							<h4 class="wc-title">
								 Total Teachers
							</h4>
							<span class="wc-des">
								All Values
							</span>
							<span class="wc-stats counter">
							<?php echo $count2; ?>
							</span>		
							<div class="progress wc-progress">
								<div class="progress-bar" role="progressbar" style="width: 88%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<span class="wc-progress-bx">
								<span class="wc-change">
									Change
								</span>
								<span class="wc-number ml-auto">
									88%
								</span>
							</span>
						</div>				      
					</div>
				</div>
				<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
					<div class="widget-card widget-bg3">					 
						<div class="wc-item">
							<h4 class="wc-title">
								Total Class 
							</h4>
							<span class="wc-des">
								All Values 
							</span>
							<span class="wc-stats counter">
							<?php echo $count3; ?> 
							</span>		
							<div class="progress wc-progress">
								<div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<span class="wc-progress-bx">
								<span class="wc-change">
									Change
								</span>
								<span class="wc-number ml-auto">
									65%
								</span>
							</span>
						</div>				      
					</div>
				</div>
				<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
					<div class="widget-card widget-bg4">					 
						<div class="wc-item">
							<h4 class="wc-title">
								New Users 
							</h4>
							<span class="wc-des">
								Joined New User
							</span>
							<span class="wc-stats counter">
								350 
							</span>		
							<div class="progress wc-progress">
								<div class="progress-bar" role="progressbar" style="width: 90%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<span class="wc-progress-bx">
								<span class="wc-change">
									Change
								</span>
								<span class="wc-number ml-auto">
									90%
								</span>
							</span>
						</div>				      
					</div>
				</div>
			</div>
			<!-- Card END -->
		</div>
	</main>
	
<?php require_once("footer.php"); ?>