<html>
    <head>
        <title><?php echo $title; ?></title>
		<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>
        <script type="text/javascript">
        	$(document).ready(function(){
  				$('#reg').click(function(){

                    $.ajax({
                        url: "<?php echo site_url('account/signup');?>",
                        type: "post",
                        data: $("#form1").serialize(),
                        success: function(d) {
                            alert(d);
                        }
                    });

   					//$.post("<?php echo base_url('account/signup'); ?>",
    				//$("#form1").serialize(),
    				//function(result) {
     				//	$("#error_message").html(result).appendTo("form"); 
   					//},"html");
  				});    
        	});
        </script>
    </head>
    <body>
        <form id="form1">
        	<div id="error_message" style="color:red"></div>
        	<table>
  				<caption>Sign Up Now</caption>
    				<tr>
    					<td>Username</td>
     					<td><?php echo form_input('un', ''); ?></td>
     				</tr>
    				<tr>
    					<td>Password</td>
     					<td><?php echo form_password('pw', ''); ?></td>
     				</tr>
    				<tr>
    					<td>Confirm Password</td>
     					<td><?php echo form_password('pw1', ''); ?></td>
     				</tr>
        	</table>
        	<div style="height: 20px"></div>
        	<input type="button" id="reg" value="Register" />
        </form>
 	</body>
</html>