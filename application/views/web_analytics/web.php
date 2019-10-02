


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
						<h3><?php echo $signUps ; ?></h3>

                        <p>Sign Ups </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
<!--                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                     <h3><?php echo $logins  ; ?>
						 <sup style="font-size: 20px"></sup></h3>

                        <p>Log Ins Today</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
<!--                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                   <h3><?php echo $views ;?></h3>

                        <p>Video Views Today</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph "></i>
                    </div>
<!--                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                  <h3><?php echo  $reads ; ?></h3>

                        <p>Books Read Today</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
<!--                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
                </div>
            </div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-teal">
					<div class="inner">
						<h3><?php echo $attempts ;?></h3>

						<p>Attempted Payments Today</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph "></i>
					</div>
					<!--                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
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
<!--graph for logins over last week-->
<script>
    function getDaysString() {
        var today = new Date;
        var current = today.getDay();
		//console.log(today);
        var dayString = new Array();
        var day = new Array();


        for (var i =7; i > 0; i--) {
            var d = new Date;
/**/		d.setDate(today.getDay() - i);
            day[0] = "Sunday";
            day[1] = "Monday";
            day[2] = "Tuesday";
            day[3] = "Wednesday";
            day[4] = "Thursday";
            day[5] = "Friday";
            day[6] = "Saturday";

            dayString.push(day[d.getDay()]);
            //d.setDate(d.getDay());
			//console.log(today.getDay());
        }
    //
    //     var inverseDayString = new Array();
    //     var k = 6;
	// 	for(var j=0;j<7;j++){
	//     inverseDayString[j] = dayString[k];
	//     k--;
    //
	//
	// }
       // console.log( dayString);
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
            categories: getDaysString()
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
            name: 'Logged In Users',
            data: [<?php
				$count=0;
				foreach($weeklyUsers as $users){
					$count +=1;
					if($count== count($weeklyUsers)){
						echo $users;
					}else{
						echo  $users .',';
					}
				} ; ?>]
        }]
    });


</script>
<script>
    function getDaysString() {
        var today = new Date;
        var current = today.getDay();
        //console.log(today);
        var dayString = new Array();
        var day = new Array();
        var d = new Date;

        for (var i =7; i > 0; i--) {
            var d = new Date;
            /**/
			d.setDate(today.getDay() - i);
            day[0] = "Sunday";
            day[1] = "Monday";
            day[2] = "Tuesday";
            day[3] = "Wednesday";
            day[4] = "Thursday";
            day[5] = "Friday";
            day[6] = "Saturday";

            dayString.push(day[d.getDay()]);
            //d.setDate(d.getDay());
            console.log(today.getDay());
        }

       // console.log( dayString);
        return dayString;
    }
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
            name: 'Logged In Users',
            data: [<?php
				$count=0;
				foreach($weeklySignups as $users){
					$count +=1;
					if($count== count($weeklySignups)){
						echo $users;
					}else{
						echo  $users .',';
					}
				} ; ?>]
        }]
    });


</script>


