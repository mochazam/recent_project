<?php 
	$this->db->select('*');
    $this->db->from('map');
    $this->db->where('id', $param2);
    $edit_data = $this->db->get();
	foreach ($edit_data->result() as $row):
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
            		Edit <?php echo $row->nama_map; ?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open_multipart(base_url() . 'pinit/go/edit/'. $row->id , array('class' => 'form-horizontal form-groups-bordered validate'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Nama Map</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="nama_map" value="<?php echo $row->nama_map; ?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Image</label>
                        
						<div class="col-sm-5">
							<input type="file" class="form-control" name="map_file" >
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