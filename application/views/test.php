<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Auto Absen</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">  
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.1.js"></script>

  </head>
  <body>
    
  <div class="container">
    <div id="wrapper">
    	<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Auto Absen    
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    
        <div id="page-wrapper">
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables Advanced Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

	  		            	<?php echo form_open(base_url() . 'test/insert_auto/' , array('class' => 'form-horizontal form-groups-bordered validate'));?>

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

								<div class="form-group">
    		                        <div class="col-sm-offset-3 col-sm-5">
    		                            <input type="submit" id="tombol" class="btn btn-primary" value="Auto Insert">
                                    </div>
    		                    </div>

	  		            	<?php echo form_close();?>

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

