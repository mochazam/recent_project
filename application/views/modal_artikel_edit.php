<?php 
	$this->db->select('artikel.*, kategori.*, artikel.id as id_artikel');
    $this->db->from('artikel');
    $this->db->join('kategori', 'artikel.kategori_id = kategori.id');
    $this->db->where('artikel.id', $param2);
    $edit_data = $this->db->get();
	foreach ($edit_data->result() as $row):
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
            		Edit <?php echo $row->nama_artikel; ?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'artikel/go/edit/'. $row->id_artikel , array('class' => 'form-horizontal form-groups-bordered validate'));?>

                	<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Kategori</label>
                        
						<div class="col-sm-5">
							<?php
								$query = $this->db->get('kategori');
						        $kategori_artikel = array();
						        foreach ($query->result_array() as $rowi) {
						            $kategori_artikel[$rowi['id']] = $rowi['nama_kategori'];   
						        }
						        $add_info = 'class="form-control"';
							?>
							<?php echo form_dropdown('kategori_id', $kategori_artikel, $row->kategori_id, $add_info); ?>
						</div>
					</div>

                	<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Nama Artikel</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="nama_artikel" value="<?php echo $row->nama_artikel;?>" >
						</div>
					</div>
					

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Isi Artikel</label>
                        <div class="col-sm-8">
							<textarea id="form-field-8 editor1 mark" class="form-control" name="isi"><?php echo $row->body;?></textarea>
							<script>
							var simplemde = new SimpleMDE({ element: $("#mark")[0] });
							</script>
						</div>
						<!-- <div class="col-sm-8">
							<textarea id="form-field-8 editor1" class="form-control" name="isi"><?php echo $row->body;?></textarea>
							<script>
								CKEDITOR.replace( 'isi', {
									removePlugins: 'bidi,font,forms,flash,horizontalrule,iframe,justify,table,tabletools,smiley',
									removeButtons: 'Anchor,Underline,Strike,Subscript,Superscript,Image',
									format_tags: 'p;h1;h2;h3;pre;address'
								} );
							</script>
						</div> -->
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