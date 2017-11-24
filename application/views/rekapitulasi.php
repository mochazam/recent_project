<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rekapitulasi Absensi</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">  
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/datepicker.css">
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
                    <h1 class="page-header">Rekapitulasi Absensi
                    </h1>
                </div>
            </div>

    		<!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><!-- /.row -->
			                <div class="row">
			                    <div class="col-lg-12">
			                        <div class="panel panel-default">
			                            <div class="panel-heading">
			                                DataTables Advanced Tables
			                            </div>
			                            <!-- /.panel-heading -->
			                            <div class="panel-body">

			                            	<?php echo form_open(base_url() . 'lap_rekap_absensi' , array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_blank'));?>
			                            	
				                            	
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

												<div class="form-group" style="display:none">
                                                    <label for="field-1" class="col-sm-3 control-label">Nama MK</label>
                                                    
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" id="mk_name" name="mk_name" value="">
                                                    </div>
                                                </div>
												
                                                <div class="form-group">
                    		                        <div class="col-sm-offset-3 col-sm-5">
                    		                            <input type="submit" id="tombol" class="btn btn-primary disabled" value="Cetak">
                                                    </div>
                    		                    </div>

					  		            	<?php echo form_close();?>

<script type="text/javascript">
    
	function get_data_absensi(){
	    $('#pilihan').change(function() {
	    	var selectedOption = $('#pilihan option:selected'),
	    	inputSubmit = $('input[type="submit"]#tombol'),
            	mata = selectedOption.text(),
	    		dataString = {mk:$('#pilihan').val()};
		    $.ajax({
		        type: "POST",
		        url: "<?php echo base_url().'absen/rekap_absen'; ?>",
		        data: dataString,
		        success: function(resp){
		                $("#rekap_absen").html(resp);
		                inputSubmit.removeClass('disabled');
		        },
		        error:function(event, textStatus, errorThrown) {
		            $("#rekap_absen").html('Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
		        },
		        timeout: 4000
		    });
		    return $('#mk_name').val(mata);
		});    
	}

	get_data_absensi();
	</script>

			                    		    <div class="row container2">
			                    		        <div class="col-lg-12">
												    <div class="table-responsive col-lg-12">
						                            	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										              		<thead>
												                <tr>
												                  	<th>#</th>
												                  	<th>Nama</th>
												                  	<th>NPM</th>
												                  	<th>Masuk</th>
												                  	<th>Telat</th>
												                  	<th>Abstain</th>
												                </tr>
										              		</thead>
										              		<tbody id="rekap_absen">

										              		</tbody>
										            	</table>
													</div>  
												</div>	
											</div>
										</div>
									</div>
								</div>
							</div>					
  		            	</div>
  		        	</div>
		      	</div>
	        </div>  
    	</div>
  	</div>
</div>    
  
 
</body>
</html>

