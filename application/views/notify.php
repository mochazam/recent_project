<!DOCTYPE html>
<html>
<head>
	<title>Notification</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="" class="navbar-brand">Brand</a>
				</div>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown">
						<span class="label label-pill label-danger count"></span>
					</a>
					<ul class="droopdown-menu"></ul>
				</li>
			</ul>
		</nav>

		<div id="wrapper">

        
	        <div id="page-wrapper">
	            
	            <!-- /.row -->
	            <div class="row">
	                <div class="col-lg-12">
	                    <div class="panel panel-default">
	                        <div class="panel-heading">
	                            DataTables Advanced Tables
	                        </div>
	                        <!-- /.panel-heading -->
	                        <div class="panel-body">
	                           
	                           	<form class="form-horizontal" id="comment_form">
								  	<div class="form-group">
								    	<label for="inputEmail3" class="col-sm-2 control-label">Enter Subject</label>
								    	<div class="col-sm-10">
								      		<input type="text" class="form-control" id="subject" name="subject" placeholder="subject">
								    	</div>
								  	</div>
								  	<div class="form-group">
								    	<label for="inputPassword3" class="col-sm-2 control-label">Enter Comment</label>
								    	<div class="col-sm-10">
								      		<input type="text" class="form-control" id="comment" name="comment" placeholder="comment">
								    	</div>
								  	</div>
								  	
								  	<div class="form-group">
								    	<div class="col-sm-offset-2 col-sm-10">
								      		<button type="submit" class="btn btn-info" name="post" id="post">Post</button>
								    	</div>
								  	</div>
								</form>


	                           
	                        </div>
	                        <!-- /.panel-body -->
	                    </div>
	                    <!-- /.panel -->
	                </div>
	                <!-- /.col-lg-12 -->
	            </div>
	            
	            <!-- /.row -->
	        </div>
	        <!-- /#page-wrapper -->

	    </div>
	    <!-- /#wrapper -->

	</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery3.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
		function load_unseen_notification(view = '') {
			$.ajax({
				url: "<?php echo base_url().'notification/getNotif'; ?>",
				type: "POST",
				data: {view:'view'},
				dataType: "json",
				success: function(data) {
					$('.droopdown-menu').html(data.notification);
					if (data.unseen_notification > 0) {
						$('.count').html(data.unseen_notification);
					}
				}
			});	
		}

		load_unseen_notification();

		$('#comment_form').on('submit', function(event) {
			event.preventDefault();
			if ($('#subject').val() != '' && $('#comment').val != '') {
				var form_data = $(this).serialize();
				$.ajax({
					url:"<?php echo base_url().'notification/storeNotif'; ?>",
					type:"POST",
					data: form_data,
					success: function(data) {
						$('#comment_form')[0].reset();
						load_unseen_notification();
					}
				})
			} else {
				alert('Both field are Required');
			}
		});

		$(document).on('click', '.dropdown-toggle', function() {
			$('.count').html('');
			load_unseen_notification('yes');
		})		

		setInterval(function(){
			load_unseen_notification();
		}, 5000);
	});
</script>
</body>
</html>