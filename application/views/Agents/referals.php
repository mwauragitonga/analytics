<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title ;
			?>

			</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"><?php echo $title?></li>
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
						<h3 id="aYS"><?php echo $response['total_students']?></h3>

						<h3><p>Students Referred</p></h3>
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
						<h3 id="aTS"><?php echo $response['associated_schools']?></h3>

						<p>Associated Schools</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph "></i>
					</div>
				</div>

			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-primary">
					<div class="inner">
						<h3 id="aTS"><?php echo $response['paid_students']?></h3>

						<p>Paid Students</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph "></i>
					</div>
				</div>

			</div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-primary">
					<div class="inner">
						<h3 id="aTS"><?php echo $response['total_revenue']?></h3>

						<p>Total Revenue</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph "></i>
					</div>
				</div>

			</div>


			<!-- ./col -->
		</div>

		<div class="row">
			<section class="col-lg-12">
				<h2>Students Referred</h2>
				<!-- Custom tabs (Charts with tabs)-->
				<div class="table-responsive">
					<table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">	<thead>

						<tr>
							<th> #</th>
							<th>Student Name </th>
							<th>School Name</th>
							<th>Level</th>
							<th>Date Joined</th>

						</tr>
						</thead>
						<tbody id="students">
						<?php
						$count =0;
						foreach ($response['students'] as $student){
							?>
							<tr>
								<td><?php echo $count+1?></td>
								<td><?php echo $student->fname?></td>
								<td><?php echo $student->name?></td>
								<td><?php echo $student->level_name?></td>
								<td><?php echo date('l,Y-m-d h:i:s A ',strtotime($student->date_joined))?></td>
							</tr>




							<?php  $count++;
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
