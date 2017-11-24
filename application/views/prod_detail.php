<html>
<head>
	<title>Produk Detail</title>
	<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/jquery.raty.css">
	<style type="text/css">
	#default {
		color: red;
		font-style: italic;
		font-size: 14px;
		line-height: 16px;
		font-weight: bold;
	}
	span.label {
		font-size: 14px;
		line-height: 20px;
		margin-left: 10px;
	}
	</style>
</head>
<body>

<div class="container">
	<div class="row">
		<?php 
			foreach ($details->result() as $detail) {
		
		?>
		<div class="col-lg-6">
			<img src="<?php echo base_url();?>upload/puls/<?php echo $detail->image;?>">
		</div>
		<div class="col-lg-6">
			<div class="title">
				<h3><?php echo $detail->nama;?></h3>
			</div>
			<div id="<?php echo $detail->id ?>" class="<?php echo $detail->id ?>"></div>
			<div class="body">
				<?php echo $detail->body;?>
			</div>
		</div>
		<?php } ?>

		<div id="default"></div>
	</div>
</div>

<script src="<?php echo base_url();?>assets/js/jquery-1.11.0.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.js"></script>
<!--For Raty-->
<script type="text/javascript" src="<?php echo base_url() ?>assets/lib/jquery.raty.js"></script>

<script type="text/javascript">

    $(function() {
        //Below line will get stars images from img folder
        $.fn.raty.defaults.path = '<?php echo base_url() ?>assets/lib/images';

        //Below block code will post score and pid to raty1.php page where you will insert/update it into database. you can also change raty settings also from here. please read documentations
        $("#<?php echo $post_id ?>").raty({
            <?php if(isset($rates) and $rates != 0){ ?>
            start: <?php echo $rates ?>,
              <?php  } ?>
            <?php if($is_rated == true){ ?>
             readOnly:   true,
              <?php  } ?>
            half  : true,
            number: 5,
            score : <?php echo $rates ?>,
            click: function(score, evt) {
                var dataString = {pid:$(this).prop('id'), score:score};
                // alert($(this).prop('id') + score);
                // alert(dataString);
                $.ajax({
                    type: "POST",
                    //url: "<?php echo base_url().'rating/create_rate';?>",
                    url: "<?php echo base_url().'rating/create_rate';?>",
                    data: dataString, 
                    success: function(html){
                        //alert(html);
                        $('#default').html(html);
                        //return $.fn.raty.readOnly(true, '.<?php echo $post_id ?>');
                    }
                    
                })
                
            }


        });
        $("#<?php echo $post_id ?>").append('<span class="label label-success">( <?php echo $rates ?> / 10 )</span>');
    });
</script>

</body>
</html>