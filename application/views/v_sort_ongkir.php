
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<title>Kota</title>
<!-- Le styles -->
<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
<style type="text/css">
body{
  margin-top: 50px;
}
</style>
</head>

<body>

	<div class="row">
		<div class="container">
			<div class="search">
	            <form id="ArticleIndexForm" method="get" action="<?php echo site_url('admin/orders/index'); ?>" accept-charset="utf-8">
	                <div class="input text"><input name="q" type="text" value="<?php echo $this->input->get('q'); ?>" id="ArticleQ" /></div>            
	                <button class="green_bt">Search</button>
	            </form>        
	        </div>
		</div>
	</div>
          

    <div class="container">                      
        <div class="col-sm-12">

        	<div class"row">
        		<select name="provinsi" id="id_prov" class="required">
					<option>-- SELECT PROVINSI --</option>
					<?php foreach($drop as $bk):?>
						<option value='<?php echo $bk->id?>'><?php echo $bk->value;?> </option>		
					<?php endforeach; ?>
				</select>
        	</div>
        
            <table class="table table-striped table-bordered">
            	<thead>
			        <tr>
			            <th>No</th>
			            <th>Kota</th>
			            <th>Provinsi</th>
			        </tr>
		        </thead>
		        <tbody id="retrive_kota">
                </tbody>
		        <tbody>
		        <?php if (isset($browse)): ?>
		        	<?php $no = 1;?>
		            <?php foreach ($browse->result() as $row): ?>
		                <tr>
		                    <td><?php echo $no; ?></td>
		                    <td><?php echo $row->name; ?></td>
		                    <td><?php echo $row->id_provinsi; ?></td>
		                </tr>
		            <?php $no++;?>    
		            <?php endforeach; ?>
		        <?php else: ?>
		            <tr>
		                <td colspan="3"><strong>There is no data</strong></td>
		            </tr>
		        </tbody>    
		        <?php endif; ?>
		    </table>

        </div> 
    </div>    


<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>

<script type="text/javascript">

	$("#id_prov").change(function(){
    var prov_id = {prov_id:$("#id_prov").val()};
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('sort_ongkir/get_kota');?>",
			data: prov_id, 
			success: function(resp){
                    $("#retrive_kota").html(resp);
			},
		});
	});	
</script>


</body>
</html>
