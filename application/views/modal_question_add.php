
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
				
                <?php echo form_open(base_url() . 'exam/manage_question/create/' , array('class' => 'form-horizontal form-groups-bordered validate'));?>

                	<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Kategori</label>
                        
						<div class="col-sm-5">
							<select class="form-control" name="test_id">
								<option>-- SELECT kategori --</option>

								<?php 
								$kd_cat   =   $this->db->get('tbl_test' )->result_array();
								foreach($kd_cat as $cat ): ?>
									<option value="<?php echo $cat['id'];?>"><?php echo $cat['test_name'];?> </option>		
								<?php endforeach; ?>
							</select>
						</div>
					</div>

                	<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Question</label>
                        
						<div class="col-sm-5">
							<textarea class="form-control" name="question"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Option 1</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="option1" value="" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Option 2</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="option2" value="" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Option 3</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="option3" value="" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Option 4</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="option4" value="" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Answer</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="answer" value="" >
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
