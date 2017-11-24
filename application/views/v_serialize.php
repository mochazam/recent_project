<!DOCTYPE html>
<html>
<head>
    <title>serialize ajax</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">
	<link href="font-awesome/css/font-awesome.css" rel="stylesheet">     
	<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>

	<script>
        $(function() {
            $("#frm_details").on("submit", function(event) {
                event.preventDefault();

                $.ajax({
                    url: "<?php echo site_url('serialize/getSerialize');?>",
                    type: "post",
                    data: $(this).serialize(),
                    success: function(d) {
                        alert(d);
                    }
                });
            });
        });
    </script>
</head>
<body>

    <div class="container">
    	<div class="row">
        	<div class="col-md-6">

		        <form name="frm_details" id="frm_details" method="post">
		            <div class="form-group">
				        <label for="inputEmail">Country</label>
				        <input type="text" class="form-control" value="" id="country" name="country">
				    </div>
				    <div class="form-group">
				        <label for="inputPassword">State</label>
				        <input type="text" class="form-control" value="" id="state" name="state">
				    </div>
				    <div class="checkbox">
				        <label><input type="checkbox" name="checkbox[]" value="1"> 1</label>
				        <label><input type="checkbox" name="checkbox[]" value="2"> 2</label>
				        <label><input type="checkbox" name="checkbox[]" value="3"> 3</label>
				        <label><input type="checkbox" name="checkbox[]" value="4"> 4</label>
				    </div>
				    <div class="radio">
				        <label><input type="radio" name="radio" value="lima"> lima</label>
				        <label><input type="radio" name="radio" value="enam"> enam</label>
				        <label><input type="radio" name="radio" value="tujuh"> tujuh</label>
				        <label><input type="radio" name="radio" value="delapan"> delapan</label>
				    </div>
				    <button type="submit" class="btn btn-primary">Login</button>
		        </form>
		    </div>    
	    </div>
	</div>    

</body>				
</html>