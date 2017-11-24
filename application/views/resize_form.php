<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Resize Image</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">  
  </head>
  <body>
  
    <?php
	$info = $this->session->flashdata('info');
	if(!empty($info))
		{ ?>
	<div class="table-header">
		<?php echo $info;?>
	</div>
	<?php } ?>
	
 
    <div class="container-fluid" id="com"> 
      <h3>Resize Image</h3>
      	<?php echo form_open_multipart('resize/insert', 'class="form-horizontal"'); ?>
	        <div class="form-group">
	          <label for="name" class="col-sm-2 control-label">Image</label>
	          <div class="col-sm-6">
	            <input type="file" class="form-control" id="name_field" name="name_field">
	          </div>
	        </div>
	         <div class="form-group">
	            <div class="col-sm-10 col-sm-offset-2">
	                <input id="submit" name="submit" type="submit" value="Upload" class="btn btn-primary">
	            </div>
	        </div>
		<?php echo form_close(); ?>   
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
