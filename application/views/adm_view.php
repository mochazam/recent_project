<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Online</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css">

</head>

<body>

<div class="container">
    <div id="wrapper">

<?php
	$this->load->view('nav_adm');
?>
        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Users Online
                        <div class="pull-right">
                            <a href="<?php echo base_url();?>user_online/logout" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-off"></i> Logout</a> 
                        </div>
                    </h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables Advanced Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" id="user_login_status">
                            
                        	

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
</div>
    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/js/jquery-1.11.0.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.js"></script>

    <script>
    	$(document).ready(function() {
    		fetch_user_login_data();
    		setInterval(function(){
    			fetch_user_login_data()
    		}, 3000);
    		function fetch_user_login_data() {
    			var action = "fetch_data";
    			$.ajax({
    				url:"<?php echo base_url().'user_online/fetch_user_online'; ?>",
    				type:"POST",
    				data:{action:action},
    				success: function(data) {
    					$('#user_login_status').html(data);
    				}
    			});
    		}
    	});
    </script>
   
</body>
</html>
