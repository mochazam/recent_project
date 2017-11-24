
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
				
                <?php echo form_open(base_url() . 'mahasiswa/go/create/' , array('class' => 'form-horizontal form-groups-bordered validate'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Nama</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="nama_mhs" value="" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Kelamin</label>
                        
						<div class="col-sm-5">
							<select class="form-control" name="kelamin">
								<option value="1">Laki-laki</option>
								<option value="2">Perempuan</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Angkatan</label>
                        
						<div class="col-sm-5">
							<?php
								$add_info = 'class="form-control"';
								$options = array(
									'2007' => '2007',
									'2008' => '2008',
									'2009' => '2009',
									'2010' => '2010',
									'2011' => '2011',
									'2012' => '2012',
									'2013' => '2013',
									'2014' => '2014',
									'2015' => '2015',
									'2016' => '2016',
									'2017' => '2017',
									'2018' => '2018',
									'2019' => '2019',
									'2020' => '2020',
									);
								echo form_dropdown('angkatan', $options, '', $add_info);
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
