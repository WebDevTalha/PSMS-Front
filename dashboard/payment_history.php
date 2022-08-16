<?php require_once('header.php');




?>
<!--Main container start -->
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Fees Payment History</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
				<li>Fees Payment History</li>
			</ul>
		</div>	
		<div class="row">

			<div class="col-lg-12 m-b30">
				<div class="widget-box">

					<div class="wc-title">
						<h4>Fees Payment History</h4>
					</div>
					<?php
						$stm=$pdo->prepare("SELECT * FROM student_payment_history WHERE student_id=?");
						$stm->execute(array($user_id));
						$result = $stm->fetchAll(PDO::FETCH_ASSOC);

					?>
					<div class="widget-inner">
						<div class="edit-profile m-b30">
							<div class="table-responsive"> 
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Amount</th>
											<th>Method</th>
											<th>Payment Date & Time</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$i=1;
										foreach($result as $list) :
										?>
										<tr>
											<td><?php echo $i;$i++;?></td>
											<td><?php echo student('name',$list['student_id']);?></td>
											<td><?php echo number_format($list['amount']);?></td>
											<td><?php echo $list['payment_method'];?></td>
											<td><?php echo $list['created_at'];?></td>
										</tr>
										<?php endforeach;?>
									</tbody>

								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</main>
<?php require_once('footer.php');?> 