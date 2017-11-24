<!DOCTYPE html>
<html>
<head>
    	<title><?php echo $title; ?></title>
      <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.1.js"></script>
  <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>Upload multiple files</h1>
    <?php echo form_open_multipart();?>
      <p>Upload file(s):</p>
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
            <input class="form-control" type="file" name="uploadedimages[]" multiple > 
        </div>
        <div class="paste" ></div>              
    </div> 
    <div class="form-group col-lg-5">
            <?php echo form_submit('submit','Upload');?>
    </div>
    <?php echo form_close();?>


<script>
$(document).ready(function(){
    $( "#add" ).click(function() {
        var count = $('.count').attr('id');
            count = parseInt(count) + 1;
    $('.count').attr('id',count)
            var html   =  ' <div class="form-group col-lg-6">';
                html  +=   '<input class="form-control" type="file" name="uploadedimages[]" multiple>';
                html  += '</div>';
            $('.paste').append(html);
        });

})
</script>
</body>
</html>