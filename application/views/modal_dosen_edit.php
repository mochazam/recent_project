<?php 
	$this->db->select('*');
    $this->db->from('ja_mst_dosen');
    $this->db->where('kode_dosen', $param2);
    $edit_data = $this->db->get();
	foreach ($edit_data->result() as $row):
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
            		Edit <?php echo $row->kode_dosen; ?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'dosen/go/edit/'. $row->kode_dosen , array('class' => 'form-horizontal form-groups-bordered validate'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Nama Dosen</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="nama" value="<?php echo $row->nama_dosen; ?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Kode Dosen</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="kd_dosen" value="<?php echo $row->kode_dosen; ?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">NIDN</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="nO_id" value="<?php echo $row->NIDN; ?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Alamat</label>
                        
						<div class="col-sm-9">
							<textarea class="form-control wysihtml5" data-stylesheet-url="" name="alamat" id="sample_wysiwyg"><?php echo $row->alamat;?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Telpon</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="telpon" value="<?php echo $row->telp; ?>" >
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