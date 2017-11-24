<!DOCTYPE html>
<html>
<head>
	<title>Codeigniter infinite scroll pagination</title>
	<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>
  	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  	<style type="text/css">
  		.ajax-load{
  			background: #e1e1e1;
		    padding: 10px 0px;
		    width: 100%;
  		}
  	</style>
</head>
<body>

<div class="container">
	<h2 class="text-center">Codeigniter infinite scroll pagination</h2>
	<br/>
	<div class="col-md-12" id="post-data">
		<?php
		  $this->load->view('data', $posts);
		?>
	</div>
</div>

<div class="ajax-load text-center" style="display:none">
	<p><img src="<?php echo base_url();?>assets/images/loader.gif">Loading More post</p>
</div>

<script type="text/javascript">
	var page = 1;
	$(window).scroll(function() {
	    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
	        page++;
	        loadMoreData(page);
	    }
	});

	function loadMoreData(page){
	  $.ajax(
	        {
	            url: '?page=' + page,
	            //url: "<?php echo base_url().'infinite_scroll'; ?>",
	            data: {page:page},
	            type: "GET",
	            beforeSend: function()
	            {
	                $('.ajax-load').show();
	            }
	        })
	        .done(function(data)
	        {
	            if(data == " "){
	                $('.ajax-load').html("No more records found");
	                return;
	            }
	            $('.ajax-load').hide();
	            $("#post-data").append(data);
	        })
	        .fail(function(jqXHR, ajaxOptions, thrownError)
	        {
	              alert('server not responding...');
	        });
	}
</script>

</body>
</html>