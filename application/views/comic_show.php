<!DOCTYPE html>
<html>
<head>
	<title>Show</title>
	<!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Vue js -->
    <script src="<?php echo base_url();?>assets/vue.js"></script>
    <style type="text/css">
    	.gbr_komik {
    		display: block;
    		*width:1000px;
    		width: 100%;
    		height: auto;
    		margin: 20px 0;
    		border: 1px solid #ddd;
    	}
    	.gbr_komik img {
    		width: 100%;
    	}
    	.show {
    		display: block;
    	}
    	input {
    		width: 50px;
    		padding: 5px
    	}
    	
    	.no-float-center {
		    float: none;
		    margin: 0 auto;
		}
    </style>
</head>
<body>

<div class="container">
    <div id="wrapper">

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $judul;?>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row" id="vue-app">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables Advanced Tables
                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">
                        	<div class="col-sm-5 col-md-4 no-float-center">
	                        	<div class="tombol">
	                        		<button class="btn btn-primary" v-on:click="prev">Previous</button>
	                        		<input type="text" name="" v-bind:value="id">
	                        		<button class="btn btn-primary" v-on:click="next">Next</button>
	                        	</div>
	                        </div>    
                           <?php
								foreach ($numbers as $key => $value) {
									//echo $key .' = '. $value. '<br>';
									echo '<div class="gbr_komik" v-bind:class="{show : id == '.$value.'}" style="display:none;"><img class="img-responsive" id="gbr" src="'.base_url().'upload/komik/'.$folder.'/'.$value.'.jpg"></div>';
							?>		

							<?php
								}
							?>

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
	
<script>
new Vue({
	el: '#vue-app',
	data: {
		id: 00
	},
	methods: {
		next: function() {
			this.id++;
		},
		prev: function() {
			this.id--;
		},
	}
});	
</script>	

</body>
</html>