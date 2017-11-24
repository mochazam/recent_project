<html>
<head>
	<title>Pin it</title>
	<!-- Bootstrap -->
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/toastr.css">

    <!-- DataTables CSS -->
    <link href="<?php echo base_url();?>assets/css/dataTables.bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/dropPin/dropPin.css" type="text/css" />

<style type="text/css">

	.price {
		color: red;
		font-size: 25px;
		float: right;
	}

	.price-valuta {
		font-size: 12px;
		color: #000;
		position: absolute;
		top: 65px;
		left: 5px;
	}
	.harga {
		font-weight: 700;
	}

	.kecil {
		font-size: 16px;
		margin-top: -5px;
		right: 5px
	}

	.caption {
		background-color: #fff;
		box-shadow: 0 0 5px #ddd;
		border-radius: 10%;
		padding: 5px;
		opacity: 0.8;
		width: 140px;
        *width: 40%;
		*position: absolute;
		*top: 200px;
        *top: 60%;
		*right: 10px;
		*float: right !important;
		text-align: right;
        text-shadow: 1px 1px 1px rgba(255,255,255,1)
	}

	.caption strong {
        *box-shadow: 0 0 5px #fff;
        text-shadow: 1px 1px 1px rgba(255,255,255,1)
	}

    .discount, .gratis {
        background-color: #E74C3C;
        border-radius: 10%;
        padding: 5px;
        min-width: 4%;
        color: #fff;
        position: absolute;
        top: 20px;
        overflow: auto;
        text-align: center;
    }

    .disk_title {
        font-size: 30px;
        font-weight: 700
    }

    .free_title, .disk_rp {
        font-size: 20px;
        font-weight: 600
    }

    .discount .title_disk, .free_title {
        text-align: center;
        text-transform: uppercase;
        font-weight: 700
    }

    .percent {

    }

    #map2 {
    	background-size: 100%
    }

    .del {
        position: absolute;
        top: -10px;
        right: -5px;
        background-color: yellow;
        border-radius: 50%;
        width: 15px;
        height: 15px;
        color: #fff;
        text-align: center;
    }

    .del:hover {
        background-color: red;
    }

    .del a {
        color: #000;
        font-family: Helvetica, arial;
        font-size: 12px;
        font-weight: bold;
    }

    

    .price2 {
        color: red;
        font-size: 18px;
        float: left;
    }
    
    .price-valuta2 {
        font-size: 12px;
        color: #000;
        *position: absolute;
        top: 65px;
        left: 5px;
    }
    .harga {
        font-weight: 700;
    }

    .kecil2 {
        font-size: 12px;
        margin-top: -5px;
        right: 5px
    }

    .caption2 {
        position: inherit;
        top: 0;
        width: 100px;
        *right: 10px;
        text-align: left;
        text-shadow: 1px 1px 1px rgba(255,255,255,1)
    }

    .caption2 strong {
        *box-shadow: 0 0 5px #fff;
        text-shadow: 1px 1px 1px rgba(255,255,255,1);
        text-align: left;
        font-size: 12px;
    }

    .discount, .gratis {
        background-color: #E74C3C;
        border-radius: 10%;
        padding: 5px;
        min-width: 4%;
        color: #fff;
        position: absolute;
        top: 20px;
        overflow: auto;
        text-align: center;
    }

    .disk_title {
        font-size: 30px;
        font-weight: 700
    }

    .free_title, .disk_rp {
        font-size: 20px;
        font-weight: 600
    }

    .discount .title_disk, .free_title {
        text-align: center;
        text-transform: uppercase;
        font-weight: 700
    }

    .percent {

    }

    .del2 {
        background-color: red;
        border-radius: 50%;
        width: 15px;
        height: 15px;
        color: #fff;
        text-align: center;
    }

    .del2 a {
        position: relative;
        top: 0;
        color: #fff;
        font-size: 10px;
        line-height: 12px;
        padding-bottom: : 5px
    }

    #poli {
        position: relative;
        top: 0;
        width: auto;
        *min-width: 150px;
        padding: 10px;
        min-height: 60px;
        text-align: center;
        margin-left: 5px;
        display: inline-flex;
    }
	</style>
   

</head>
<body onload="viewdata()">
	<div class="container2">
		<div id="map2"></div>
		<hr>
		<pre id="result"></pre>
        <div id="hasil"></div>
	</div>	
	<!-- MODal -->

	<div id="mymodal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		    <div class="modal-content">
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		            <h4 class="modal-title" id="myModalLabel">Add New Tag</h4>
		        </div>
		        <div class="tagForm" id="tag-form">
		            <div class="modal-body">
		            	<input type="hidden" id="id_map" value="<?php echo $id_map;?>">
		                <label for="tagName">Title: </label>
		                <input id="title_name" class="form-control" type="text"/>

		                <label for="tagName">X axis: </label>
		                <input id="nodex" class="form-control" type="text"/>

		                <label for="tagName">Y axis: </label>
		                <input id="nodey" class="form-control" type="text"/>

		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                <button type="button" id="tag-form-submit" class="btn btn-primary" data-dismiss="modal">Add Pin</button>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
	</div>

	<div class="container">
    <div id="wrapper">

        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Pin
                  
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables Advanced Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<button class="btn btn-danger" id="delsel">Delete Selected</button>
                        	<hr>
                            <div class="table-responsive col-lg-12">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                        	<th style="text-align:center;width:45px;"><input type="checkbox" id="checkall"></th>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>ID</th>
                                            <th>X-axis</th>
                                            <th>Y-axis</th>
                                            <th>Date</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	
                                    </tbody>
                                </table>
                            </div>
                           
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

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.1.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.js"></script>
<script>
	


		function viewdata() {
	    	$.ajax({
	    		url: '<?php echo base_url().'pinit/getData'; ?>',
	    		type: 'POST',
	    		data: {id: <?php echo $id_map;?>},
	    		success: function(data) {
	    			showPins(data);
	    			$('#result').html(data);
	    		}
	    	});

            $.ajax({
                url: '<?php echo base_url().'pinit/getRightData'; ?>',
                type: 'POST',
                data: {id: <?php echo $id_map;?>},
                success: function(data) {
                    $('#hasil').html(data);
                }
            });

	    	$.ajax({
	    		url: '<?php echo base_url().'pinit/getAllData'; ?>',
	    		type: 'POST',
	    		data: {map_id:'<?php echo $this->uri->segment(3);?>'},
	    		success: function(data) {
	    			$('tbody').html(data)
	    		}
	    	})
	    };

	    $('#checkall').change(function() {
	    	$('.checkitem').prop("checked", $(this).prop("checked"))
	    })
	    
	    $('#delsel').click(function() {
	    	var id = $('.checkitem:checked').map(function() {
	    		return $(this).val()
	    	}).get().join(' ')
	    	
	    	$.ajax({
	    		url: '<?php echo base_url().'pinit/delAll'; ?>',
	    		data: {id: id},
	    		type: 'POST',
	    		success: function() {
	    			toastr.success('data berhasil didelete!');
	    			viewdata();
	    		},
	    		error: function() {
	    			toastr.error('data gagal didelete!');
	    		}
	    		
	    	})
	    	viewdata();
	    	
	    })		


		$('#map2').click(function(e) {
	        e.preventDefault();
	        $('#mymodal').modal();
	        $('#nodex').val(e.pageX);
	        $('#nodey').val(e.pageY);
	    });

		$('#tag-form-submit').on('click', function(e) {
		    e.preventDefault();
		    var dataSet = {id_map:$('#id_map').val(), title_name:$('#title_name').val(), nodex:$('#nodex').val(), nodey:$('#nodey').val()};
		    $.ajax({
		        type: "POST",
		        url: "<?php echo base_url().'pinit/addPin'; ?>",
		        data: dataSet,
		        success: function(response) {
		            viewdata();
		        },
		        error: function() {
		            alert('Error');
		        }
		    });
		    viewdata();
		});
		
		//var markers = $('#hasil').val();

		var defaults = {
			fixedHeight: 350,
			fixedWidth: 1265,
			dropPinPath: '/js/dropPin/',
			pin: '<?php echo base_url();?>assets/dropPin/defaultpin@2x.png',
			backgroundImage: '<?php echo base_url();?>maps/<?php echo $image_map;?>',
			backgroundColor: '#9999CC',
			xoffset : 10,
			yoffset : 30, //need to change this to work out icon heigh/width then subtract margin from it
			cursor: 'pointer',
			pinclass: 'qtipinfo',
			userevent: 'click',
			hiddenXid: '#xcoord', //used for saving to db via hidden form field
			hiddenYid: '#ycoord', //used for saving to db via hidden form field
			pinX: false, //set to value if you pass pin co-ords to overirde click binding to position
			pinY: false, //set to value if you pass pin co-ords to overirde click binding to position
			//pinDataSet: '' //array of pin coordinates for front end render
		}

		//alert(defaults.pinDataSet.length);

		function showPins(marker) {
			var markers = JSON.parse(marker);
			
			$('#map2').css({'cursor' : defaults.cursor, 'background-color' : defaults.backgroundColor , 'background-image' : "url('"+defaults.backgroundImage+"')",'height' : defaults.fixedHeight , 'width' : defaults.fixedWidth});
			
			for(var i=0; i < markers.length; i++)
			{
				var dataPin = markers[i];

				var imgC = $('<img rel="/map-content.php?id='+dataPin.id+'" class="pin '+defaults.pinclass+'" style="top:'+dataPin.yaxis+'px;left:'+dataPin.xaxis+'px;">');

				var divTag = $('<div class="caption grid-align-center" style="position: absolute;top:'+dataPin.yaxis+'px;left:'+dataPin.xaxis+'px;z-index:889;"><div class="del"><a href="<?php echo base_url().'pinit/dropPin/'; ?>'+dataPin.id+'">'+dataPin.id+'</a></div><strong>Nagellak Glamour</strong><div class="caption-small"><span class="caption-brand">Piggy Paint</span>in <span class="caption-category" data-behaviour="link-in-link" data-href="https://polkadots.be/nl/leuke-spulletjes">Leuke spulletjes</span></div><div class="no-float-center"><span class="price"><span class="price-valuta">Rp.</span><span itemprop="price" content="9.95" class="harga">350.<span class="kecil">000</span></span></span></div></div>');

				var spanC = $('<span style="position: absolute;top:'+dataPin.yaxis+'px;left:'+dataPin.xaxis+'px;background-color:#fff;z-index:888">'+dataPin.title+'</span>');
				


				imgC.attr('src',  defaults.pin);
				imgC.attr('title',  dataPin.title);

				imgC.appendTo($('#map2'));
				//spanC.appendTo($('#map2'));
				divTag.appendTo($('#map2'));
			}

		}

	
	
</script>

	<script src="<?php echo base_url();?>assets/js/toastr.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url();?>assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables/dataTables.bootstrap.js"></script>

    
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>

    <script type="text/javascript">
    function showAjaxModal(url)
    {
        // SHOWING AJAX loader-1 IMAGE
        jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="<?php echo base_url();?>assets/images/loader-1.gif" /></div>');
        
        // LOADING THE AJAX MODAL
        jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
        
        //alert(url);
        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function(response)
            {
                jQuery('#modal_ajax .modal-body').html(response);

            }
        });
    }
    </script>
    
    <!-- (Ajax Modal)-->
    <div class="modal fade" id="modal_ajax">
        <div class="modal-dialog" style="width: 50%;">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Maps</h4>
                </div>
                
                <div class="modal-body" style="height:400px; overflow:auto;">
                
                    
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    <script type="text/javascript">
    function confirm_modal(delete_url)
    {
        jQuery('#modal-4').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
    </script>
    
    <!-- (Normal Modal)-->
    <div class="modal fade" id="modal-4">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link">delete</a>
                    <button type="button" class="btn btn-info" data-dismiss="modal">cancel</button>
                </div>
            </div>
        </div>
    </div>

    
    <!-- SHOW TOASTR NOTIFIVATION -->
    <?php if ($this->session->flashdata('flash_message') != ""):?>

    <script type="text/javascript">
        toastr.success('<?php echo $this->session->flashdata("flash_message");?>');
    </script>

    <?php elseif ($this->session->flashdata('flash_message_error') != "") :?>

    <script type="text/javascript">
        toastr.error('<?php echo $this->session->flashdata("flash_message_error");?>');
    </script>

    <?php endif;?>

</body>
</html>