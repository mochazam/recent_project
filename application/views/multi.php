<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mahasiswa</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/toastr.css">
    <!-- DataTables CSS -->
    <link href="<?php echo base_url();?>assets/css/dataTables.bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css">

</head>

<body onload="viewdata()">

<div class="container">
    <div id="wrapper">

        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Mahasiswa
                  
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
                        	<button class="btn btn-danger" id="delsel">Delete Selected</button>
                        	<hr>
                            <div class="table-responsive col-lg-12">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                        	<th style="text-align:center;width:45px;"><input type="checkbox" id="checkall"></th>
                                            <th>#</th>
                                            <th>Mahasiswa</th>
                                            <th>NPM</th>
                                            <th>Angkatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	
                                    </tbody>
                                </table>
                            </div>
                           
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

    <script src="<?php echo base_url();?>assets/js/toastr.js"></script>

    <!-- DataTables JavaScript 
    <script src="<?php echo base_url();?>assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables/dataTables.bootstrap.js"></script>

    -->
    <!-- Page-Level Demo Scripts - Tables - Use for reference 
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>
	-->
    <script>
    function viewdata() {
    	$.ajax({
    		url: '<?php echo base_url().'delete_multi/getAllData'; ?>',
    		type: 'GET',
    		success: function(data) {
    			$('tbody').html(data)
    		}
    	})
    }

    $('#checkall').change(function() {
    	$('.checkitem').prop("checked", $(this).prop("checked"))
    })
    
    $('#delsel').click(function() {
    	var id = $('.checkitem:checked').map(function() {
    		return $(this).val()
    	}).get().join(' ')
    	
    	$.ajax({
    		url: '<?php echo base_url().'delete_multi/delAll'; ?>',
    		data: {id: id},
    		type: 'POST',
    		success: function() {
    			toastr.success('data berhasil didelete!');
    		},
    		error: function() {
    			toastr.error('data gagal didelete!');
    		}
    		
    	})
    	viewdata();
    	
    })	
   
    </script>
    
</body>

</html>
