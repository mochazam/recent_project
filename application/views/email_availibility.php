<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title;?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
</head>
<body>

	<form>
  		<div class="form-group">
    		<label for="exampleInputEmail1">Email address</label>
    		<input type="email" name="email" class="form-control" id="email" placeholder="Email">
    		<span id="email_result"></span>
  		</div>
  		<div class="form-group">
    		<label for="exampleInputPassword1">Password</label>
    		<input type="password" name="password" class="form-control" id="password" placeholder="Password">
  		</div>
  
  		<button type="submit" class="btn btn-default">Submit</button>
	</form>


<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery3.js"></script>
<script>
	$(document).ready(function() {
		$('#email').change(function() {
			var email = $(this).val();
			if (email != '' ) {
				$.ajax({
					url: '<?php echo base_url();?>email_available/check_email_availibility',
					type: 'POST',
					data: {email:email},
					success: function(data){
						$('#email_result').html(data);
					}
				})
			}
		})
	})
</script>
</body>
</html>