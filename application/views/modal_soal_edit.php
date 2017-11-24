<?php 
	$this->db->select('*');
    $this->db->from('soal');
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
            		Edit Soal <?php echo $row->id; ?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'soal/go/edit/'. $row->id , array('class' => 'form-horizontal form-groups-bordered validate'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Soal Kuesioner</label>
                        
						<div class="col-sm-5">
							<textarea class="form-control" name="soal"><?php echo $row->soal; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Status</label>
                        
						<div class="col-sm-5">
							<?php
								$add_info = 'class="form-control"';
								$options = array(
									'1' => 'Aktif',
									'2' => 'Tidak Aktif',
									);
								echo form_dropdown('status', $options, $row->status, $add_info);
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