


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
			<li class="active">Broadcasts</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="alert alert-warning" role="alert">
			The emails/sms will be sent to all users unless you've specified the users address or phone numbers in the provided fields.
		</div>

			<?php if(!empty($message ) && $message== "Message Sent!"){ ?>
			<div class="alert alert-success" role="alert">
				Message sent successfully.
			</div>
			<?php 	}elseif(!empty($message) && $message== "Message Not Sent!"){ ?>
			<div class="alert alert-danger" role="alert">
		Message not sent!
		</div>
		<?php	} ?>

		<!-- Main row -->
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-5" style="margin-top: 3%; margin-left: 3%">
				<?php echo(form_open('broadcastEmail')) ?>
					<label for=""style="text-align: center">Enter the contents of the email: </label>
					<br>
					<br>
					<div class="form-group">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="checkbox" value="1" id="checkbox"> &nbsp;
							<label class="form-check-label" for="defaultCheck2">
								Send to specific users
							</label>
							<br>
							<br>
						</div>
						<label for="Phone ">Email Addresses</label>
						<input type="text" class="form-control" id="email" name="email" placeholder="Enter users' email addresses (johndoe@emailservice.com)" >
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Email Title</label>
						<input type="text" class="form-control" id="title" name="title" placeholder="Dawati; Your Study Partner." required>
					</div>
					<div class="form-group">
						<label for="exampleFormControlTextarea1">Email Body</label>
						<textarea class="form-control" id="message" name="message" rows="3"placeholder="Enter the contents of your Email" required></textarea>
					</div>
					<button type="submit" class="btn btn-primary">Send Email</button>

				<?php echo form_close() ?>

			</section>
			<!-- /.Left col -->

			<section class="col-lg-5 " style="margin-top: 3%; margin-left: 3%">

				<?php echo(form_open('broadcastSMS')) ?>
					<label for=""style="text-align: center">Enter the contents of the SMS: </label>
					<br>
					<br>
					<div class="form-group">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="checkbox" value="1" id="checkbox"> &nbsp;
							<label class="form-check-label" for="defaultCheck2">
								Send to specific user
							</label>
							<br>
							<br>
						</div>
						<label for="Phone ">Phone Number</label>
						<input type="number" class="form-control" id="phone" name="phone" placeholder="Enter users' phone numbers  (07xx xxx xxx)">
					</div>
					<div class="form-group">
						<label for="exampleFormControlTextarea1">SMS Body</label>
						<textarea class="form-control" id="message" name="message" rows="3"placeholder="Enter the contents of your SMS. (1 sms <= 150 characters)"></textarea>
					</div>
					<button type="submit" class="btn btn-primary">Send SMS</button>

				<?php echo form_close() ?>
			</section>
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


