<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kartu Rencana Studi</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">  
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css">    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/toastr.css">

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.1.js"></script>
    <script src="<?php echo base_url();?>assets/js/toastr.js"></script>
  </head>
  <body>

  	<?php $this->load->view('nav'); ?>
    
  <div class="container">
    <div id="wrapper">

        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">KRS    
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php
                            	$years = date('Y') - 1;
								$months = date('m');
								$dwisem = array('gasal', 'genap');
								if ($months < 6) {
								  	$sem = $dwisem[0];
								}  
								else {
									$sem = $dwisem[1];
								}
								echo $sem_total = $sem . "-" . $years;
                            ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

	  		            	<div class="form-horizontal">

	  		            		<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Mahasiswa</label>
			                        
									<div class="col-sm-4">
										<select class="form-control" name="kd_mhs" id="pilih_mhs">
											<option>-- SELECT MAHASISWA --</option>

											<?php 
											$kd_mhs   =   $this->db->get('pw_mst_mahasiswa' )->result_array();
											foreach($kd_mhs as $mhs ): ?>
												<option value="<?php echo $mhs['nim'];?>"><?php echo $mhs['nama_mhs'];?> - NIM: <?php echo $mhs['nim'];?></option>		
											<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group">
										<label for="field-1" class="col-sm-1 control-label">Semester</label>
										<div class="col-sm-1">
												<?php 
												$add_info = 'id="semester" class="form-control"';
												$options = array(
										                  '1' => '1',
										                  '2' => '2',
										                  '3' => '3',
										                  '4' => '4',
										                  '5' => '5',
										                  '6' => '6',
										                  '7' => '7',
										                  '8' => '8',
										                );
												echo form_dropdown('semester', $options, '', $add_info);
												?>
										</div>
									</div>	
								</div>

								<div class="form-group">
    		                        <div class="col-sm-offset-3 col-sm-5">
    		                        	<button id="btn_add" class="btn btn-info">Tambah Matakuliah</button>
                                    </div>
    		                    </div>

								<div class="form-group" id="pilih_mk" style="display:none">
									<label for="field-1" class="col-sm-3 control-label">Matakuliah</label>
			                        
									<div class="col-sm-8">
										<select class="form-control" name="kd_mk" id="pilihan">
											<option>-- SELECT MATAKULIAH --</option>

											<?php 
											$months = date('m');
											if ($months < 6) {
									            $sem = array(2, 4, 6, 8);
									        }  
									        else {
									            $sem = array(1, 3, 5, 7);
									        }
											$this->db->select('*');
									        $this->db->from('ja_mst_mk');
									        $this->db->join('ja_tr_jadwal', 'ja_tr_jadwal.kode_mk = ja_mst_mk.kode_mk');
									        $this->db->join('ja_mst_dosen', 'ja_mst_dosen.kode_dosen = ja_tr_jadwal.kode_dosen');
									        $this->db->where_in('semester', $sem);
									        $query = $this->db->get();
									        $kd_mk = $query->result_array();

											//$kd_mk   =   $this->db->get('ja_mst_mk' )->result_array();
											foreach($kd_mk as $mk ): ?>
												<option value="<?php echo $mk['kode_mk'];?>"><?php echo $mk['nama_mk'];?> - <?php echo $mk['jum_sks'];?> SKS - <?php echo $mk['jadwal'];?> - R.<?php echo $mk['ruang'];?> - Dosen: <?php echo $mk['nama_dosen'];?> </option>		
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<div class="form-group" id="btn_submit" style="display:none">
									<div class="col-sm-offset-3 col-sm-5">
                    		            <input type="submit" id="tombol" class="btn btn-danger" value="Submit">
									</div>
								</div>	
										
	  		            	</div>

<script type="text/javascript">

	function delete_data(id,matakuliah){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url().'krs/delete_data'; ?>",
            data: {"id":id},
            success: function(resp){
                    //alert(matakuliah + " berhasil di hapus");
                    toastr.success('matakuliah ' + matakuliah + ' success deleted!');
                    instant_output();
            },
            error:function(event, textStatus, errorThrown) {
                alert('Aksi gagal dilakukan, Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
            },
            timeout: 4000 // Timeout query request 4 Detik
        });
    };

	function get_kelas_mk(){
		$('#pilih_mhs').change(function() {
			var id = {id:$('#pilih_mhs').val(), sms:$('#semester').val()};
			//var sms = $('#semester').val();
			//alert(sms);
		    $.ajax({
		        type: "POST",
		        url: "<?php echo base_url().'krs/retrieve_mkAmbil'; ?>",
		        data: id,
		        success: function(resp){
		                $("#matakuliah_ambil").html(resp);
		        },
		        error:function(event, textStatus, errorThrown) {
		            $("#matakuliah_ambil").html('Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
		        }
		    });
		});    
	}

	function instant_output() {
		// instant output
        var id = {id:$('#pilih_mhs').val(), sms:$('#semester').val()};
	    $.ajax({
	        type: "POST",
	        url: "<?php echo base_url().'krs/retrieve_mkAmbil'; ?>",
	        data: id,
	        success: function(resp){
	                $("#matakuliah_ambil").html(resp);
	        },
	        error:function(event, textStatus, errorThrown) {
	            $("#matakuliah_ambil").html('Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
	        }
	    });
	}

	$('#btn_add').click(function(){
		$(this).hide('slow');
		$('#pilih_mk').show('slow');
		$('#btn_submit').show('slow');
	})

	$('input[type="submit"]').click(function(){
        var dataString = {mhs:$("#pilih_mhs").val(), mk:$("#pilihan").val(),  semester:$("#semester").val()};
        instant_output();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('krs/added_log');?>",
            data: dataString,
            success: function(resp) {
            	toastr.success('data success added!');
            },
            error: function(resp) {
            	toastr.error('data added failed!');
            }
        });
        
    }); 

	//get_kelas_mk();
	setInterval(function() {get_kelas_mk()}, 1000);
</script>
  		              
  		              	<div class="table-responsive col-lg-12">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
				              	<thead>
				                	<tr>
				                  		<th>#</th>
				                  		<th>Matakuliah</th>
				                  		<th>SKS</th>
				                  		<th>Dosen</th>
				                  		<th>Jadwal</th>
				                  		<th>Ruang</th>
				                  		<th>Jam</th>
				                  		<th>Aksi</th>				                  		
				                	</tr>
				              	</thead>
				              	<tbody id="matakuliah_ambil">

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

