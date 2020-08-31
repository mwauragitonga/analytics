<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title; ?>

			</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>general"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"> Attempted Payments </li>
		</ol>
	</section>

	<section>
		<div class="box-body">
			<div class="table-responsive col-md-12 col-lg-12">
				<table  class="data-table " id="payers" >
					<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Mobile</th>
						<th>Gender</th>
						<th>School</th>
						<th>Study Level</th>
						<th>Payment Status</th>
						<th>Time</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$count = 1;
					foreach ($users  as $user){  ?>
						<tr>
							<td><?php echo $count  ?></td>
							<td><?php echo $user->fname .' '. $user->lname ; ?></td>
							<td><?php echo $user->mobile ; ?></td>
							<td><?php echo $user->gender ; ?></td>
							<td><?php echo $user->school_name ; ?></td>
							<td><?php echo $user->level_name ; ?></td>
							<td><?php

								$transactionID = $user->transaction_ID;
								$logTime = date('Ymd',strtotime($user->time));
								$paymentTime = date('Ymd',strtotime($user->time_of_payment));

								if( $logTime === $paymentTime) {
									echo 'Complete';
								}else{
									echo 'Incomplete';
								}
								?></td>
							<td><?php echo $user->time ; ?></td>
						</tr>
						<?php
						$count++;
					}
					?>
					</tbody>
					<tfoot>
					</tfoot>
				</table >

			</div>
		</div>
	</section>
</div>

<script>
	$(document).ready( function () {
		$('#payers').DataTable();
	} );
</script>
