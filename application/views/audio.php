<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input Suara</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">  
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.1.js"></script>

  </head>
  <body>

  	<?php $this->load->view('nav'); ?>
    
  <div class="container">
    <div id="wrapper">

        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Input Suara
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
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

	  		          


  		              
	  		              	<div class="col-lg-12">
	                       <?php echo form_open_multipart(base_url() . 'audio/upload/' , array('class' => 'form-horizontal form-groups-bordered validate'));?>

        								  	<div class="form-group">
        								    	<label for="nama" class="col-sm-2 control-label">File</label>
        								    	<div class="col-sm-10">
        								      		<input type="file" class="form-control" id="userfile" name="userfile">
        								    	</div>
        								  	</div>
        								  	
        								  
        								  	<div class="col-sm-offset-3 col-sm-5">
        										<button type="submit" class="btn btn-danger">add</button>
        									</div>
        								  	
        								<?php echo form_close();?>
        							</div>  
  		            
  		            </div>
  		        </div>
		    </div>
          
    	</div>
  </div>
    
  </body>
</html>

