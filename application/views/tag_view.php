<!DOCTYPE html>
<html>
<head>

	<title>PHP - Input multiple tags with dynamic autocomplete example</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/tagmanager.min.css">

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

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery3.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/tagmanager.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap3-typeahead.min.js"></script>  

<script type="text/javascript">
  $(document).ready(function() {
    var tagApi = $(".tm-input").tagsManager();

    jQuery(".typeahead").typeahead({
      name: 'tags',
      displayKey: 'name',
      source: function (query, process) {
        return $.get('<?php echo base_url();?>tags/getTags', { query: query }, function (data) {
          data = $.parseJSON(data);
          return process(data);
        });
      },
      afterSelect :function (item){
        $('.tm-input').tagsManager("pushTag", item);
		$.ajax({
			url: "<?php echo base_url().'tags/inputTags'; ?>",
			type: "POST",
			data: {name:'code', tags:item},
			success: function(data) {

			}
		});
      }
    });
  });
</script>

<script>
	$(document).ready(function() {
		$('#submit').on('click', function(event) {
			event.preventDefault();
			var form_data = $('#form_tags').serialize();
			//$('#submit').attr('disabled', 'disabled');
			$.ajax({
				url: "<?php echo base_url().'tags/inputTags'; ?>",
				type: "POST",
				data: form_data,
				beforeSend: function() {
					$('#submit').val('Submitting....');
				},
				success: function(data) {
					if (data != 0) {
						$('#submit').attr('disabled', false);
						$('#submit').val('Submit');
					}
				}
			})
		});
	});
</script>

</body>
</html>