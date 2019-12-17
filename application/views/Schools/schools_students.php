<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title; ?>

			</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>general"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</section>
	<br><hr>

	<div class="row ">
		<!-- Left col -->
		<section class="col-lg-12 col-md-12 content">
			<div class="table-responsive col-lg-12">
				<table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">	<thead>

					<th>#</th>
					<th>School Name</th>
					<th>Number of students</th>
					<th>More info</th>

					</thead>
					<tbody>
					<?php
					$count =0;
					foreach ($schools as $school) {

						?>
						<tr>
							<td><?php echo $count + 1 ?></td>
							<td><?php echo $school->name ?></td>
							<td><?php echo $school->count?></td>
							<td><a href="<?php echo base_url().'schools/users/'.$school->school_code?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a></td>


						</tr>
						<?php
						$count++;
					}
					?>

					</tbody>
				</table>
			</div>


		</section>


	</div>
</div>
