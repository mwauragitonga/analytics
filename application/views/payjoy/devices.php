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
			<li class="active"> PayJoy Devices </li>
		</ol>
	</section>

	<section>
		<div class="box-body">
			<div class="table-responsive col-md-12 col-lg-12">
				<table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">	<thead>

					<tr>
						<th> #</th>
						<th>Device Tag</th>
						<th>Model</th>
						<th>IMEI </th>
						<th>Lock Status</th>
						<th>Expiration</th>
						<th>Last Seen </th>
						<th> Lock Device </th>
						<th> Unlock Device </th>
						<th> More Actions </th>

					</tr>
					</thead>
					<?php
					$count = 1;
					  ?>
						<tbody>
						<tr>
							<td><?php echo $count ; ?></td>
							<td><?php echo $device->deviceTag ; ?></td>
							<td> <?php  echo $device->makeModel; ?></td>
							<td> <?php echo  $device->imei ; ?></td>
							<td><?php echo $lockStatus ; ?></td>
							<td><?php echo $expiration ; ?></td>
							<td><?php echo date('Y-m-d H:i:s', $device->lastSeen);?></td>
							<td><a href="<?php echo base_url(); ?>lock"><button class="btn-danger" >Lock Device</button></a></td>
							<td><a href="<?php echo base_url(); ?>unlock"><button class="btn-info" >Unlock Device</button></a></td>
							<td><a href="<?php echo base_url() ; ?>" class="small-box-footer">More Actions  <i class="fa fa-arrow-circle-right"></i></a></td>
						</tr>
						</tbody>

						<?php
						$count ++;
					 ?>
				</table>
			</div>
		</div>
	</section>
</div>

