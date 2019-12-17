<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title ; ?>

			</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"><?php echo $title?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<section class="col-lg-7">
				Students from <?php echo $title ?>
				<!-- Custom tabs (Charts with tabs)-->
				<div class="table-responsive">
					<table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">	<thead>

						<tr>
							<th> #</th>
							<th>Student Name </th>
							<th>Study Level</th>
							<th>Date joined</th>

						</tr>
						</thead>
						<tbody id="students">
						<?php
						$count =0;
						foreach ($students as $student){
							?>
							<tr>


								<td><?php echo $count+1?></td>
								<td><?php echo $student->fname ." ". $student->lname?></td>
								<td><?php echo $student->level_name?></td>
								<td><?php echo $student->date_joined?></td>


							</tr>




							<?php  $count++;
						}
						?>

						</tbody>
					</table>
				</div>
				<!-- /.nav-tabs-custom -->

			</section>
			<!-- right col -->
		</div>
		<!-- /.row (main row) -->

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
