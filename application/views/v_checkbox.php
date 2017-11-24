<!DOCTYPE html>
<html>
<head>
    <title>serialize ajax</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">
	<link href="font-awesome/css/font-awesome.css" rel="stylesheet">     
	<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>

	<script>
        $(document).ready(function() {
            function showValues() {
            	$("input[type='checkbox'], input[type='radio']").on( "click", function(event) {
                //$("input[name='checkbox[]']:checked").each(function(event) {
                    event.preventDefault(); 

                    $.ajax({
                        url: "<?php echo site_url('checkbox/getSerialize');?>",
                        type: "post",
                        data: $(this).serialize(),
                        success: function(d) {
                            alert(d);
                        }
                    });
                });
            }    
            $("input[type='checkbox'], input[type='radio']").on( "click", showValues );
        });

    </script>
<!--
    <script>
    	$(document).ready(function() {
    		function showValues() {

    			var brandarray = new Array();		
				$('input[name="checkbox"]:checked').each(function(){			
					brandarray.push($(this).val());		
				});
				var brand_checklist = "&checkbox="+brandarray;

				$.ajax({
                    url: "<?php echo site_url('checkbox/getSerialize');?>",
                    type: "post",
                    data: brand_checklist,//$(this).serialize(),
                    success: function(d) {
                        alert(d);
                    }
                });

			}	
    		$("input[type='checkbox'], input[type='radio']").on( "click", showValues );
    	});		
    </script>
-->    
</head>
<body>

    <div class="container">
    	<div class="row">
        	<div class="col-md-6">

		        
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
				    
		    </div>    
	    </div>
	</div>    

</body>				
</html>