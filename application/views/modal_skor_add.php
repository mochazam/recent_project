
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
            		Tambah Skor Baru
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'skor/go/create/' , array('class' => 'form-horizontal form-groups-bordered validate'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Skor Kuesioner</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="skor" value="" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Status</label>
                        
						<div class="col-sm-5">
							<select class="form-control" name="status">
								<option value="1">Aktif</option>
								<option value="2">Tidak Aktif</option>
							</select>
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
