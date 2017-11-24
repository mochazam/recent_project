<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Get data from serialize()</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">
</head>
<body>
    <form id="branddet" name="branddet" method="post" role="form" >   
  		<table width="952">
  			<tr>
    			<td colspan="4" align="center">&nbsp;</td>
  			</tr>
  			<tr>
			    <td width="110">Brand Name</td>
			    <td width="291"><input type="text" name="brand_name"></td>
			    <td width="212">Email ID</td>
			    <td width="319"><input type="text" name="emailid"></td>
		  	</tr>
		  	<tr>
			    <td>Dealer Name</td>
			    <td><input type="text" name="dealername"></td>
			    <td>Web Address</td>
			    <td><input type="text" name="webaddress"></td>
		  	</tr>
		  	<tr>
			    <td>Address</td>
			    <td><input type="text" name="address"></td>
			    <td>State</td>
			    <td><input type="text" name="state"></td>
  			</tr>
  			<tr>
			    <td>Contact No</td>
			    <td><input type="text" name="contactno"></td>
			    <td>City</td>
			    <td><input type="text" name="city"></td>
  			</tr>
  			<tr>
			    <td>Fax</td>
			    <td><input type="text" name="fax"></td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
  			</tr>
  
  			<tr>
			    <td colspan="4" >
			    <div class="col-lg-offset-3 col-lg-9">
			    <button type="button" name="submit" class="btn btn-info" onclick="branddetails()" >   Save  </button>
			    <button  type="reset" name="reset"  class="btn btn-info">   Reset  </button>  <img src="<?php echo base_url();?>images/loaders/circular/035.gif" alt="" id="loading_pic" style="display:none"></div> </td>
  			</tr>
		</table>
	</form>

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>

<script>
$(document).ready(function() {

	$('#branddet').change(function() {
		var getForm = $('#branddet').serialize();
		$.ajax({
            type: "POST",
            url: "<?php echo base_url().'dashboard/insert';?>",
            data: getForm,
            success: function(resp){
               	$('#success_msg').show();
		  		$('#success_msg').text(" Record saved successfully");
            }
       
        });
    })    

});




 	
</script>

</body>
</html>