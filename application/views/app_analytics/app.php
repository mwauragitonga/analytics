<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title; ?>

			</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>general"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">ebooks</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?php echo $video_Minutes_Watched; ?></h3>

						<p>Video Minutes Watched</p>
					</div>
					<div class="icon">
						<i class="fa fa-file-video-o"></i>
					</div>
					<a href="<?php echo base_url() ?>videos" class="small-box-footer">More info <i
							class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?php echo $book_Minutes_Read; ?><sup style="font-size: 20px"></sup></h3>

						<p>Book Minutes Read</p>
					</div>
					<div class="icon">
						<i class="fa fa-book"></i>
					</div>
					<a href="<?php echo base_url() ?>ebooks" class="small-box-footer">More info <i
							class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3><?php echo $total_Watchers; ?></h3>

						<p>Total Viewers(Unique)</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph "></i>
					</div>
					<!--                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					-->                </div>
			</div>
			<!-- ./col -->
			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?php echo $total_Readers; ?></h3>

						<p>Total Readers (Unique)</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<!--                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					-->                </div>
			</div>
			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?php echo $unique_signins; ?></h3>

						<p>Sign Ins (Unique)</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="<?php echo base_url() ?>signins" class="small-box-footer">More info <i
							class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-blue">
					<div class="inner">
						<h3><?php echo $app_Usage_Minutes; ?></h3>

						<p>App Usage ( Hours)</p>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>
					<!--					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					-->                </div>
			</div>
			<!-- ./col -->
		</div>
		<div class="row">
			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?php echo $all_signins; ?></h3>

						<p>Sign Ins (All)</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="<?php echo base_url() ?>signins" class="small-box-footer">More info <i
							class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

		</div>
		<!-- /.row -->
		<!-- Main row -->
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-7">
				<h2> Top Students in watching and reading content</h2>
				<hr>
				<!-- Custom tabs (Charts with tabs)-->
				<div class="table-responsive">
					<table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
						<thead>

						<tr>
							<th> #</th>
							<th>Name</th>
							<th>Phone Number</th>
							<th>School</th>
							<th>Study Level</th>
							<th>Phone Model</th>
<!--							<th>Study minutes</th>
-->							<th>More Info</th>

						</tr>
						</thead>
						<tbody id="students">
						<?php
						$count = 0;
						foreach ($students as $student) {
							?>
							<tr>
								<?php
								sscanf($student->appMinutes, "%d:%d:%d", $hours, $minutes, $seconds);
								$appMinutes = $hours * 3600 + $minutes * 60 + $seconds;
								?>

								<td><?php echo $count + 1 ?></td>
								<td><?php echo $student->fname ?></td>
								<td><?php echo $student->mobile ?></td>
								<td><?php echo $student->name ?></td>
								<td><?php echo $student->level_name ?></td>
								<td><?php echo $student->phone_type ?></td>
<!--								<td><?php /*echo round($appMinutes / 60, 2) */?></td>
-->
								<td><a href="<?php echo base_url() . 'users/' . $student->user_id ?>"
									   class="small-box-footer">More
										info <i class="fa fa-arrow-circle-right"></i></a></td>

							</tr>


							<?php $count++;
						}
						?>

						</tbody>
					</table>
				</div>
				<!-- /.nav-tabs-custom -->

			</section>
			<!-- /.Left col -->
			<!-- right col (We are only adding the ID to make the widgets sortable)-->
			<section class="col-lg-5 ">


				<!-- /.box-header -->
				<div class="box-body no-padding">
					<!--Student Classification -->
					<div class="chart" id="internet_type" style="height: 350px;"></div>

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
<script>
	Highcharts.chart('internet_type', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Internet Types used by Users'
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.percentage:.1f} %'
				}
			}
		},
		series: [{
			name: 'Internet Type',
			colorByPoint: true,
			data: [{
				name: 'WI-FI',
				y: <?php echo $internet_type['wifi'] ?>,
				sliced: true,
				selected: true
			}, {
				name: 'Mobile Data',
				y: <?php echo $internet_type["mobile"] ?>
			},]
		}]
	});
</script>

