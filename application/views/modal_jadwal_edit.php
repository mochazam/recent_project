<?php 
	$this->db->select('*');
    $this->db->from('ja_tr_jadwal');
    $this->db->join('ja_mst_dosen', 'ja_mst_dosen.kode_dosen = ja_tr_jadwal.kode_dosen');
    $this->db->join('ja_mst_mk', 'ja_mst_mk.kode_mk = ja_tr_jadwal.kode_mk');
    $this->db->where('id_jadwal', $param2);
    $edit_data = $this->db->get();
	foreach ($edit_data->result() as $row):
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
            		Edit <?php echo $row->id_jadwal; ?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'jadwal/go/edit/'. $row->id_jadwal , array('class' => 'form-horizontal form-groups-bordered validate'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Matakuliah</label>
                        
						<div class="col-sm-5">
							<?php
								$query = $this->db->get('ja_mst_mk');
						        $kategori_mk = array();
						        foreach ($query->result_array() as $rowi) {
						            $kategori_mk[$rowi['kode_mk']] = $rowi['nama_mk'];   
						        }
						        $add_info = 'class="form-control"';
							?>
							<?php echo form_dropdown('matakuliah', $kategori_mk, $row->kode_mk, $add_info); ?>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Dosen</label>
                        
						<div class="col-sm-5">
							<?php
								$query = $this->db->get('ja_mst_dosen');
						        $kategori_dsn = array();
						        foreach ($query->result_array() as $dsn) {
						            $kategori_dsn[$dsn['kode_dosen']] = $dsn['nama_dosen'];   
						        }
						        $add_info = 'class="form-control"';
							?>
							<?php echo form_dropdown('dosen', $kategori_dsn, $row->kode_dosen, $add_info); ?>
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
								echo form_dropdown('ruang', $options, $row->ruang, $add_info);
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
								echo form_dropdown('jadwal', $options, $row->jadwal, $add_info);
							?>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Jam</label>
                        
						<div class="col-sm-5">
							<?php
								$add_info = 'class="form-control"';
								$options = array(
									'07.00' => '07.00',
									'08.00' => '08.00',
									'09.00' => '09.00',
									'10.00' => '10.00',
									'11.00' => '11.00',
									'12.00' => '12.00',
									'13.00' => '13.00',
									'14.00' => '14.00',
									'15.00' => '15.00',
									'16.00' => '16.00',
									);
								echo form_dropdown('jam', $options, $row->jam, $add_info);
							?>
						</div>
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-danger">edit</button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php endforeach;?>