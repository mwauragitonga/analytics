<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title;
			?>

			</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"><?php echo $title ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">

			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green-gradient">
					<div class="inner">
						<h3 id="aYS"><?php echo $total_Schools ?></h3>

						<h3><p>Total schools</p></h3>
					</div>
					<div class="icon">
						<i class="ion ion-stats-bars"></i>
					</div>

				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-primary">
					<div class="inner">
						<h3 id="aTS"><?php echo $registered_Schools ?></h3>

						<p>Schools with >= 1 students</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph "></i>
					</div>
					<a href="<?php echo base_url() ?>reg_schools" class="small-box-footer"> More Info<i
							class="fa fa-arrow-circle-right"></i></a>

				</div>

			</div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-primary">
					<div class="inner">
						<h3 id="aTS"><?php echo $schools_with_paid_customers ?></h3>

						<p>Schools with paid customers</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph "></i>
					</div>
					<a href="<?php echo base_url() ?>paid_schools" class="small-box-footer"> More Info<i
							class="fa fa-arrow-circle-right"></i></a>

				</div>

			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3 id="aMS"><sup style="font-size: 20px"><?php echo $top_school_Reading['name'] ?></h3>
						<!--<h3><?php /*echo "(".($top_school_Reading['appMinutes']/60/60).")"*/ ?></h3>-->


						<p>Top school (Reading and viewing content)</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="<?php echo base_url() ?>top_reading" class="small-box-footer"> More Info<i
							class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">

						<h3 id="nS"><sup style="font-size: 20px"><?php echo $top_school_students['name'] ?></h3>
						<h3><?php echo "(" . $top_school_students['count'] . ")" ?></h3>


						<p>Top school (Registered Students )</p>
					</div>
					<div class="icon">
						<i class="fa fa-times "></i>
					</div>
					<a href="<?php echo base_url() ?>reg_schools" class="small-box-footer"> More Info<i
							class="fa fa-arrow-circle-right"></i></a>

				</div>
			</div>


			<!-- ./col -->
		</div>

		<div class="row">
			<section class="col-lg-12">
				<h2> Schools with the most students on the platform</h2>
				<!-- Custom tabs (Charts with tabs)-->
				<div class="table-responsive">
					<table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
						<thead>

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
				<!-- /.nav-tabs-custom -->

			</section>
			<!-- right col -->
		</div>
		<!-- /.row (main row) -->

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
