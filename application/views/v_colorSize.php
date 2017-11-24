<!DOCTYPE html>
<html>
<head>
    <title>Color & Size</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">
	<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>
</head>
<body>

    <div class="container">
    	<div class="row">
        	<div class="col-md-6">

		        <form name="frm_details" id="frm_details" method="post">
		            <div class="form-group">
				        <label for="inputEmail">Color</label>
				        <select name="color" class="required">
							<option>-- SELECT Color --</option>
							<?php foreach($colors as $col ): ?>
								<option value='<?php echo $col->id?>'><?php echo $col->name;?> </option>		
							<?php endforeach; ?>
						</select>
				    </div>
				    <div class="form-group">
				        <label for="inputPassword">Size</label>
				        <select name="size" class="required">
							<option>-- SELECT Color --</option>
							<?php foreach($sizes as $siz ): ?>
								<option value='<?php echo $siz->id?>'><?php echo $siz->name;?> </option>		
							<?php endforeach; ?>
						</select>
				    </div>
		        </form>
		    </div>    
	    </div>
	</div>    

</body>				
</html>