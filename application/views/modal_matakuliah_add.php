
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
				
                <?php echo form_open(base_url() . 'matakuliah/go/create/' , array('class' => 'form-horizontal form-groups-bordered validate'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Matakuliah</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="nama_mk" value="" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Kode Matakuliah</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="kode_mk" value="" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">SKS</label>
                        
						<div class="col-sm-5">
							<?php 
							$add_info = 'class="form-control"';
							$options = array(
									  '0' => '0',
					                  '1' => '1',
					                  '2' => '2',
					                  '3' => '3',
					                  '4' => '4',
					                  '5' => '5',
					                );
							echo form_dropdown('jum_sks', $options, '', $add_info);
							?>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Semester</label>
                        
						<div class="col-sm-5">
							<?php 
							$add_info = 'class="form-control"';
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
