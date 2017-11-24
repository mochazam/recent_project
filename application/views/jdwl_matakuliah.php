<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelas Matakuliah</title>
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
                    <h1 class="page-header">Kelas Matakuliah
                        <div class="pull-right">
                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_dosen_add/');" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> tambah</a> 
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

	  		            	<div class="form-horizontal">
	  		            		<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Matakuliah</label>
			                        
									<div class="col-sm-4">
										<select class="form-control" name="kd_mk" id="pilihan">
											<option>-- SELECT MATAKULIAH --</option>

											<?php 
											$kd_mk   =   $this->db->get('ja_mst_mk' )->result_array();
											foreach($kd_mk as $mk ): ?>
												<option value="<?php echo $mk['kode_mk'];?>"><?php echo $mk['nama_mk'];?> </option>		
											<?php endforeach; ?>
										</select>
									</div>
								</div>
	  		            	</div>

<script type="text/javascript">
	function get_kelas_mk(){
		$('#pilihan').change(function() {
			var id = {id:$('#pilihan').val()};
		//var id = {id:1111317};
		    $.ajax({
		        type: "POST",
		        url: "<?php echo base_url().'matakuliah/retrieve_klsMk'; ?>",
		        data: id,
		        success: function(resp){
		                $("#absen_mhs").html(resp);
		        },
		        error:function(event, textStatus, errorThrown) {
		            $("#absen_mhs").html('Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
		        },
		        timeout: 4000
		    });
		});    
	}

	get_kelas_mk();
</script>
  		              
  		              	<div class="table-responsive col-lg-12">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
				              	<thead>
				                	<tr>
				                  		<th>#</th>
				                  		<th>Mahasiswa</th>
				                  		<th>NPM</th>
				                	</tr>
				              	</thead>
				              	<tbody id="absen_mhs">

				              	</tbody>
				            </table>
						</div>  
  		            
  		            </div>
  		        </div>
		    </div>
          
    	</div>
  </div>
    

 
  </body>
</html>

