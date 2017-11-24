<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Get data from serialize()</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">
</head>
<body>
    
    <div class="container">
    	<div class="row">
    		<form id="branddet" name="branddet" method="post" role="form" >   
				<input type="checkbox" name="kota[]" value="4">
				<label for="option-JAKARTA">DKI JAKARTA</label>
				<input type="checkbox" name="kota[]" value="1">
				<label for="option-JABAR">JAWA BARAT</label>
				<input type="checkbox" name="kota[]" value="2">
				<label for="option-JATENG">JAWA TENGAH</label>
				<input type="checkbox" name="kota[]" value="3">
				<label for="option-JATIM">JAWA TIMUR</label>
			</form>
    	</div>
    	<div class="row">
    		<ul id="target">
    			
    			
    		</ul>
    	</div>
    </div>

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>

<script>
$(document).ready(function() {

	$('#branddet').change(function() {
		var getForm = $('#branddet').serializeArray();
		alert(getForm);
		$.ajax({
            type: "POST",
            url: "<?php echo base_url().'filter/fetch';?>",
            data: getForm,
            success: function(resp){
               	$("#target").html(resp);
            }
       
        });
    })    

});




 	
</script>

</body>
</html>