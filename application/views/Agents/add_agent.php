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
		<form id="form" action="<?php echo base_url() ?>createAccount" method="post">



			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<?php
						//	print_r($response);
						if (!empty($response)) { ?>
							<div id="messages_signup" class="alert alert-warning " style="display: block">
								<?php
								echo $response['message']
								?>

							</div>
						<?php } ?>
						<label for="fullname"><b>Full Name(e.g John Doe)</b></label>
						<input class="form-control" type="text" placeholder="Full Name" name="full_name"
							   required>


						<label for="email"><b>Email*</b></label>
						<input class="form-control" type="email" placeholder="Email" name="email" required>


						<label for="phone"><b>Phone Number*</b></label>
						<input class="form-control" type="text"
							   pattern="^(?:254|\+254|0)?(7(?:(?:[12][0-9])|(?:0[0-8])|(?:[3][0-9])|(?:5[0-6])|(9[0-2])|(8[5-9])|(7[0-6]))[0-9]{6})$"
							   placeholder="Phone Number" name="phone" required>


						<label for="psw"><b>Password*</b></label>
						<input class="form-control" type="password" placeholder="Enter Password"
							   name="password" required>

						<label for="confpsw"><b>Confirm Password*</b></label>
						<input class="form-control" type="password" placeholder="Confirm Password"
							   name="confirmPassword"
							   required><br>


						<button id="signUpButton" class="btn btn-round btn-primary" type="submit">Add agent
						</button>
					</div>
				</div>
		</form>
</div>
</section>
<script>

</script>
