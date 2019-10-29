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
			<table id="example1" class="table table-bordered table-striped table-responsive">
				<thead>
				<tr>
					<th> #</th>
					<th>Name</th>
					<th>Paying Mobile</th>
					<th>Student's Mobile</th>
					<th>Transaction Code</th>
					<th>Amount paid</th>
					<th>Source</th>
					<th>Date of payment</th>

				</tr>
				</thead>
				<tbody id="signUps">
				<?php
				$count = 1;
				foreach ($payers as $payer){
					?>
					<tr>
						<td><?php echo $count?></td>
						<td><?php echo $payer->fname?></td>
						<td><?php echo $payer->msisdn ?></td>
						<td><?php echo $payer->mobile ?></td>
						<td><?php echo $payer->transaction_ID ?></td>
						<td><?php echo $payer->amount ?></td>
						<td><?php echo $payer->source_name ?></td>
						<td><?php echo date('l,Y-m-d h:i:s A ',strtotime($payer->time_of_payment))?></td>

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

