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
						<th>Name</th>
						<th>Student's Mobile</th>
						<th>Current Subscription Type</th>
						<th>Repeat Times</th>
						<th>Email</th>
						<th>More info</th>

					</tr>
					</thead>
					<tbody id="signUps">
					<?php
					$count = 1;
					foreach ($repeatCustomers as $repeatCustomer){
						?>
						<tr>
							<td><?php echo $count?></td>
							<td><?php echo $repeatCustomer->fname?></td>
							<td><?php echo $repeatCustomer->mobile ?></td>
							<td><?php echo $repeatCustomer->subscription_type ?></td>
							<td><?php echo $repeatCustomer->count ?></td>
							<td><?php echo $repeatCustomer->email ?></td>
							<td><a href="<?php echo base_url() .'info/'.$repeatCustomer->user_id?>" >More Info </a></td>
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
