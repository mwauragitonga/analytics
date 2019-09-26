
<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
                <?php echo $title ; ?>

                </small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>general"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Sign Ups</li>
			</ol>
		</section>

	<section>
		<div class="row" style="width: 55%;float: right">
			<label>Choose Date</label>
			<input type="date"  class="form-control" id="date" name="date" style="width: 25%;" >

		</div>
		<div class="box-body">

			<table id="example1" class="table table-bordered table-striped">
				<thead>
				<tr>
					<th> #</th>
					<th>Name </th>
					<th>Gender</th>
					<th>Phone Number</th>
					<th>School</th>
					<th>Study Level</th>
				</tr>
				</thead>
			<tbody>

			</tbody>
			</table>
		</div>
	</section>
</div>
