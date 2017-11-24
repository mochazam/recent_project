<!DOCTYPE html>
<html>
<head>

	<title>PHP - Input multiple tags with dynamic autocomplete example</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-tokenfield.min.css">
</head>
<body>

<div class="container">
	<form method="post" id="form_tags">

		<div class="form-group">
			<label>Name:</label>
			<input type="text" name="name" class="form-control" >
		</div>

		<div class="form-group">
			<label>Add Tags:</label><br/>
			<input type="text" name="tags" id="tags" class="typeahead tm-input form-control tm-input-info" />
		</div>

		<div class="form-group">
			<button class="btn btn-success" id="submit">Submit</button>
		</div>

	</form>
</div>

	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap-tokenfield.js"></script>  



<script>
	$(document).ready(function() {
		$('#tags').tokenfield({
			autocomplete:{
				source: ['PHP', 'Javascript'],
				delay: 100
			},
			showAutocompleteOnFocus: true
		});

		$('#form_tags').on('submit', function(event) {
			event.preventDefault();
			if ($.trim($('#name').val()).length == 0) {
				alert('Please Enter name...');
				return false;
			} else if ($.trim($('#tags').val()).length == 0) {
				alert('Please Enter Atleast one...');
				return false;
			} else {
				var form_data = $('#form_tags').serialize();
				$('#submit').attr('disabled', 'disabled');
				$.ajax({
					url: "<?php echo base_url().'tags/inputTags'; ?>",
					type: "POST",
					data: form_data,
					beforeSend: function() {
						$('#submit').val('Submitting....');
					},
					success: function(data) {
						if (data != 0) {
							$('#name').val('');
							$('#tags').tokenfield('setTokens', []);
							$('#success_message').html(data);
							$('#submit').attr('disabled', false);
							$('#submit').val('Submit');
						}
					}
				});
				setInterval(function() {
					$('#success_message').html('');
				}, 4000);
			}
			
		});
	});
</script>

</body>
</html>