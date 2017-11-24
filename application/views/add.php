<!DOCTYPE html>
<html lang="en">
<head>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.1.js"></script>
	<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<?php if($this->session->flashdata('warning')) : ?>
	<h1><?php echo $this->session->flashdata('warning'); ?></h1>
	<?php endif; ?>
	<?php echo form_open_multipart('multi_upload/proses') ?>
		<div class="form-group">
		    <div class="copy">
		        <div class=" col-lg-3">
		           <a href="javascript:void(1);" class="glyphicon glyphicon-plus" id="add">Tambah</a>
		        </div>
		    </div>
		</div>
 		<div class="count" id="1"></div>
		<div class="form-group col-lg-12">
		    <div class="form-group col-lg-6">
		        <input class="form-control" type="file" name="image_1" required > 
		    </div>
		    <div class="paste" ></div>              
		</div> 
		<div class="form-group col-lg-5">
            <button type="submit" class="btn btn-default">Submit</button>
		</div>
	<?php echo form_close(); ?>

<script>
$(document).ready(function(){
    $( "#add" ).click(function() {
        var count = $('.count').attr('id');
            count = parseInt(count) + 1;
    $('.count').attr('id',count)
            var html   =  ' <div class="form-group col-lg-6">';
                html  +=   '<input class="form-control" type="file" name="image_'+count+'" >';
                html  += '</div>';
            $('.paste').append(html);
        });

})
</script>

</body>
</html>