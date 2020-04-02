<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width"/>

	<!-- For development, pass document through inliner -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/email/css/simple.css">

	<style type="text/css">

		/* Your custom styles go here */

	</style>
</head>
<body>
<table class="body-wrap">
	<tr>
		<td class="container">

			<!-- Message start -->
			<table>
				<tr>
					<td align="center" class="masthead">

						<h1>Dawati</h1>

					</td>
				</tr>
				<tr>
					<td class="content">

						<h2>Dear  <?php
							if(!empty($name)){
								echo $name;
							}else{
								echo "Dawati user ";
							}
							;?></h2>

						<p><?php echo $message ; ?></p>
							<br>
						<br>

						<table>
							<tr>
								<td align="center">
									<p>
										<a href="#" class="button">Login to Dawati</a>
									</p>
								</td>
							</tr>
						</table>

					</td>
				</tr>
			</table>

		</td>
	</tr>
	<tr>
		<td class="container">

			<!-- Message start -->
			<table>
				<tr>
					<td class="content footer" align="center">
						<p>Sent by <a href="https://www.dawati.co.ke">Dawati E-Learning</a></p>
						<p><a href="mailto:">info@dawati.co.ke</a> | <a href="#">Unsubscribe</a></p>
					</td>
				</tr>
			</table>

		</td>
	</tr>
</table>
</body>
</html>
