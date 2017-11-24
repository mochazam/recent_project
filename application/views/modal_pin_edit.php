<?php 
	$this->db->select('*');
    $this->db->from('pinit');
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
            		Edit <?php echo $row->title; ?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open_multipart(base_url() . 'pinit/editPin/'. $row->id , array('class' => 'form-horizontal form-groups-bordered validate'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">ID Map</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="map" value="<?php echo $row->map_id; ?>" >
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