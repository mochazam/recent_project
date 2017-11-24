<!DOCTYPE html>
<html>
<head>
	<title>Exam Online</title>

	<!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css">
    <style type="text/css">
    .bs-callout {
	    padding: 20px;
	    margin: 20px 0;
	    border: 1px solid #eee;
	    border-left-width: 5px;
	    border-radius: 3px;
	}
	.bs-callout-info {
	    border-left-color: #1b809e;
	}	
	figure {
	    display: block;
	    -webkit-margin-before: 1em;
	    -webkit-margin-after: 1em;
	    -webkit-margin-start: 40px;
	    -webkit-margin-end: 40px;
	}
	.highlight {
	    padding: 9px 14px;
	    margin-bottom: 14px;
	    background-color: #f7f7f9;
	    border: 1px solid #e1e1e8;
	    border-radius: 4px;
	}
	#times {
		margin: 0 auto;
		display: block;
		text-align: center;
		font-size: 30px;
		font-weight: bold;
		color: red;
	}
    </style>
</head>
<body>

	<div class="container">
		<div class="row">

			<div id="wrapper">

        
		        <div id="page-wrapper">
		            <div class="row">
		               
		            </div>
		            <!-- /.row -->
		            <div class="row">
		                <div class="col-lg-12">
		                    <div class="panel panel-default">
		                        <div class="panel-heading">
		                            DataTables Advanced Tables
		                        </div>
		                        <!-- /.panel-heading -->
		                        <div class="panel-body">

			<h1>Play the Exam</h1>

			<div id="times"></div>

			<form method="POST" action="<?php echo base_url();?>exam/result">

			<?php
			$no = 1;
				foreach ($questions->result() as $row) {	
			?>

			<?php 
			$ans_array = array(
				$row->option1, 
				$row->option2,
				$row->option3, 
				$row->option4
			);
			shuffle($ans_array);
			?>

			<input type="hidden" name="" id="timeValue" value="<?php echo ($count_time)/60 ?>">

			<div class="bs-callout bs-callout-info">

				<label for="question"><?php echo $no++ ?>. <?php echo $row->question; ?> ?</label>
				<?php if (empty($ans_array)) { ?>

				<!-- <div class="">
					<textarea class="form-control"></textarea>
				</div>
				 -->
			
				<?php } else { ?>
				
				<!-- <div>
					<label class="radio-inline">
	  					<input type="radio" name="quizid<?php echo $row->id; ?>" id="quizid<?php echo $row->id; ?>" value="alue="<?php echo $ans_array[0]; ?>"> <?php echo $ans_array[0]; ?>
					</label>

					<label class="radio-inline">
	  					<input type="radio" name="quizid<?php echo $row->id; ?>" id="quizid<?php echo $row->id; ?>" value="alue="<?php echo $ans_array[1]; ?>"> <?php echo $ans_array[1]; ?>
					</label>

					<label class="radio-inline">
	  					<input type="radio" name="quizid<?php echo $row->id; ?>" id="quizid<?php echo $row->id; ?>" value="alue="<?php echo $ans_array[2]; ?>"> <?php echo $ans_array[2]; ?>
					</label>

					<label class="radio-inline">
	  					<input type="radio" name="quizid<?php echo $row->id; ?>" id="quizid<?php echo $row->id; ?>" value="alue="<?php echo $ans_array[3]; ?>"> <?php echo $ans_array[3]; ?>
					</label>
				</div> -->

				<div class="radio">
				  	<label>
				    	<input type="radio" name="quizId<?php echo $row->id; ?>" id="quizid<?php echo $row->id; ?>" value="<?php echo $ans_array[0]; ?>" >
				    	<?php echo $ans_array[0]; ?>
				  	</label>
				</div>

				<div class="radio">
				  	<label>
				    	<input type="radio" name="quizId<?php echo $row->id; ?>" id="quizid<?php echo $row->id; ?>" value="<?php echo $ans_array[1]; ?>" >
				    	<?php echo $ans_array[1]; ?>
				  	</label>
				</div>

				<div class="radio">
				  	<label>
				    	<input type="radio" name="quizId<?php echo $row->id; ?>" id="quizid<?php echo $row->id; ?>" value="<?php echo $ans_array[2]; ?>" >
				    	<?php echo $ans_array[2]; ?>
				  	</label>
				</div>

				<div class="radio">
				  	<label>
				    	<input type="radio" name="quizId<?php echo $row->id; ?>" id="quizid<?php echo $row->id; ?>" value="<?php echo $ans_array[3]; ?>" >
				    	<?php echo $ans_array[3]; ?>
				  	</label>
				</div>			

				<?php } ?>
			
			</div>
			<?php } ?>

					 			</div>
		                        <!-- /.panel-body -->
		                        <div class="panel-footer">
		                        		<button type="submit" class="btn btn-primary">Submit</button>
									</form>
		                        </div>
		                    </div>
		                    <!-- /.panel -->
		                    
		                </div>
		                <!-- /.col-lg-12 -->
		            </div>
		            
		            <!-- /.row -->
		        </div>
		        <!-- /#page-wrapper -->

		    </div>
		    <!-- /#wrapper -->
		</div>
	</div>

<script>
	var min = document.getElementById('timeValue').value;
	// var min = 50;
	var countDownDate = new Date().getTime() + min*60000;
	var x = setInterval(function() {
		var now = new Date().getTime();
		var distance = countDownDate - now;
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		document.getElementById('times').innerHTML = "Time Left : " + minutes + "m " + seconds + "s ";

		if (distance < 0) {
			clearInterval(x);
			window.open('<?php echo base_url();?>exam/result', '_self');
		}
	}, 1000);
</script>
</body>
</html>