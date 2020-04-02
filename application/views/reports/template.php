<!DOCTYPE html>
<html>
<body>
<style type="text/css">
	body {
		background: rgb(204, 204, 204);
	}

	page {
		background: white;
		display: block;
		margin: 0 auto;
		margin-bottom: 0.5cm;
		box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
	}

	page[size="A4"] {
		width: 21cm;
		height: 29.7cm;
	}

	page[size="A4"][layout="landscape"] {
		width: 29.7cm;
		height: 21cm;
	}

	page[size="A3"] {
		width: 29.7cm;
		height: 42cm;
	}

	page[size="A3"][layout="landscape"] {
		width: 42cm;
		height: 29.7cm;
	}

	page[size="A5"] {
		width: 14.8cm;
		height: 21cm;
	}

	page[size="A5"][layout="landscape"] {
		width: 21cm;
		height: 14.8cm;
	}

	.reportDetails {
		float: left;
	}

	.details {
		position: relative;
		margin-top: 5px;
		margin-bottom: 5px;
	}

	.footer {
		font-size: 12px;
		clear: both;
		border-top: 1px solid;
		text-align: center;
	}

	tbody > tr:nth-child(odd) {
		background-color: rgba(0, 0, 0, 0.025);
		background-clip: padding-box;
	}

	td {
		border-color: #00a19a;
		vertical-align: top;
	;
	}

	@media print {
		body, page {
			margin: 0;
			box-shadow: 0;
		}
	}
</style>
<page size="A4">
	<div class="details">
		<div class="details-body">
			<img src="<?php echo base_url() ?>assets/res/dawatiLogo.png" width="80" height="50">
			<p float="left">Generated on <?php echo date('Y-m-d h:i:s') ?></p>
			<div class="reportDetails">
				<p><b>Student Name: </b><?php echo $student->fname . " " . $student->lname ?></p>
				<p><b>School: </b><?php echo $student->name ?></p>
				<p><b>Study Level: </b><?php echo $student->level_name ?></p>
				<br>

				<p><b>Title: </b>Usage Of Dawati Application For The Previous One Month</p>
			</div>
		</div>
	</div>

	<div class="appUsage">
		<b> Videos Watched</b>

		<table style="border: solid #00a19a">
			<tr>
				<b></b>
				<td><b>Index |</b></td>
				<td><b>Video Name |</b></td>
				<td><b>Total Minutes Viewed |</b></td>
				<td><b>Views |</b></td>

			</tr>
			<tbody>
			<?php
			$count = 0;
			foreach ($appUsage['videos'] as $video)
			{
				sscanf($video->watchSecs, "%d:%d:%d", $hours, $minutes, $seconds);
				$appMinutes = $hours * 3600 + $minutes * 60 + $seconds;

				?>
				<tr>
					<td><?php echo $count + 1 ?></td>
					<td><?php echo $video->file_name . "  " ?><span class="badge badge-info"><?php echo "" ?></span>
					</td>
					<td><?php echo round($video->avgWatchSecs / 60, 2) * $video->count ?></td>
					<td><?php echo $video->count; ?></td>

				</tr>
				<?php
				$count++;
			}
			?>
			</tbody>
		</table>

		<pagebreak>


			<b>Books Read</b>

			<table  style="border: solid #00a19a">
				<tr>
					<td><b>Index |</b></td>
					<td><b>Ebook Name |</b></td>
					<td><b>Total Minutes read |</b></td>
					<td><b>Reads</b></td>

				</tr>
				<tbody>
				<?php
				$count = 0;
				foreach ($appUsage['ebooks'] as $book)
				{

					sscanf($book->readSecs, "%d:%d:%d", $hours, $minutes, $seconds);
					$appMinutes = $hours * 3600 + $minutes * 60 + $seconds;
					?>
					<tr>
						<td><?php echo $count + 1 ?></td>
						<td><?php echo $book->file_name . "  " ?><span class="badge badge-info"><?php echo "" ?></span>
						</td>
						<td><?php echo round($book->avgReadSecs / 60, 2) * $book->count; ?></td>
						<td><?php echo $book->count; ?></td>

					</tr>
					<?php
					$count++;
				}
				?>

				</tbody>
			</table>
			<br>
	</div>

	<div class="webUsage">
	</div>

	<div class="footer">
		<div class="footer-inner"> <?php echo date('Y'); ?> &copy; Dawati .
		</div>
	</div>
</page>
</body>

</html>