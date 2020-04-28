


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title ; ?>

			</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>general"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"> <?php echo $result->fname ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">


		<!-- Main row -->
		<div class="row">
			<!-- Left col -->
			<section class="col-10" style="margin-top: 3%; margin-left: 3%">
				<ul class="list-group">
					<li class="list-group-item active">Name : <?php echo $result->fname ?></li>
					<li class="list-group-item">School : <?php echo $result->school_name ?></li>
					<li class="list-group-item">Mobile : <?php echo $result->mobile ?></li>
					<li class="list-group-item">Email : <?php echo $result->email ?></li>
					<li class="list-group-item">Study Level : <?php echo $result->level_name ?></li>
					<li class="list-group-item">Payment Status : <?php echo $result->userstatus ?></li>
					<li class="list-group-item">Confirmation code : <?php echo $result->code ?></li>
				</ul>

			</section>
			<!-- /.Left col -->

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


