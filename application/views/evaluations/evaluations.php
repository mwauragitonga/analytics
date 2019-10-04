


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title ; ?>

			</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>general"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Evaluations</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
				<h3><?php echo $available ; ?></h3>

						<p>Exams Available </p>
					</div>
					<div class="icon">
						<i class="fa fa-ravelry"></i>
					</div>
					<!--                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?php echo $attemptsToday  ; ?>
							<sup style="font-size: 20px"></sup></h3>

						<p>Exams Attempted Today</p>
					</div>
					<div class="icon">
						<i class="fa fa-asterisk"></i>
					</div>
					<!--                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
							<h3><?php echo  $totalAttempts; ?></h3>

						<p>Total Exam Attempts</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<!--                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
				</div>
			</div>

			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3><?php echo round($average, 2)*100 .'%'; ?></h3>

						<p>Average Exam Score</p>
					</div>
					<div class="icon">
						<i class="fa fa-sitemap "></i>
					</div>
					<!--                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
				</div>
			</div>
			<!-- ./col -->

			<!-- ./col -->
		</div>
		<!-- /.row -->
		<!-- Main row -->
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-6 ">
				<!-- Custom tabs (Charts with tabs)-->
				<div class="nav-tabs-custom">
					<!-- Tabs within a box -->
					<ul class="nav nav-tabs pull-right">
						<div class="chart" id="active_users" style="height: 350px;"></div>
						<br>
						<br>
						<br>
						<div class="chart" id="topVideos" style="height: 350px;"></div>
						<br>
						<br>
						<br>
						<div class="chart" id="topBooks" style="height: 350px;"></div>
					</ul>
					<div class="tab-content no-padding">
						<div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
					</div>
				</div>
				<!-- /.nav-tabs-custom -->
				<!-- solid sales graph -->
				<div class="box box-solid bg-teal-gradient">

			</section>
			<!-- /.Left col -->

			<section class="col-lg-6 ">


				<div class="box box-solid ">
					<div class="box-header">
						<i class="fa fa-line-chart"></i>

					</div>
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<!-- Sign Ups -->
						<div class="chart" id="signups" style="height: 350px;"></div>

					</div>
					<br>
					<br>
					<br>
					<div class="chart" id="subscriptions" style="height: 350px;"></div>

					<!-- /.box-body -->
					<div class="box-footer text-black">
						<br>
						<br>
						<br>
						<div class="chart" id="subscription_types" style="height: 450px;"></div>
					</div>
				</div>
				<!-- /.box -->

			</section>
			<!-- right col -->
		</div>
		<!-- /.row (main row) -->

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->




