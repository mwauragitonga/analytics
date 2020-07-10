


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
			<li class="active">Search</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
<?php if (!empty($message) && $status == true ) { ?>
	<div class="alert alert-info alert-dismissable" role="alert">
		<?php echo $message ?>
	</div>
	<?php
}elseif((!empty($message) && $status == false)){ ?>
		<div class="alert alert-danger alert-dismissable" role="alert">
			<?php echo $message ?>
		</div>
 <?php }else
 	{

}
?>
		<!-- Main row -->
		<div class="row">
			<!-- Left col -->
			<section class="col-md-10 col-lg-10 col-sm-10" style="margin-top: 3%; margin-left: 3%">
				<?php echo(form_open('search')) ?>
				<label for=""style="text-align: center">Find a student details By Mobile or Email Address: </label>
				<br>
				<br>
				<div class="form-group">
					<input type="text" class="form-control" id="email" name="phrase" placeholder="Enter an email or a mobile number" >
				</div>

				<button type="submit" class="btn btn-primary">Search</button>

				<?php echo form_close() ?>

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


