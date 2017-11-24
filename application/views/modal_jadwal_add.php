
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
            		Add
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'jadwal/go/create/' , array('class' => 'form-horizontal form-groups-bordered validate'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Matakuliah</label>
                        
						<div class="col-sm-5">
							<select class="form-control" name="matakuliah">
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
						<label for="field-1" class="col-sm-3 control-label">Dosen</label>
                        
						<div class="col-sm-5">
							<select class="form-control" name="dosen">
								<option>-- SELECT DOSEN --</option>

								<?php 
								$kd_dsn   =   $this->db->get('ja_mst_dosen' )->result_array();
								foreach($kd_dsn as $dsn ): ?>
									<option value="<?php echo $dsn['kode_dosen'];?>"><?php echo $dsn['nama_dosen'];?> </option>		
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Ruang</label>
                        
						<div class="col-sm-5">
							<?php
								$add_info = 'class="form-control"';
								$options = array(
									'101' => '101',
									'102' => '102',
									'103' => '103',
									'104' => '104',
									'105' => '105',
									'201' => '201',
									'202' => '202',
									'203' => '203',
									'204' => '204',
									'205' => '205'
									);
								echo form_dropdown('ruang', $options, '', $add_info);
							?>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Jadwal</label>
                        
						<div class="col-sm-5">
							<?php
								$add_info = 'class="form-control"';
								$options = array(
									'Senin' => 'Senin',
									'Selasa' => 'Selasa',
									'Rabu' => 'Rabu',
									'Kamis' => 'Kamis',
									'Jumat' => 'Jumat',
									);
								echo form_dropdown('jadwal', $options, '', $add_info);
							?>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Jam</label>
                        
						<div class="col-sm-5">
							<?php
								$add_info = 'class="form-control"';
								$options = array(
									'7' => '07.00',
									'8' => '08.00',
									'9' => '09.00',
									'10' => '10.00',
									'11' => '11.00',
									'12' => '12.00',
									'13' => '13.00',
									'14' => '14.00',
									'15' => '15.00',
									'16' => '16.00',
									);
								echo form_dropdown('jam', $options, '', $add_info);
							?>
						</div>
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-danger">add</button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
