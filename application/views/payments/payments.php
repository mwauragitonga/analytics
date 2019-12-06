<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title; ?>

			</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url() ?>general"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Payments</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3 id="total_Revenue"></h3>

						<p>Total Revenue (STK push)</p>
					</div>
					<div class="icon">
						<i class="fa fa-money"></i>
					</div>
					<a href="<?php echo base_url() ?>payers" class="small-box-footer">More info <i
							class="fa fa-arrow-circle-right"></i></a>

				</div>
			</div>
			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3 id="org_balance"></h3>

						<p>Org Balance(Pay Bill)</p>
					</div>
					<div class="icon">
						<i class="fa fa-money"></i>
					</div>
					<a href="<?php echo base_url() ?>payment_reports" class="small-box-footer"> More Info <i
							class="fa fa-arrow-circle-right"></i></a>

				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-primary">
					<div class="inner">
						<h3 id="aYS"><sup style="font-size: 20px"></sup></h3>

						<p>Active Yearly Subscribers</p>
					</div>
					<div class="icon">
						<i class="ion ion-stats-bars"></i>
					</div>
					<a href="" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>

				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green-gradient">
					<div class="inner">
						<h3 id="aTS"></h3>

						<p>Active Termly Subscribers</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph "></i>
					</div>
					<a href="" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>

				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3 id="aMS"></h3>

						<p>Active Monthly Subscribers</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
				</div>
			</div>

			<div class="col-lg-2 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3 id="successRate"></h3>

						<p>Payment Success Rate</p>
					</div>
					<div class="icon">
						<i class="fa fa-check"></i>
					</div>
				</div>
			</div>

			<!-- ./col -->
		</div>
		<!-- /.row -->
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-12">
				<!-- Custom tabs (Charts with tabs)-->
				<div class="nav-tabs-custom">
					<!-- Tabs within a box -->
					<ul class="nav nav-tabs pull-right">
						<div class="chart" id="total_subscriptions" style="height: 400px;"></div>

					</ul>
					<div class="tab-content no-padding">
						<div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
					</div>
				</div>
				<!-- /.nav-tabs-custom -->

			</section>
		</div>

		<!-- Main row -->
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-6 col-md-12 col-sm-12">
				<!-- Custom tabs (Charts with tabs)-->
				<div class="nav-tabs-custom">
					<!-- Tabs within a box -->
					<ul class="nav nav-tabs pull-right">
						<div class="chart" id="subscriptions" style="height: 400px;"></div>

					</ul>
					<div class="tab-content no-padding">
						<div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
					</div>
				</div>
				<!-- /.nav-tabs-custom -->

			</section>
			<!-- /.Left col -->
			<!-- right col (We are only adding the ID to make the widgets sortable)-->
			<section class="col-lg-6 ">

				<!-- Calendar -->

				<!-- /.box-header -->
				<div class="box-body no-padding">
					<div class="chart" id="revenue_by_month" style="height: 400px;"></div>


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
<!--Line graph comparison of subscription types-->
<script>
    window.onLoad = xHR();

    function xHR() {


        var response;
        var startDate;
        var endDate;
        var request = new XMLHttpRequest();
        request.open("POST", "<?php echo base_url() . 'tiles' ?>");
        request.setRequestHeader('Content-Type', 'application/json');
        let data = JSON.stringify({
            /* "start_date": startDate,
             "end_date": endDate*/
        });
        request.send(data);

        request.onload = () => {
           response = JSON.parse(request.responseText);
            var revenue = response.tiles_data.total_Revenue;
            var orgBalance = response.tiles_data.org_Balance;
            var aYS = response.tiles_data.active_Yearly_Subscribers;
            var aTS = response.tiles_data.active_Termly_Subscribers;
            var aMS = response.tiles_data.active_Monthly_Subscribers;
            // var nS = response.tiles_data.non_Subscribers;
            var payment_Attempts = response.tiles_data.payment_Attempts;
            var success_Attempts = response.tiles_data.successful_Payment_Attempts;
            var paymentSuccessRate = (success_Attempts / payment_Attempts) * 100;

            document.getElementById("total_Revenue").innerText = formatMoney(revenue);
            document.getElementById("org_balance").innerText = formatMoney(orgBalance);
            document.getElementById("aYS").innerText = aYS;
            document.getElementById("aMS").innerText = aMS;
            document.getElementById("aTS").innerText = aTS;
            //  document.getElementById("nS").innerText = nS;
            document.getElementById("successRate").innerText = Math.round(paymentSuccessRate, 3).toString() + "%";

        };
    }

    var refresh = setInterval(xHR, 10000);
    window.addEventListener("load", function () {
            var response;
            var startDate;
            var endDate;
            var request = new XMLHttpRequest();
            request.open("POST", "<?php echo base_url() . 'graphs' ?>");
            request.setRequestHeader('Content-Type', 'application/json');
            let data = JSON.stringify({
                /* "start_date": startDate,
                 "end_date": endDate*/
            });
            request.send(data);

            request.onreadystatechange = () => {

                response = JSON.parse(request.responseText);
               // response = request.responseText;
                 console.log(response)
                var paybill_revenues = response.graph_data.paybill_total.map(Number);// includes tablet payments
                var revenue_By_Months = response.graph_data.revenue_By_Months.map(Number);
                var subscription_Comparisons = response.graph_data.subscriptions_Comparisons;
                var monthly = (subscription_Comparisons.monthly_subscriptions).map(Number);
                var yearly = subscription_Comparisons.yearly_subscriptions.map(Number);
                var termly = subscription_Comparisons.termly_subscriptions.map(Number);

                Highcharts.chart('subscriptions', {
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: 'Comparison of new subscriptions for the last 12 months'
                    },
                    subtitle: {
                        text: 'Source: Dawati Web and App'
                    },
                    xAxis: {
                        categories: getMonthsString()
                    },
                    yAxis: {
                        title: {
                            text: 'New Subscriptions'
                        }
                    },
                    plotOptions: {
                        line: {
                            dataLabels: {
                                enabled: true
                            },
                            enableMouseTracking: false
                        }
                    },
                    series: [
                        {
                            name: 'Monthly',
                            data: monthly
                        }, {
                            name: 'Termly',
                            data: termly
                        },
                        {
                            name: 'Yearly',
                            data: yearly
                        }]
                });
                Highcharts.chart('total_subscriptions', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Revenue for the last 12 months'
                    },
                    xAxis: {
                        categories: getMonthsString()
                    },
                    yAxis: {
                        title: {
                            text: "Revenue (Ksh)"
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
                        name: 'Revenue',
                        data: paybill_revenues
                    }]
                });
                Highcharts.chart('revenue_by_month', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Subscription payments for the last 12 months'
                    },
                    xAxis: {
                        categories: getMonthsString()
                    },
                    yAxis: {
                        title: {
                            text: "Revenue (Ksh)"
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
                        name: 'Revenue',
                        data: revenue_By_Months
                    }]
                });

            }

        }
    )
    ;

    function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
        try {
            decimalCount = Math.abs(decimalCount);
            decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

            const negativeSign = amount < 0 ? "-" : "";

            let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
            let j = (i.length > 3) ? i.length % 3 : 0;

            return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands);
        } catch (e) {
            console.log(e)
        }
    };

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


</script>

