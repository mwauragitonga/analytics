<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title . ''; ?>

			</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>general"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Web Analysis</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="row">
				<form>
					<div class="form-group" style="width: 55%;float: right">
						<label for="date">Choose a date range</label>
						<input class="form-control" type="text" id="date" name="date" value="" min="23-"
							   style="width: 25%;"
							   onchange="dateChanged()">


					</div>
				</form>
			</div>

			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3 id="sign_ups"><?php echo $signUps; ?></h3>

						<p>Total Sign Ups</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<!--                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3 id="logins"><?php echo $logins; ?>
							<sup style="font-size: 20px"></sup></h3>

						<p>Log Ins</p>
					</div>
					<div class="icon">
						<i class="fa fa-sign-in"></i>
					</div>
					<a href="<?php echo base_url(); ?>logins" class="small-box-footer">More info <i
							class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3 id="videoViews"><?php echo $views; ?></h3>

						<p>Video Views</p>
					</div>
					<div class="icon">
						<i class="fa fa-television"></i>
					</div>
					<a href="<?php echo base_url(); ?>videoViewers" class="small-box-footer">More info <i
							class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3 id="freeContent"><?php echo $freeContentViews; ?></h3>

						<p>Free Content Usage</p>
					</div>
					<div class="icon">
						<i class="fa fa-free-code-camp"></i>
					</div>
					<a href="javascript:;" class="small-box-footer">More info <i
							class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3 id="bookReads"><?php echo $reads; ?></h3>

						<p>Books Read</p>
					</div>
					<div class="icon">
						<i class="fa fa-book"></i>
					</div>
					<a href="<?php echo base_url(); ?>bookReaders" class="small-box-footer">More info <i
							class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-teal">
					<div class="inner">
						<h3 id="attempted_Payments"><?php echo $attempts; ?></h3>

						<p> Attempted Payments</p>
					</div>
					<div class="icon">
						<i class="fa fa-credit-card"></i>
					</div>
					<a href="<?php echo base_url(); ?>attempted_payments" class="small-box-footer">More info <i
							class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
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
<!--						<div class="chart" id="topBooks" style="height: 350px;"></div>
-->
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

					<!-- /.box-header -->
					<div class="box-body no-padding">
						<!-- Sign Ups -->
						<div class="chart" id="signups" style="height: 350px;"></div>

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
<!--graph for logins over last week-->
<script>
    function getDaysString() {
        var today = new Date;
        var current = today.getDay();
        //console.log(today);
        var dayString = new Array();
        var day = new Array();
        var d = new Date;
        day[0] = "Sunday";
        day[1] = "Monday";
        day[2] = "Tuesday";
        day[3] = "Wednesday";
        day[4] = "Thursday";
        day[5] = "Friday";
        day[6] = "Saturday";

        for (var i = 6; i >= 0; i--) {
            var d = new Date;
            d.setDate(today.getDay()-(i+6));
            dayString.push(day[d.getDay()]);
        }

        console.log( dayString);
        return dayString;
    }

    Highcharts.chart('active_users', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Logins for the last 7 Days'
        },
        xAxis: {
            categories:getDaysString()
        },
        yAxis: {
            title: {
                text: "Logins"
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
            name: 'Logins',
            data: [<?php
				$count = 0;
				foreach ($weeklyUsers as $users) {
					$count += 1;
					if ($count == count($weeklyUsers)) {
						echo $users;
					} else {
						echo $users . ',';
					}
				} ; ?>]
        }]
    });


</script>
<script>

    Highcharts.chart('signups', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Sign Ups for the last 7 Days'
        },
        xAxis: {
            categories: getDaysString()
        },
        yAxis: {
            title: {
                text: "Sign Ups"
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
            name: 'SignUps',
            data: [<?php
				$count = 0;
				foreach ($weeklySignups as $users) {
					$count += 1;
					if ($count == count($weeklySignups)) {
						echo $users;
					} else {
						echo $users . ',';
					}
				} ; ?>]
        }]
    });
    var currentDate = new Date();
    var maxDate = currentDate.getDate();
    $('input[name="date"]').daterangepicker({
        "minDate": "09/23/2019",
        "opens": "center",
        "autoApply": true,
        "maxDate": maxDate
    });

    function dateChanged() {
        var date = document.getElementById("date").value;
        console.log(date);
        loadData(date)
    }

    function loadData(date) {
        // console.log(dateString_initial)
        var request = new XMLHttpRequest();
        request.open("POST", "<?php echo base_url() . 'webData'?>");
        request.setRequestHeader('Content-Type', 'application/json');
        let data = JSON.stringify({
            "date": date
        });
        request.send(data);

        request.onload = () => {
             var response = JSON.parse(request.responseText);
           // var response = request.responseText;
           console.log(response)
            var signups = response.sign_Ups;
            var logins = response.logins;
            var video_views = response.videos_Views;
            var freeContent = response.book_Reads;
            var booksRead = response.attempted_payments;
            var attempted_payments = response.free_content;
            document.getElementById('sign_ups').innerText = signups;
            document.getElementById('logins').innerText = logins;
            document.getElementById('videoViews').innerText = video_views;
            document.getElementById('freeContent').innerText = freeContent;
            document.getElementById('bookReads').innerText = booksRead;
            document.getElementById('attempted_Payments').innerText = attempted_payments;
        }
    }
</script>


