<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Review Pdf</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">
    <style type="text/css">
    table, th, td {
    	border: 1px solid black;
	}
	td.number {
		font-size: 38px;
		font-weight: bold;
		text-align: center;
	}
	td.soal {
		font-size: 18px;
	}
    </style>
</head>
<body>

	<div class="container">
    	<div class="row">
			<div id="serial">
				<form action="" method="post" class="form-horizontal">
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<?php
								$no = 1;
								foreach ($soal->result() as $row) {
								?>
								<tr>
									<td rowspan="2" class="number"><?= $no++ ?></td>
									<td class="soal"><label class="control-label"><?= $row->soal ?></label></td>
								</tr>
								<tr>
									<td class="skor">
										<?php foreach ($skor->result() as $score) { ?>
										<label class="radio-inline">
									  		<input type="radio" name="skor<?= $row->id ?>" id="skor" value="<?= $score->nilai ?>"> <?= $score->nilai ?>
										</label>
										<?php } ?>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>


					<?php
					$no = 1;
					foreach ($soal->result() as $row) {
					?>

						<fieldset>

    						<div class="form-group">

    							<label class="control-label"><?= $no++.".  ".$row->soal ?></label><br>
    							<?php foreach ($skor->result() as $score) { ?>
								
									<label class="radio-inline">
								  		<input type="radio" name="skor<?= $row->id ?>" id="skor" value="<?= $score->nilai ?>"> <?= $score->nilai ?>
									</label>
								
								<?php } ?>
    						</div>
    					</fieldset>	
					<?php } ?>
				</form>
			</div>
		</div>
    </div>	

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>

<script>
$(document).ready(function() {


});

</script>

</body>
</html>
