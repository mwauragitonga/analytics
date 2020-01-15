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
						<th>transaction_ID</th>
						<th>Transaction Time</th>
						<th>Transaction Amount</th>
						<th>Business short code</th>
						<th>Bill Reference Number</th>
						<th>MSISDN</th>
						<th>Name</th>
						<th>Org Balance</th>

					</tr>
					</thead>
					<tbody id="signUps">
					<?php
					$count = 1;
					foreach ($payments as $payment){
						?>
						<tr>
							<td><?php echo $count?></td>
							<td><?php echo $payment->transaction_ID?></td>
							<td><?php echo date('Y-m-d h:i:s ',strtotime($payment->transaction_Time))?></td>
							<td><?php echo $payment->transaction_Amount ?></td>
							<td><?php echo $payment->business_short_code ?></td>
							<td><?php echo $payment->bill_reference_number ?></td>
							<td><?php echo $payment->MSISDN ?></td>
							<td><?php echo $payment->first_name . " ".$payment->middle_name." " .$payment->last_name?></td>
							<th><?php echo $payment->org_account_balance?></th>

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


