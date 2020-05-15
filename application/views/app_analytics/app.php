<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

session_start();

<div class="content-wrapper">
	<style>
		#loading {
			width: 100%;
			height: 100%;
			top: 0;
			left: 0 ;
			position: fixed;
			display: block;
			opacity: 0.9;
			background-color: #fff;
			z-index: 99;
			text-align: center;
		}

		#loading-image {
			position: absolute;
			top: 50%;
			left: 50%;
			z-index: 100;
		}
	</style>
	<div id="loading">
		<img id="loading-image" src="<?php echo base_url()?>assets/img/preloader.gif" alt="Loading..." />
	</div>
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1 id ="titleH">
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
		<!--  new  date picker added by Stan-->
		<div class="row">
			<form>
				<div class="form-group" style="width: 55%;float: right">
					<label for="date">Choose a date range</label>
					<input class="form-control" type="text" id="date" name="date"
						   style="width: 25%;"
						   onchange="dateChanged()">
				</div>
			</form>
		</div>
		<div class="row">

			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3 id="VideoMinsWatched"></h3>

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
						<h3 id="booksMinRead"><sup style="font-size: 20px"></sup></h3>

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
						<h3 id="totalWatchersUnique"></h3>

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
						<h3 id="totalReaders"></h3>

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
						<h3 id="uniqueSignins"></h3>

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
						<h3 id="appUsageMins"></h3>

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
						<h3 id="allSignins"></h3>

						<p>Sign Ins (All)</p>
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
				<div class="small-box bg-green">
					<div class="inner">
						<h3 id="totalViews"></h3>

						<p>Total Views</p>
					</div>
					<div class="icon">
						<i class="fa fa-file-video-o"></i>
					</div>
					<a class="small-box-footer"> <i
							class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3 id="totalReads"></h3>

						<p>Total Reads</p>
					</div>
					<div class="icon">
						<i class="fa fa-book"></i>
					</div>
					<a class="small-box-footer"> <i
							class="fa fa-arrow-circle-right"></i></a>

				</div>
			</div>

		</div>
		<!-- /.row -->
		<!-- Main row -->
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-8">
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
							<th>Study Minutes</th>
							<th>More Info</th>

							<!--							<th>user_id</th>-->

						</tr>
						</thead>


						<tbody id="signUps">


						</tbody>

					</table>
				</div>
				<!-- /.nav-tabs-custom -->

			</section>
			<!-- /.Left col -->
			<!-- right col (We are only adding the ID to make the widgets sortable)-->
			<section class="col-lg-4 ">


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

<script>
	// new script functions by stan
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

	$(document).ready(function () {
		var date = document.getElementById("date").value;
		console.log(date);
		loadData(date)
	});

    function loadData(date) {
        // console.log(dateString_initial)
        var request = new XMLHttpRequest();
        request.open("POST", "<?php echo base_url() . 'appData'?>");
        request.setRequestHeader('Content-Type', 'application/json');
        var tbody = document.getElementById("signUps");
        var tr = '';
        let data = JSON.stringify({
            "date": date
        });
        request.send(data);
		$("table > tbody> tr ").hide().slice(0,25).show();
		$
        request.onload = () => {
            var response = JSON.parse(request.responseText);
           //  var response = request.responseText;
          console.log(response)
            //console.log(tr)
            var booksMinsRead= response.books_mins_Read;
            var videoMinutesWatched = response.video_Minutes_watched;
            var totalWatchers = response.total_watchers;
            var totalReaders = response.total_Readers;
            var uniqueSignins= response.unique_signins;
            var allSigns = response.all_signs;
            var appUsageMins = response.app_usage_minutes;
            var topStudents = response.students;
            var totalReads = response.total_reads;
            var totalViews = response.total_views;
            var totalWatchersUnique = response.total_views;
			var totalWatchTime= booksMinsRead+ videoMinutesWatched;

			document.getElementById('booksMinRead').innerText = booksMinsRead;
			document.getElementById('VideoMinsWatched').innerText = videoMinutesWatched;
			document.getElementById('totalReaders').innerText = totalReaders;
			document.getElementById('uniqueSignins').innerText = uniqueSignins;
			document.getElementById('allSignins').innerText = allSigns;
			document.getElementById('appUsageMins').innerText = appUsageMins;
			// document.getElementById('students').innerText = topStudents;
			document.getElementById('totalReads').innerText = totalReads;
			document.getElementById('totalViews').innerText = totalViews;
			document.getElementById('totalWatchersUnique').innerText = totalWatchers;

			for (var i = 0; i < topStudents.length; i++) {
				var fname = topStudents[i].fname;
				var phone_type = topStudents[i].phone_type;
				var school = topStudents[i].name;
				var study_level = topStudents[i].level_name;
				var mobile = topStudents[i].mobile;
				var user_id = topStudents[i].user_id;
				var totalMinsWatched = topStudents[i].appMinutes;
				var link = "<a href='https://analytics.dawati.co.ke/users/" + user_id + "'>More Info </a>";

				//  console.log(phone_type);

				tr += "<tr><td>" + (i + 1) + "</td><td>" + fname + "</td><td>" + mobile + "</td><td>" + school + "</td><td>" + study_level + "</td><td>" + phone_type + "</td><td>" + totalMinsWatched + "</td><td>" + link + "</td></tr>";
				//console.log(tr)

			}
			tbody.innerHTML = tr;
			document.getElementById("titleH").innerText = 'App Analytics (' + date + ' )'
		}
		$('#loading').hide();
	//	$("#datatable-buttons").dataTable().fnDestroy()
		//init_DataTables();


	}


</script>

