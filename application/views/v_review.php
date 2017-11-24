<!DOCTYPE html>
<html>
<head>
	<title>Review</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">

</head>
<body>

<div class="container">
    <div class="row">
    	<div class="col-md-6">
	    	<div class="form-group">
		        <label for="">Your Name:</label>
		        <input type="text" name="username" id="username" value=""  class="form-control" />
		    </div> 
		    <div class="form-group">
		        <label for="">Email:</label>
		        <input type="email" name="email" id="email" value=""  class="form-control" />
		    </div>  
		    <div class="form-group">
		        <label>Your Review:</label>
		        <textarea name="isi_komentar" id="isi_komentar" cols="40" rows="8" class="form-control"></textarea>
		        <span style="font-size: 11px;"><span style="color: #FF0000;">Note:</span> HTML is not translated!</span><br />
		    </div>  
		      
		    <div class="form-group">
		        <label>Rating:</label> <span>Bad</span>&nbsp;
		        <input type="radio" name="rating" id="rating" value="1" />
		        &nbsp;
		        <input type="radio" name="rating" id="rating" value="2" />
		        &nbsp;
		        <input type="radio" name="rating" id="rating" value="3" />
		        &nbsp;
		        <input type="radio" name="rating" id="rating" value="4" />
		        &nbsp;
		        <input type="radio" name="rating" id="rating" value="5" />
		        &nbsp;<span>Good</span><br />
		    </div>  

		    <div class="form-group">
		        <label>Pilih:</label>
		        <input type="checkbox" name="pilih" id="pilih" value="1" />
		        &nbsp;
		        <input type="checkbox" name="pilih" id="pilih" value="2" />
		        &nbsp;
		        <input type="checkbox" name="pilih" id="pilih" value="3" />
		        &nbsp;
		        <input type="checkbox" name="pilih" id="pilih" value="4" />
		        &nbsp;
		        <input type="checkbox" name="pilih" id="pilih" value="5" />
		        &nbsp;<br />
		    </div>
		    
		    <div class="buttons">
		        <button type="submit" id="btn-news" class="btn btn-primary">submit</button>
		    </div>
		</div>    
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#btn-news').on('click', function() {
        var name = $("#username").val();
        var emailer = $("#email").val();
        var komentar = $("#isi_komentar").val();
        var option = $('input[type="radio"]:checked').val();
        var pilihan = $('input[type="checkbox"]:checked').val();
          $.ajax({
              type: "POST",
              url: "<?php echo site_url('review/comment');?>",
              dataType: "json",
              data: {username:name, email:emailer, isi_komentar:komentar, rating:option},
              success: function(data){
                    alert(data);
              },
              error: function(){
                alert(pilihan+name+emailer+komentar+option);
              }
          });
    });
});       
</script>

</body>
</html>    