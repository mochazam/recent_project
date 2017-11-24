<?php
	$mapItems = array(
			array("id" => 1, "title" => "map pin 1", "xcoord" => "420","ycoord" => "120"),
			array("id" => 2, "title" => "map pin 2", "xcoord" => "429","ycoord" => "129"),
			array("id" => 2, "title" => "map pin 3", "xcoord" => "329","ycoord" => "329")
			);
	foreach($mapItems as $map)
	{
		$mapPins[] = array(
				"id" => $map['id'],
				"title" => $map['title'],
				"xcoord" => $map['xcoord'],
				"ycoord" => $map['ycoord']
				);
	}

	?>
	<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/dropPin/dropPin.css" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url();?>assets/dropPin/dropPin.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {

		$('#map2').dropPin('showPins',{
			  	fixedHeight:413,
			  	fixedWidth:700,
			  	cursor: 'pointer',
			  	pinclass: 'qtipinfo',
			  	pinDataSet: <?php echo '{"markers": '.json_encode($mapPins).'}' ;?>
		});

	});
	</script>
	<p><a href="<?php echo base_url().'Pinit/dropPin'; ?>">Try dropping a single pin on a map</a> | <a href="<?php echo base_url().'Pinit/dropPin'; ?>">Try dropping multiple pins on a map</a></p>
	<div id="map2"></div>