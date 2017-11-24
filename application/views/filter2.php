<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Get data from serialize()</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">
<style>
	ul > li {
		list-style: none;
	}
</style>
</head>
<body>
    
    <div class="container">
	<div class="row">
		<div class="col-sm-12">


	<div class="container">
    	<div class="row">
    		
			<ul class="different_filters city-filter">
				<li>
					<input type="checkbox" id="city-DKI" name="ccheck" class="ccheck" value="4">
					<label for="city-DKI">Jakarta</label>
				</li>
				<li>
					<input type="checkbox" id="city-jabar" name="ccheck" class="ccheck" value="1">
					<label for="city-jabar">Jawa Barat</label>
				</li>
				<li>
					<input type="checkbox" id="city-jateng" name="ccheck" class="ccheck" value="2">
					<label for="city-jateng">Jawa Tengah</label>
				</li>
				<li>
					<input type="checkbox" id="city-jatim" name="ccheck" class="ccheck" value="3">
					<label for="city-jatim">Jawa Timur</label>
				</li>
				</li>
			</ul>

    	</div>
    	<div class="row">
    		<label class="control-label">Kota :</label>
    		<ul id="target">
    			
    			
    		</ul>
    	</div>
    </div>


		</div>
	</div>
</div>

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>

<script>
$(document).ready(function() {

    function showValues() {		
				
		//var mainarray = new Array();
		
		var cityarray = new Array();		
		$('input[name="ccheck"]:checked').each(function(){			
			cityarray.push($(this).val());
			$('.spancolorcls').css('visibility','visible');		
		});
		if(cityarray=='') $('.spancolorcls').css('visibility','hidden');
		var color_checklist = "&ccheck="+cityarray;
		
		var main_string = color_checklist;
		main_string = main_string.substring(1, main_string.length)
		//alert(main_string);
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url().'filter/fetch2';?>",
			data: main_string, 
			cache: false,
			success: function(html){
				//alert(html);
				//$("#productContainer").html(html);		
				$("#productContainer").css("opacity",1);
				$("#loaderID").css("opacity",0);
				$("#target").html(html);
			}
		});
		
	}
	
	$("input[type='checkbox'], input[type='radio']").on( "click", showValues );  

});
</script>

</body>
</html>