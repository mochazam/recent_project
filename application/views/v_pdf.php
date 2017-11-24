<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Review Pdf</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">
</head>
<body>
    
    <div class="container">
    	<div class="row">
    		<embed src="<?php echo base_url()."file_pdf/JavaScript the Good Parts.pdf"; ?>" width="100%" height="600px" type="application/pdf">
    	</div>
    </div>

    <div class="container">
    	<div class="row">    			
    		<iframe src="<?php echo base_url()."file_pdf/JavaScript the Good Parts.pdf"; ?>" width="100%" height="600px"></iframe>
    	</div>
    </div>

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>

<script>
$(document).ready(function() {


});

</script>

</body>
</html>