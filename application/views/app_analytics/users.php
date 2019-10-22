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

	<div class="row container">
		<!-- Left col -->
		<section class="col-lg-6 col-md-6 content">
			Videos Read
			<div class="table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
				<th>#</th>
				<th>Video Name</th>
				<th>Total Minutes Viewed</th>
				<th>No. of Views</th>
				<th>Average minutes per view (i :s)</th>
				</thead>
				<tbody>
				<?php
				$count =0;
				foreach ($userStudyInfo['videos'] as $video) {
					sscanf($video->watchSecs, "%d:%d:%d", $hours, $minutes, $seconds);
					$appMinutes = $hours * 3600 + $minutes * 60 + $seconds;

					?>
					<tr>
						<td><?php echo $count + 1 ?></td>
						<td><?php echo $video->file_name . "  "  ?><span class="badge badge-info"><?php echo "" ?></span> </td>
						<td><?php echo  round($appMinutes / 60 ,2) ?></td>
						<td><?php echo $video->count; ?></td>
						<td><?php echo gmdate('i :s', $video->avgWatchSecs); ?></td>
					</tr>
					<?php
					$count++;
				}
				?>

				</tbody>
			</table>
			</div>


		</section>

		<section class="col-lg-6 col-md-6 content" >
			Books Read
			<div class="table-responsive">
			<table id="example1" class="table table-bordered table-striped table-responsive order-column" >
				<thead>
				<th>#</th>
				<th>Ebook Name</th>
				<th>Total Minutes read</th>
				<th>No. of Reads</th>
				<th>Average minutes per read</th>
				</thead>
				<tbody>
				<?php
				$count =0;
				foreach ($userStudyInfo['ebooks'] as $book) {

					sscanf($book->readSecs, "%d:%d:%d", $hours, $minutes, $seconds);
					$appMinutes = $hours * 3600 + $minutes * 60 + $seconds;
					?>
					<tr>
						<td><?php echo $count + 1 ?></td>
						<td><?php echo $book->file_name . "  "  ?><span class="badge badge-info"><?php echo "" ?></span> </td>
						<td><?php echo round($appMinutes/60,2); ?></td>
						<td><?php echo $book->count; ?></td>
						<td><?php echo gmdate('i :s', $book->avgReadSecs); ?></td>
					</tr>
					<?php
					$count++;
				}
				?>

				</tbody>
			</table>
			</div>
		</section>
		<!-- /.Left col -->
		<!-- right col (We are only adding the ID to make the widgets sortable)-->


	</div>
</div>
