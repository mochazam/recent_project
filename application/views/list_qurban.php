<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>List Qurban</title>

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
                            

                        <?php
                        	for ($i=1; $i <= $group; $i++) { 
                        		//echo '$qurban'.$i.'<br>';                        		
                        ?>
                        	<table class="table table-bordered">
                    			<thead>
                    				<tr>
                    					<td>No</td>
                    					<td>Nama</td>
                    					<td>Alamat</td>
                    					<td>Telpon</td>
                    				</tr>
                    			</thead>

                        	<?php
                        		$no = 1;
                        		
                        		foreach (${'qurbans' . $i}->result_array() as ${'qurban' . $i}) {
                        	?>
                        		
                        			<tbody>
                        				<tr>
                        					<td><?php echo $no++; ?></td>
                        					<td><?php echo ${'qurban' . $i}['nama']; ?></td>
                        					<td><?php echo ${'qurban' . $i}['alamat']; ?></td>
                        					<td><?php echo ${'qurban' . $i}['telpon']; ?></td>
                        				</tr>
                        			</tbody>
                        				
                        	<?php	
                        		}
                        	?>

                        	</table>

                        	<br>
                        
                        <?php	
                        		}
                        	?>	
                        	 

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
