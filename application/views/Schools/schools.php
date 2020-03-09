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
						<h3 id="aYS"><?php echo $total_Schools?></h3>

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
						<h3 id="aTS"><?php echo $registered_Schools?></h3>

						<p>Schools with >= 1 students</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph "></i>
					</div>
					<a href="<?php echo base_url()?>reg_schools"  class="small-box-footer"> More Info<i class="fa fa-arrow-circle-right"></i></a>

				</div>

			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3 id="aMS"><sup style="font-size: 20px"><?php echo $top_school_Reading['name']?></h3><!--<h3><?php /*echo "(".($top_school_Reading['appMinutes']/60/60).")"*/?></h3>-->


						<p>Top school (Reading and viewing content)</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="<?php echo base_url()?>top_reading"  class="small-box-footer"> More Info<i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">

						<h3 id="nS"><sup style="font-size: 20px"><?php echo $top_school_students['name']?></h3><h3><?php echo "(" . $top_school_students['count'] .")"?></h3>


						<p>Top school (Registered Students )</p>
					</div>
					<div class="icon">
						<i class="fa fa-times "></i>
					</div>
					<a href="<?php echo base_url()?>reg_schools"  class="small-box-footer"> More Info<i class="fa fa-arrow-circle-right"></i></a>

				</div>
			</div>


			<!-- ./col -->
		</div>

		<div class="row">
 <section class="col-lg-12">
				<h2> Top Schools in watching and reading content</h2>
                <!-- Custom tabs (Charts with tabs)-->
				<div class="table-responsive">
					<table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">	<thead>

						<tr>
					   <th> #</th>
					   <th>School Name </th>
					   <th>Number of students</th>
					  <!-- <th>Study minutes</th>
-->
					   <th>More Info</th>

				   </tr>
				   </thead>
				   <tbody id="students">
				   <?php
				   $count =0;
				   foreach ($school_usages as $school_usage){
				   	?>
				  <tr>
					  <?php
					  sscanf($school_usage->appMinutes, "%d:%d:%d", $hours, $minutes, $seconds);
					  $appMinutes = $hours * 3600 + $minutes * 60 + $seconds;
					  ?>

					  <td><?php echo $count+1?></td>
					  <td><?php echo $school_usage->name?></td>
					  <td><?php echo $school_usage->count?></td>
					  <!--<td><?php /*echo round($appMinutes / 60 ,2)*/?></td>-->

					  <td><a href="<?php echo base_url().'schools/'.$school_usage->code?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a></td>

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
