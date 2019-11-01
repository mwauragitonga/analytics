<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title; ?>

			</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>general"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</section>
	<br><hr>

	<div class="row ">
		<!-- Left col -->
		<section class="col-lg-12 col-md-12 content">
			<div class="table-responsive col-lg-12">
				<table class="table table-responsive table-striped" style="overflow: auto">
					<thead>
					<tr>
						<th> #</th>
						<th>School Name </th>
						<th>Number of students</th>
						<th>Study minutes</th>

						<th>More Info</th>

					</tr>
					</thead>
					<tbody id="students">
					<?php
					$count =0;
					foreach ($school_usages as $school_usage){
						?>
						<tr>
							<?php
							sscanf($school_usage->appMinutes, "%d:%d:%d", $hours, $minutes, $seconds);
							$appMinutes = $hours * 3600 + $minutes * 60 + $seconds;
							?>

							<td><?php echo $count+1?></td>
							<td><?php echo $school_usage->name?></td>
							<td><?php echo $school_usage->count?></td>
							<td><?php echo round($appMinutes / 60 ,2)?></td>

							<td><a href="<?php echo base_url().'schools/'.$school_usage->code?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a></td>

						</tr>




						<?php  $count++;
					}
					?>

					</tbody>
				</table>
			</div>


		</section>


	</div>
</div>
