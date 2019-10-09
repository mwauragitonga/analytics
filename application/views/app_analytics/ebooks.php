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
				<th>e-Book Name</th>
				<th>Total Minutes read</th>
				<th>Total Reads</th>
				<th>Average minutes per read</th>
				</thead>
				<tbody>
				<?php
				$count =0;
				foreach ($books as $book) {
					?>
					<tr>
						<td><?php echo $count + 1 ?></td>
						<td><?php echo $book->name . "  "  ?><span class="badge badge-info"><?php echo $video->subject ?></span> </td>
						<td><?php echo gmdate('i :s', $book->readSecs); ?></td>
						<td><?php echo gmdate('i :s', $book->avgReadSecs); ?></td>
						<td><?php echo $book->count; ?></td>
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
            text: 'Most watched videos by minutes'
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
							echo gmdate('i',$video->watchSecs);
						}else{
							echo gmdate('i',$video->watchSecs).',';
						}
						if($count == 10){
							break;
						}
					}; ?>
                ]
            }
        ],

    });</script>
