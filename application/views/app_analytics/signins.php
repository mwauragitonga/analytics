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
			<div class="table-responsive col-lg-5">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
					<th>#</th>
					<th>Student Name</th>
					</thead>
					<tbody>
					<?php
					$count =0;
					foreach ($signins as $signin) {

						?>
						<tr>
							<td><?php echo $count + 1 ?></td>
							<td><?php echo $signin->fname ?></td>
						</tr>
						<?php
						$count++;
					}
					?>

					</tbody>
				</table>
			</div>


		</section>


	</div>
</div>
