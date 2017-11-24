<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

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
                            
                        	 
                        	<form action="<?php echo base_url();?>comic/storeSerie/<?php echo $id;?>" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                        	 <input type="hidden" name="com_id" value="<?php echo $id;?>">

								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Title</label>
			                        
									<div class="col-sm-5">
										<input type="text" class="form-control" name="nama_komik" value="" >
									</div>
								</div>

								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">File</label>
			                        
									<div class="col-sm-5">
										<input type="file" class="form-control" name="compress_file" >
									</div>
								</div>
			                    
			                    <div class="form-group">
									<div class="col-sm-offset-3 col-sm-5">
										<button type="submit" class="btn btn-danger">add</button>
									</div>
								</div>
			                

							  	<!-- warning akan muncul disini -->
								<?php
									$info = $this->session->flashdata('info'); //menampung informasi yang di lempar di mode
									if(!empty($info)) //jika info tidak kosong maka tampilkan warning
									{
										echo $info;//kita tes
									}
								?>	
								
							<?php echo form_close();?>
								
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
