<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Daftar Qurban</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css">

</head>

<body>

<div class="container">
    <div id="wrapper">

        
        <div id="page-wrapper">
            <div class="row">
               
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables Advanced Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                        	<form class="form-horizontal" method="post" action="<?php echo base_url();?>qurban/daftarQurban">
							  	<div class="form-group">
							    	<label for="" class="col-sm-2 control-label">Nama</label>
							    	<div class="col-sm-10">
							      		<input type="text" name="nama" class="form-control" id="" placeholder="Nama">
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label for="" class="col-sm-2 control-label">Telpon</label>
							    	<div class="col-sm-10">
							      		<input type="text" name="telpon" class="form-control" id="" placeholder="Telpon">
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label for="" class="col-sm-2 control-label">Alamat</label>
							    	<div class="col-sm-10">
							    		<textarea name="alamat" class="form-control"></textarea>
							    	</div>
							  	</div>
							  
							  	<div class="form-group">
							    	<div class="col-sm-offset-2 col-sm-10">
							      		<button type="submit" class="btn btn-default">Submit</button>
							    	</div>
							  	</div>

							  	
								
							</form>

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
   
</body>
</html>
