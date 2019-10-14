


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
						<i class="fa fa-universal-access"></i>
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
			<section class="col-lg-8 ">
				<!-- Custom tabs (Charts with tabs)-->
				<div class="nav-tabs-custom">
					<!-- Tabs within a box -->
					<ul class="nav nav-tabs pull-right">
						<div class="chart" id="topExams" style="height: 450px;"></div>

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

			<section class="col-lg-4 ">


				<div class="box box-solid ">
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<table id="example1" class="table table-bordered table-striped">
							<h3>Students Leader-board</h3>
							<thead>
							<tr>
								<th> #</th>
								<th>Name </th>
								<th>Exam Attempts</th>
							</tr>
							</thead>
							<tbody>
							<?php $count= 1;
							foreach ($topStudents as $student){ ?>
							<tr>
								<td><?php echo $count ; ?></td>
								<td><?php echo $student->fname.' '. $student->lname ;?></td>
								<td><?php echo $student->count ; ?></td>
							</tr>
							<?php
								$count++;
							}
							?>
							</tbody>
						</table>

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

<!--/*bar graph for top 5 viewed exams*/-->
<script>
    // Create the chart
    Highcharts.chart('topExams', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Most Attempted Exams'
        },
        xAxis: {
            type: '',
            categories:[<?php
				$count=0;
				foreach($topExams as $exam){
					$count +=1;
					if($count== count($topExams)){
						echo '"'.$exam->exam_name.'"';
					}else{
						echo  '"'.$exam->exam_name .'", ';
					}
				}; ?>],
            labels: {
                style: {
                    color: 'black',
                    fontSize:'13px'
                }
            }

        },

        yAxis: {
            title: {
                text: 'Number of Attempts'
            }

        },
        legend: {
            enabled: true
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    // format: '{point.y:.}'
                }
            }
        },

        tooltip: {
            // headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span><br/>'
        },

        series: [
            {
                name: "Exam Names",
                colorByPoint: true,
                data: [<?php
					$count=0;
					foreach($topExams as $exam){
						$count +=1;
						if($count== count($topExams)){
							echo $exam->count;
						}else{
							echo  $exam->count .',';
						}
					}; ?>
                ]
            }
        ],

    });

</script>


