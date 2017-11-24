<?php 
	$this->db->select('*');
    $this->db->from('komik');
    $this->db->where('com_id', 0);
    $edit_data = $this->db->get();
	foreach ($edit_data->result() as $row):
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
            		Edit <?php echo $row->nama_komik; ?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'comic/go/edit/'. $row->id , array('class' => 'form-horizontal form-groups-bordered validate'));?>

                	

                	<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Nama Komik</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="nama_artikel" value="<?php echo $row->nama_komik;?>" >
						</div>
					</div>
					

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Keterangan</label>
                        
						<div class="col-sm-8">
							<textarea id="form-field-8 editor1" class="form-control" name="keterangan"><?php echo $row->keterangan;?></textarea>
							<script>
								CKEDITOR.replace( 'keterangan', {
									removePlugins: 'bidi,font,forms,flash,horizontalrule,iframe,justify,table,tabletools,smiley',
									removeButtons: 'Anchor,Underline,Strike,Subscript,Superscript,Image',
									format_tags: 'p;h1;h2;h3;pre;address'
								} );
							</script>
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