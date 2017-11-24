<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Mahasiswa</title>
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
                    <h1 class="page-header">Data Mahasiswa
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
									<label for="field-1" class="col-sm-3 control-label">Mahasiswa</label>
			                        
									<div class="col-sm-4">
										<select class="form-control" name="mhsiswa" id="pilihan">
											<option>-- SELECT Mahasiswa --</option>

											<?php 
											$kd_mhsiswa = $this->db->get('pw_mst_mahasiswa' )->result_array();
											foreach($kd_mhsiswa as $mhs ): ?>
												<option value="<?php echo $mhs['nim'];?>"><?php echo $mhs['nama_mhs'];?> </option>		
											<?php endforeach; ?>
										</select>
									</div>
								</div>
	  		            	</div>


  		              
  		              	<div class="col-lg-12">
                            <form class="form-horizontal">
							  	<div class="form-group">
							    	<label for="nama" class="col-sm-2 control-label">Nama</label>
							    	<div class="col-sm-10">
							      		<input type="text" class="form-control" id="nama">
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label for="nim" class="col-sm-2 control-label">NIM</label>
							    	<div class="col-sm-10">
							      		<input type="text" class="form-control" id="nim">
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label for="gender" class="col-sm-2 control-label">Jenis Kelamin</label>
							    	<div class="col-sm-10">
							      		<input type="text" class="form-control" id="gender">
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label for="angkatan" class="col-sm-2 control-label">Angkatan</label>
							    	<div class="col-sm-10">
							      		<input type="text" class="form-control" id="angkatan">
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label for="kode" class="col-sm-2 control-label">Kode Jurusan</label>
							    	<div class="col-sm-10">
							      		<input type="text" class="form-control" id="kode">
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label for="program" class="col-sm-2 control-label">Program</label>
							    	<div class="col-sm-10">
							      		<input type="text" class="form-control" id="program">
							    	</div>
							  	</div>
							  	
							</form>
						</div>  
  		            
  		            </div>
  		        </div>
		    </div>
          
    	</div>
  </div>
    
<script type="text/javascript">
		$('#pilihan').change(function() {
			var id_mahasiswa = {id_mahasiswa:$('#pilihan').val()};
		//var id = {id:1111317};
		    $.ajax({
		        type: "POST",
		        url: "<?php echo base_url().'json/getAllData'; ?>",
		        data: id_mahasiswa,
		        success: function(data) {
		        	response = jQuery.parseJSON(JSON.stringify(data));
		            $("#nama").val(response.nama);
		            $("#nim").val(response.nim);
		            $("#gender").val(response.gender);
		            $("#angkatan").val(response.angkatan);
		            $("#kode").val(response.kode);
		            $("#program").val(response.program);
		        }
		    });
		});    
	

</script>
 
  </body>
</html>

