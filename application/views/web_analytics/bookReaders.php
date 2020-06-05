<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title; ?>

			</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>general"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"> Book Readers</li>
		</ol>
	</section>

	<section>
		<div class="box-body">
			<div class="table-responsive col-sm-12 col-lg-12">
				<table  class="data-table " id="bookReaders" >
					<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Gender</th>
						<th>School</th>
						<th>Study Level</th>
						<th>Item Read</th>
						<th>Time of Read</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$count = 1;
					foreach ($users  as $user){  ?>
						<tr>
							<td><?php echo $count  ?></td>
							<td><?php echo $user->fname .' '. $user->lname ; ?></td>
							<td><?php echo $user->gender ; ?></td>
							<td><?php echo $user->school_name ; ?></td>
							<td><?php echo $user->level_name ; ?></td>
							<td><?php echo $user->file_name ; ?></td>
							<td><?php echo $user->time_of_action ; ?></td>
						</tr>
						<?php
						$count++;
					}
					?>
					</tbody>
					<tfoot>
					</tfoot>
				</table >

			</div>
		</div>
	</section>
</div>
<script>
	$(document).ready( function () {
		$('#bookReaders').DataTable();
	} );
</script>
<table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">	<thead>

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
			<td><?php echo round($video->avgWatchSecs / 60,2)*$video->count; ?></td>
			<td><?php echo $video->count; ?></td>
			<td><?php echo round($video->avgWatchSecs / 60,2) ;?></td>
		</tr>
		<?php
		$count++;
	}
	?>

	</tbody>
</table>
