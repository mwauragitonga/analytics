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
			<li class="active"> Active Users </li>
		</ol>
	</section>

	<section>
		<div class="box-body">

			<table id="example1" class="table table-bordered table-striped table-responsive">
				<thead>
				<tr>
					<th> #</th>
					<th>Name</th>
					<th>Gender</th>
					<th>Phone Number</th>
					<th>School</th>
					<th>Study Level</th>
					<th>Subscription Status</th>

				</tr>
				</thead>
				<?php
				$count = 1;
				foreach ($users  as $user){  ?>
				<tbody id="signUps">
				<tr>
					<td><?php echo $count ; ?></td>
					<td><?php echo $user->fname .' '. $user->lname ; ?></td>
					<td><?php echo $user->gender ; ?></td>
					<td><?php echo $user->mobile ; ?></td>
					<td> <?php echo $user->school_name ; ?></td>
					<td><?php echo $user->level_name ; ?></td>
					<td><?php echo $user->userstatus ; ?></td>
				</tr>
				</tbody>

				<?php
				$count ++;
				} ?>
			</table>
		</div>
	</section>
</div>

