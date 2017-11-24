<?php 
	$this->db->select('tbl_question.*');
    $this->db->from('tbl_question');
    $this->db->where('tbl_question.id', $param2);
    $edit_data = $this->db->get();
	foreach ($edit_data->result() as $row):
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
            		Edit <?php echo $row->question; ?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'exam/manage_question/edit/'. $row->id , array('class' => 'form-horizontal form-groups-bordered validate'));?>

                	<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Kategori</label>
                        
						<div class="col-sm-5">
							<?php
								$query = $this->db->get('tbl_test');
						        $kategori_test = array();
						        foreach ($query->result_array() as $rowi) {
						            $kategori_test[$rowi['id']] = $rowi['test_name'];   
						        }
						        $add_info = 'class="form-control"';
							?>
							<?php echo form_dropdown('test_id', $kategori_test, $row->test_id, $add_info); ?>
						</div>
					</div>

                	<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Question</label>
                        
						<div class="col-sm-5">
							<textarea class="form-control" name="question"><?php echo $row->question;?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Option 1</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="option1" value="<?php echo $row->option1;?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Option 2</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="option2" value="<?php echo $row->option2;?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Option 3</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="option3" value="<?php echo $row->option3;?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Option 4</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="option4" value="<?php echo $row->option4;?>" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Answer</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="answer" value="<?php echo $row->answer;?>" >
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