<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Codeigniter Ajax Country State City Drop Down</title>
  <script src="<?php echo base_url(); ?>assets/js/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/common.js"></script>
  <style>
  	html, body, div, h1{margin: 0;padding: 0;border: 0;}
	body {font-family: Arial, "Trebuchet MS";font-size: 12px;color: #99A607; }
	a{font-weight: bold;color: #99A607;text-decoration:none;}
	a:hover{color: #99A607;text-decoration:underline;}
	#container{width:80%;margin: auto;}
	#top{width:100%;margin-top: 25px; height:60px; border:1px solid #BBBBBB; padding:10px;}
	#tutorialHead{width:100%;margin-top: 25px; height:30px; border:1px solid #BBBBBB; padding:10px;}
	.tutorialTitle{width:800px;float:left;}
	.tutorialLink{float:right;}
	#wrapper{width:98%;margin-top: 25px; border:1px solid #BBBBBB; padding:20px;height:250px;}
	#wrapper a {color:#000;font-weight: normal;}
	.wrap_box{margin-left:35%;margin-top:30px;font-size:14px;}
	select { border: solid 1px #BBBBBB  ;  width:170px; height:25px ;font-size:20px; margin:15px;}
	option {  }
	#fotter{clear:both;text-align:right;font-size:10px;color: #222; border:1px solid #BBBBBB; padding:10px;width:100%;margin-top: 25px;}
  </style>
</head>

<body>
  	<div>
    	<div id="wrapper">
		  	<div class="wrap_box">
				<table>
					<tbody>
            			<tr>
	  						<td>
	  							<select >
	  								<option value="-1">Select country</option>
	  								<?php foreach($list->result() as $row) { ?>
								    <option value="<?php echo $row->id?>"><?php echo $row->country_name?></option>
								    <?php } ?>
	  							</select>
	  						</td>
	  					</tr>
	  					<tr>
	  						<td>
	  							<select id="state_dropdown" onchange="selectCity(this.options[this.selectedIndex].value)">
				                  <option value="-1">Select state</option>
				                  
				                </select>
	  							<span style="display: none;" id="state_loader">Please wait... <img src="Codeigniter Ajax Country State City Drop Down _ 91 Web Lessons_files/loading.gif"></span>
	  						</td>
	  					</tr>
					
	  					<tr>
	  						<td>
	  							<select id="city_dropdown">
	  								<option value="-1">Select city</option>
				                  
				                </select>
	  							<span style="display: none;" id="city_loader">Please wait... <img src="Codeigniter Ajax Country State City Drop Down _ 91 Web Lessons_files/loading.gif"></span>
	  						</td>
	  					</tr>
				  	</tbody>
        		</table>
								
		  	</div>
    	</div>

	</div>
	
</body>
</html>