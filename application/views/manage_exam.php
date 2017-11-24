<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Manage Exam</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/toastr.css">
    <!-- DataTables CSS -->
    <link href="<?php echo base_url();?>assets/css/dataTables.bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css">


</head>

<body>

    <?php $this->load->view('nav_adm'); ?>

<div class="container">
    <div id="wrapper">

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Exam
                        <div class="pull-right">
                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_exam_add/');" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> tambah</a> 
                        </div>
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
                            <div class="table-responsive col-lg-12">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Test Name</th>
                                            <th>Time</th>
                                            <th>Date</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
											//untuk menampilkan data dari table, diambil dari variable table yg ada di controller hubungi
											$no=1;
											foreach($data_exam as $row){
										?>
	                                        <tr class="">
	                                            <td><?php echo $no++;?></td>
	                                            <td><?php echo $row['test_name'];?></td>
                                                <td><?php echo $row['time'];?></td>
                            					<td><?php echo $row['date'];?></td>
	                                            <td>
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_exam_edit/<?php echo $row['id'];?>');" class="icon huge" title="edit"><i class="fa fa-pencil"></i></a>&nbsp;
                                                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>exam/manage_exam/delete/<?php echo $row['id'];?>');" class="icon huge" data-toggle="modal" title="remove"><i class="fa fa-trash-o"></i></a>&nbsp;
                                                </td>
	                                        </tr>
	                                        <?php } ?>
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

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/js/metisMenu/metisMenu.min.js"></script>

    <script src="<?php echo base_url();?>assets/js/toastr.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url();?>assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables/dataTables.bootstrap.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
    <script>

        // This call can be placed at any point after the
        // <textarea>, or inside a <head><script> in a
        // window.onload event handler.

        // Replace the <textarea id="editor"> with an CKEditor
        // instance, using default configurations.

        CKEDITOR.replace( 'editor1' );

    </script>
    
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>

     <script type="text/javascript">
    function showAjaxModal(url)
    {
        // SHOWING AJAX PRELOADER IMAGE
        jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="<?php echo base_url();?>assets/images/loader-1.gif" /></div>');
        
        // LOADING THE AJAX MODAL
        jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
        
        //alert(url);
        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function(response)
            {
                jQuery('#modal_ajax .modal-body').html(response);

            }
        });
    }
    </script>
    
    <!-- (Ajax Modal)-->
    <div class="modal fade" id="modal_ajax">
        <div class="modal-dialog" style="width: 50%;">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Artikel</h4>
                </div>
                
                <div class="modal-body" style="height:320px; overflow:auto;">
                
                    
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    <script type="text/javascript">
    function confirm_modal(delete_url)
    {
        jQuery('#modal-4').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
    </script>
    
    <!-- (Normal Modal)-->
    <div class="modal fade" id="modal-4">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link">delete</a>
                    <button type="button" class="btn btn-info" data-dismiss="modal">cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- SHOW TOASTR NOTIFIVATION -->
    <?php if ($this->session->flashdata('flash_message') != ""):?>

    <script type="text/javascript">
        toastr.success('<?php echo $this->session->flashdata("flash_message");?>');
    </script>

    <?php elseif ($this->session->flashdata('flash_message_error') != "") :?>

    <script type="text/javascript">
        toastr.error('<?php echo $this->session->flashdata("flash_message_error");?>');
    </script>

    <?php endif;?>

</body>

</html>
