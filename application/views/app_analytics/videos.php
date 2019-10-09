<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title; ?>

			</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>general"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Videos</li>
		</ol>
	</section>

	<div class="row">
		<!-- Left col -->
		<section class="col-lg-7">
			<table id="example1" class="table table-bordered table-striped table-responsive">
				<thead>
				<th>#</th>
				<th>Subtopic Name</th>
				<th>Total Minutes Watched</th>
				<th>Total Views</th>
				<th>Average Minutes per view</th>

				</thead>
				<tbody>
				<?php
				$count =0;
				foreach ($videos as $video) {
					?>
					<tr>
						<td><?php echo $count + 1 ?></td>
						<td><?php echo $video->name . "  "  ?><span class="badge badge-info"><?php echo $video->subject ?></span> </td>
						<td><?php echo gmdate('i :s', $video->watchSecs); ?></td>
						<td><?php echo $video->count; ?></td>
						<td><?php echo gmdate('i :s', $video->avgWatchSecs); ?></td>
					</tr>
					<?php
					$count++;
				}
				?>

				</tbody>
			</table>

		</section>
		<!-- /.Left col -->
		<!-- right col (We are only adding the ID to make the widgets sortable)-->
		<section class="col-lg-5 ">
			<div class="chart" id="video_by_minutes" style="height: 350px;"></div>

		</section>

</div>
</div>
<script>
    Highcharts.chart('video_by_minutes', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Top 10 watched videos by minutes'
        },
        xAxis: {
            type: '',
            categories:[<?php
				$count=0;
				foreach($videos as $video){
					$count +=1;
					if($count== count($videos)){
						echo '"'.$video->name.'"';
					}else{
						echo  '"'.$video->name .'", ';
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
                text: 'Minutes'
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
                name: "Subtopic Name",
                colorByPoint: true,
                data: [<?php
					$count=0;
					foreach($videos as $video){
						$count +=1;
						if($count== 10){
							echo round(($video->watchSecs)/60,2);
						}else{
							echo round(($video->watchSecs)/60,2).',';
						}
						if($count == 10){
							break;
						}
					}; ?>
                ]
            }
        ],

    });</script>
