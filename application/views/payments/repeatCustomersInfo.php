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
			<li class="active">paid customers</li>
		</ol>
	</section>

	<section>

		<div class="box-body">
			<div class="table-responsive col-md-12 col-lg-12">
				<table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">	<thead>

					<tr>
						<th> #</th>
						<th>Transaction Id</th>
						<th>Student's Mobile</th>
						<th>Paying Mobile</th>
						<th>Subscription Type</th>
						<th>Amount</th>
						<th>Date</th>

					</tr>
					</thead>
					<tbody id="signUps">
					<?php
					$count = 1;
					foreach ($customer as $c){
						?>
						<tr>
							<td><?php echo $count?></td>
							<td><?php echo $c->transaction_ID?></td>
							<td><?php echo $c->mobile ?></td>
							<td><?php echo $c->payingMobile ?></td>
							<td><?php echo $c->subscription_type ?></td>
							<td><?php echo $c->amount ?></td>
							<td><?php echo date('Y-m-d h:i:s ',strtotime($c->time_of_payment))?></td>
						</tr>

						<?php
						$count++;
					}
					?>

					</tbody>
				</table>
			</div>
		</div>
	</section>
</div>
<script>

</script>
