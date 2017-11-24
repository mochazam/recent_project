<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log Absensi</title>
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
                    <h1 class="page-header">Absensi per Matakuliah
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

			                            	<?php echo form_open(base_url() . 'lap_absensi' , array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_blank'));?>
			                            	
				                            	<div class="form-group">
				                            		<label for="id-date-picker-1" class="col-sm-3 control-label">From</label>
													<div class="col-sm-2">
														<input class="form-control datepicker" id="tgl_awal" name="mulai" type="text" data-date-format="yyyy-mm-dd" />
														<span class="add-on">
															<i class="icon-calendar"></i>
														</span>
													</div>

													<label for="id-date-picker-1" class="col-sm-1 control-label">To</label>
													<div class="col-sm-2">
														<input class="form-control datepicker" id="tgl_akhir" name="selesai" type="text" data-date-format="yyyy-mm-dd" />
														<span class="add-on">
															<i class="icon-calendar"></i>
														</span>
													</div>
												</div>	
											
											<!--
			                            		<div class="form-group">
                                                    <label for="field-1" class="col-sm-3 control-label">Tanggal</label>
                                                    
                                                    <div class="col-sm-2">
                                                        <input name="tanggal" class="form-control login-field datepicker" data-date-format="yyyy-mm-dd" id="tanggal" type="text" value="">
                                                    </div>
                                                </div>
											-->
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
            	mata = selectedOption.text(),
	    		//dataString = {id:$('#pilihan').val(), tgl:$('#tanggal').val()};
	    		dataString = {id:$('#pilihan').val(), start:$('#tgl_awal').val(), end:$('#tgl_akhir').val()};
	    	//alert($('#tanggal').val());
	    	alert($('#tgl_awal').val());
	    	alert($('#tgl_akhir').val());
		    $.ajax({
		        type: "POST",
		        url: "<?php echo base_url().'absen/retrieve_absensi'; ?>",
		        data: dataString,
		        success: function(resp){
		                $("#status_absen").html(resp);
		        },
		        error:function(event, textStatus, errorThrown) {
		            $("#status_absen").html('Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
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
												                  	<th>Tanggal</th>
												                  	<th>Jam</th>
												                  	<th>Status</th>
												                </tr>
										              		</thead>
										              		<tbody id="status_absen">

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
  
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript">
	 	$('.datepicker').datepicker({
            autoclose: 1,
        })
        $('.date-picker').datepicker().next().on(ace.click_event, function(){
			$(this).prev().focus();
		})
		$('#id-date-range-picker-1').daterangepicker().prev().on(ace.click_event, function(){
			$(this).next().focus();
		})
	</script>
    <script type="text/javascript">
        $(document).ready(function() {
        	var inputSubmit = $('input[type="submit"]#tombol'),
        		selectedDate = $('#tanggal').val();
        	            
        	$('#pilihan').change(function() {        
        		//alert(selectedDate.length);		
            	if ($('#tgl_akhir').val().length > 0) 
            	{
            		inputSubmit.removeClass('disabled');
            	};	
            })
        });      	
    </script>
 
</body>
</html>

