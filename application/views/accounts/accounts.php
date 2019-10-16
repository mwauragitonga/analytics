


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
			<li class="active">Accounts</li>
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
						<h3><?php echo $active ; ?></h3>

						<p>Active Accounts</p>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>

				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?php echo $inactive  ; ?>
							<sup style="font-size: 20px"></sup></h3>
						<p>Inactive Accounts</p>
					</div>
					<div class="icon">
						<i class="ion ion-stats-bars"></i>
					</div>
<!--					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
				    <h3><?php echo $monthlyUsers ; ?></h3>

						<p>Active Users in the Last Month</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph "></i>
					</div>
<!--					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?php echo ($weeklyUsers) ; ?></h3>

						<p>Active Users in the Last Week</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="<?php echo base_url();?>activeUsers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
<!--						<div class="form-group">-->
<!--							<label>Filter SignUps</label>-->
<!--							<select class="form-control select2" name="select_period" id="select_period" onchange="selectPeriod()" style="width: 50%;">-->
<!--								<option disabled="disabled" selected="selected">Select period</option>-->
<!--								<option value="today">Today</option>-->
<!--								<option value="yesterday">Yesterday</option>-->
<!--								<option value="last_week">Last 7 Days</option>-->
<!--								<option value="custom">Custom</option>-->
<!--							</select>-->
<!--							<div  style="display: none" id="date_picker">-->
<!--								<input type="date"  class="form-control" id="start_date" name="startDate" style="width: 50%;" >-->
<!--								<input type="date"  class="form-control" id="end_date" name="endDate" style="width: 50%;" >-->
<!--							</div>-->
<!--						</div>-->
						<div class="chart" id="signups" style="height: 350px;"></div>
						<br>
						<br>
						<br>
						<div class="chart" id="active_users" style="height: 450px;"></div>

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
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<!--Student Classification -->
						<div class="chart" id="active" style="height: 350px;"></div>

					</div>
					<br>
					<br>
					<br>
					<div class="chart" id="logged_in" style="height: 350px;"></div>


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

<script type="text/javascript">
    function selectPeriod() {
		var currentDate = new Date();
        var period = document.getElementById('select_period').value
        var start_Date;
        var end_Date;

        if (period == 'today') {
            document.getElementById('date_picker').style.display = "none";

            var date = currentDate.getDate();
            var month = currentDate.getMonth(); //Be careful! January is 0 not 1
            var year = currentDate.getFullYear();

            var dateString = year + "-0" + (month + 1) + "-" + date;
            start_Date = dateString;
            end_Date = dateString;
            var post_Data = {
                "start_Date": start_Date,
                "end_Date": end_Date
            }
            initialize(post_Data);
        } else if (period == 'yesterday') {
            document.getElementById('date_picker').style.display = "none";
            var date = currentDate.getDate();
            var month = currentDate.getMonth(); //Be careful! January is 0 not 1
            var year = currentDate.getFullYear();

            var dateString = year + "-0" + (month + 1) + "-" + (date - 1);
            start_Date = dateString;
            end_Date = dateString;
            var post_Data = {
                "start_Date": start_Date,
                "end_Date": end_Date
            }
            initialize(post_Data);
        } else if (period == 'last_week') {
            document.getElementById('date_picker').style.display = "none";
            var date = currentDate.getDate();
            var month = currentDate.getMonth(); //Be careful! January is 0 not 1
            var year = currentDate.getFullYear();


            start_Date = year + "-0" + (month + 1) + "-" + (date - 6);
            end_Date = year + "-0" + (month + 1) + "-" + date;;
            var post_Data = {
                "start_Date": start_Date,
                "end_Date": end_Date
            }
            initialize(post_Data);
        } else if (period == 'custom') {
            document.getElementById('date_picker').style.display = "block";
        }
    }

</script>
<script>
    function selectPeriod_datePicker() {
        var start_Date = document.getElementById("start_date").value;
        var end_Date = document.getElementById("end_date").value;
		var post_Data = {
            "start_Date": start_Date,
            "end_Date": end_Date
        }
        initialize(post_Data);

    }

</script>
<script type="text/javascript">
	function  intialize() {
        $.ajax({
            type: "post",
            url: '<?= base_url(); ?>filter',
            cache: false,
            dataType: 'json',
            data: $(post_Data).serialize(),
            success:function(data){
                alert(data)
            }
        })
	}
</script>
<!--/* graph of the various registration sources */-->
<script>
    // Create the chart
    Highcharts.chart('signups', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Classification of Signups by Registrations Source'
        },
        xAxis: {
            type: '',
            categories:['Web', 'App', 'Unclassified'],
            labels: {
                style: {
                    color: 'black',
                    fontSize:'13px'
                }
            }

        },

        yAxis: {
            title: {
                text: 'Number of Signups'
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
                name: "Registration Source",
                colorByPoint: true,
                data: [
                    {
                        name: "Web",
                        y: <?php  echo $webRegistrations ; ?>,

                    },
                    {
                        name: "App",
                        y: <?php  echo $appRegistrations ; ?>

                    },
                    {
                        name: "Unclassified",
                        y:<?php  echo $unclassified ; ?>,

                    },

                ]
            }
        ],

    });
</script>
<!--pie chart for active vs inactive accounts-->
<script>
    // Build the chart
    Highcharts.chart('active', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Classification of Active vs Inactive Accounts'
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
                y: <?php echo  $active ; ?>,
                sliced: true,
                selected: true
            }, {
                name: 'Inactive',
                y: <?php echo $inactive ; ?>
            }]
        }]
    });
</script>
<!--pie chart for logged in vs logged out accounts-->

<script>
    // Build the chart
    Highcharts.chart('logged_in', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Classification of Logged in vs Logged out Accounts'
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
                name: 'Logged In',
                y: <?php echo  $loggedIn; ?>,
                sliced: true,
                selected: true
            }, {
                name: 'Logged Out',
                y: <?php echo $loggedOut ; ?>
            }]
        }]
    });
</script>
<!--graph for active users over last 12 months-->
<script>
    function getMonthsString() {
        var today = new Date;
        var current = today.getMonth();

        var monthString = new Array();
        var month = new Array();
        for (var i = 11; i > -1; i--) {
            var d = new Date;
            d.setMonth(today.getMonth() - i);
            month[0] = "Jan";
            month[1] = "Feb";
            month[2] = "Mar";
            month[3] = "Apr";
            month[4] = "May";
            month[5] = "June";
            month[6] = "July";
            month[7] = "Aug";
            month[8] = "Sept";
            month[9] = "Oct";
            month[10] = "Nov";
            month[11] = "Dec";
            //month[d.getMonth()];
            monthString.push(month[d.getMonth()]);

        }
        //  var kji =monthString.join('\,');
        //  console.log(kji);
        return monthString;
    }
    Highcharts.chart('active_users', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Active users for the last 12 months'
        },
        xAxis: {
            categories: getMonthsString()
        },
        yAxis: {
            title: {
                text: "Users"
            }
        },
        plotOptions: {
            column: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Active Users',
            data: [<?php
					$count=0;
					foreach($annualUsers as $users){
					$count +=1;
				if($count== count($annualUsers)){
					echo $users;
				}else{
					echo  $users .',';
				}
			} ; ?>]
        }]
    });


</script>
<script>

</script>
