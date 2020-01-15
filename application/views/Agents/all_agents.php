<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title; ?>

			</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12 col-sm-12  ">
				<div class="x_panel">
					<div class="x_title">

						<a href="<?php echo base_url(); ?>add_user">
							<button type="button" class="btn btn-round  btn-primary "><i class="fa fa-plus-circle"></i>
								Add User
							</button>
						</a>
					</div>
					<div class="x_content">

						<div class="col-md-12 col-sm-12 col-xs-12">


							<div class="x_content">

								<table id="datatable-buttons" class="table table-striped table-bordered"
									   style="width:100%">
									<thead>
									<tr>
										<th>index</th>
										<th>Name</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Referral code</th>
										<!--<th>More info</th> Trust these will be asked for @cyrus-->
									</tr>

									</thead>
									<tbody>
									<?php
									$count = 1;
									if (!empty($agents)) {
										foreach ($agents as $user) { ?>
											<tr>
												<td><?php echo $count; ?> </td>
												<td><?php echo $user->fname; ?></td>
												<td><?php echo $user->email; ?></td>
												<td><?php echo $user->Mobile; ?></td>
												<td><?php echo $user->referal_code; ?></td>
												<!--<td><a href="#">More info </a></td>-->
											</tr>
											<?php
											$count++;
										}
									} ?>
									</tbody>
								</table>

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
