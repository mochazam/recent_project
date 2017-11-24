<!DOCTYPE html>
<html>
<head>
	<title>Exam Online</title>

	<!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css">
    <style type="text/css">

    .bs-callout {
	    padding: 20px;
	    margin: 20px 0;
	    border: 1px solid #eee;
	    border-radius: 3px;
	}
   
	
	.media>.pull-left{margin-right:10px}
	.media>.pull-right{margin-left:10px}
	.media-list{margin-left:0;list-style:none}
	.media,
 	.media-body {
     	overflow: hidden;
     	*overflow: visible;
 	}
  	.media-object {
     	display: block;
   	}
  	.media-heading {
     	margin: 0 0 5px;
   	}
  	.media-list {
     	margin-left: 0;
     	list-style: none;
    } 
    .search-actions {
    	*border: 1px solid #eee;
    	font-size: 18px;

    }
    .search-actions span {
    	font-size: 25px;
    	color: #5bc0de;
    }
    .search-btn-action {
    	font-weight: bold;
    	font-size: 18px;
    	*margin-top: -18px;
    }
    .media-heading {

    }
    .media-body p {
    	font-size: 18px;
    }
    .alert {
    	margin-bottom: 0px;
  		border-radius: 0px;
    }
    .btn {
    	border-radius: 0px;
    }
    </style>
</head>
<body>

<?php $this->load->view('nav_adm'); ?>

	<div class="container">
		<div class="row">



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

			<h1>Exam List</h1>

	<?php 
	foreach ($tests as $test) {
	?>

	<div class="bs-callout well">
		<div class="media-left">
			<a href="#">
				<img class="media-object">
			</a>
		</div>

		<div class="media-body">
			<div class="row1">
				<div class="col-md-9 media-info">
					<h2 class="media-heading">
						<a href="#" class="blue"><?php echo $test['test_name']; ?></a>
					</h2>
					<p>This is about <b></b> multiple choice questions and should take less than <b><?php echo ($test['time'])/60; ?></b> minutes to complete. For each correct answer <b>1</b> point will be given.</p>
				</div>
				<div class="search-actions text-center col-md-3 ">
					<span class="text-info"></span>
					<div class="alert alert-info">
						<span class="blue bolder bigger-150"><?php echo ($test['time'])/60; ?></span><br>
					Minutes
					</div>
					<div class="action-buttons bigger-125">
						
					</div>
					<a href="<?php echo base_url();?>exam/test/<?php echo $test['id']; ?>" class="search-btn-action btn btn-lg btn-block btn-info">Take it!</a>
				</div>
			</div>
		</div>
	</div>
	<?php 
	} ?>

			

			
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
	</div>


</body>
</html>