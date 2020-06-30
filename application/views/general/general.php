


	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
                <?php echo $title ; ?>

                </small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Dashboard</li>
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
							<h3><?php echo $studentCount ; ?></h3>

							<p>Students</p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
<!--						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-2 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
							<h3><?php echo count($maleCount)  ; ?><sup style="font-size: 20px"></sup></h3>

							<p>Male Students</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
<!--						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-2 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3><?php echo count($femaleCount) ; ?></h3>

							<p>Female Students</p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph "></i>
						</div>
<!--						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-2 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-green-active">
						<div class="inner">
							<h3><?php echo $webHits ; ?></h3>

							<p>Web Hits</p>
						</div>
						<div class="icon">
							<i class="ion ion-magnet "></i>
						</div>
						<!--						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-red">
						<div class="inner">
							<h3><?php echo ($signupsToday) ; ?></h3>

							<p>Sign Ups Today</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
					<a href="<?php echo base_url();?>accountsview" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>
			<!-- /.row -->
			<!-- Main row -->
			<div class="row">
				<!-- Left col -->
				<section class="col-lg-7 connectedSortable">
					<!-- Custom tabs (Charts with tabs)-->
					<div class="nav-tabs-custom">
						<!-- Tabs within a box -->
						<ul class="nav nav-tabs pull-right">
							<div class="chart" id="studyLevel" style="height: 350px;"></div>
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
				<!-- right col (We are only adding the ID to make the widgets sortable)-->
				<section class="col-lg-5 connectedSortable">

					<!-- Calendar -->
					<div class="box box-solid bg-green-gradient">
						<div class="box-header">
							<i class="fa fa-line-chart"></i>

						</div>
						<!-- /.box-header -->
						<div class="box-body no-padding">
							<!--Student Classification -->
							<div class="chart" id="gender" style="height: 350px;"></div>

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
<!--/*bar graph for students by study level*/-->
<script>
    // Create the chart
    Highcharts.chart('studyLevel', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Classification of Students by study level'
        },
        xAxis: {
            type: '',
            categories:['Version One ','Form One ', 'Form Two', 'Form Three', 'Form Four'],
            labels: {
                style: {
                    color: 'black',
                    fontSize:'13px'
                }
            }

        },

        yAxis: {
            title: {
                text: 'Number of Students'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    //  format: '{point.y:.}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span><br/>'
        },

        series: [
            {
                name: "Study-Levels",
                colorByPoint: true,
                data: [
                    {
                        name: "Version One",
                        y: <?php  echo $versionOne ; ?>,

                    },
					{
                        name: "Form One",
                        y: <?php  echo $formOnes ; ?>,

                    },
                    {
                        name: "Form Two",
                        y: <?php  echo $formTwos ; ?>

                    },
                    {
                        name: "Form Three",
                        y:<?php  echo $formThrees ; ?>,

                    },
                    {
                        name: "Form Four",
                        y:<?php  echo $formFours ; ?>
                    },

                ]
            }
        ],

    });
</script>
<!--/*bar graph for top 5 viewed videos*/-->
<script>
    // Create the chart
    Highcharts.chart('topVideos', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Most viewed Videos'
        },
        xAxis: {
            type: '',
            categories:[<?php
				$count=0;
				foreach($topVideos as $video){
					$count +=1;
					if($count== count($topVideos)){
						echo '"'.$video->file_name.'"';
					}else{
						echo  '"'.$video->file_name .'", ';
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
                text: 'Number of Views'
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
                name: "Names",
                colorByPoint: true,
                data: [<?php
					$count=0;
                   foreach($topVideos as $video){
                   	$count +=1;
                   	if($count== count($topVideos)){
                   		echo $video->Views;
					}else{
						echo  $video->Views .',';
					}
			}; ?>
                ]
            }
        ],

    });

</script>
<!--/*bar graph for top 5 read books*/-->
<script>
    // Create the chart
    Highcharts.chart('topBooks', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Most Read Books'
        },
        xAxis: {
            type: '',
            categories:[<?php
				$count=0;
				foreach($topEbooks as $book){
					$count +=1;
					if($count== count($topEbooks)){
						echo '"'.$book->file_name.'"';
					}else{
						echo  '"'.$book->file_name .'", ';
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
                text: 'Number of Reads'
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
         //   headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span><br/>'
        },

        series: [
            {
                name: "Names",
                colorByPoint: true,
                data: [<?php
					$count=0;
					foreach($topEbooks as $book){
						$count +=1;
						if($count== count($topEbooks)){
							echo $book->Views;
						}else{
							echo  $book->Views .',';
						}
					}; ?>
                ]
            }
        ],

    });

</script>
<!--pie chart for students by gender-->
<script>
    // Build the chart
    Highcharts.chart('gender', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Classification of students by gender'
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
                },
                showInLegend: true
            }
        },
        series: [{
            name: '',
            colorByPoint: true,
            data: [{
                name: 'Male',
                y: <?php echo count($maleCount) ; ?>,
                sliced: true,
                selected: true
            }, {
                name: 'Female',
                y: <?php echo count($femaleCount) ; ?>
            }]
        }]
    });
</script>
<!--pie chart for active vs inactive subscriptions-->
<script>
    // Build the chart
    Highcharts.chart('subscriptions', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Classification of students by subscriptions'
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
                },
                showInLegend: true
            }
        },
        series: [{
            name: '',
            colorByPoint: true,
            data: [{
                name: 'Active',
                y: <?php echo $activeSubs ; ?>,
                sliced: true,
                selected: true
            }, {
                name: 'Inactive',
                y: <?php echo $inactiveSubs ; ?>
            }, ]
        }]
    });
</script>
<!--pie chart for subscription types-->
<script>
    // Build the chart
    Highcharts.chart('subscription_types', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Classification of students by subscription types'
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
                    format: '<b>{point.name}</b>: {point.percentage:.2f} %'
                },
                showInLegend: true
            }
        },
        series: [{
            name: '',
            colorByPoint: true,
            data: [{
                name: 'Monthly',
                y: <?php echo $monthlySubs ; ?>,
                sliced: true,
                selected: true
            },  {
                    name: 'Annual',
                    y: <?php echo $annualSubs ; ?>
                }, {
                name: 'Termly',
                y: <?php echo $termlySubs ; ?>
            }, {
                name: 'None',
                y: <?php echo $nonSubs ; ?>
            }]
        }]
    });
</script>

