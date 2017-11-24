<html>
<head>
	<title>Produk</title>
	<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css">

	<style type="text/css">
	.trick-card-inner {
	    position: relative;
	    margin-bottom: 20px;
	    /*
	     -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .15);
	     -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .15);
	     box-shadow: 0 1px 2px rgba(0, 0, 0, .15);
	     -webkit-border-radius: 4px;
	     -moz-border-radius: 4px;
	     border-radius: 4px;
	    */
	     background-color: #ffffff;
	     cursor: pointer
	 }
	 
	 .trick-card-inner:hover {
	     -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, .3);
	     -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, .3);
	     box-shadow: 0 1px 4px rgba(0, 0, 0, .3);
	     cursor: pointer
	 }

	 .trick-card-inner a {
	    text-decoration: none;
	 }
	 
	 .trick-card-inner .fa {
	     font-size: 14px;
	     margin-right: 5px
	 }
	 
	 .trick-card-inner:hover .fa,
	 .trick-card-inner:hover .trick-card-title,
	 .trick-card-title a:hover {
	     color: #FB503B
	 }

	.product-image img.gbr {
	  display: block;
	  max-width: 100%; }

	.product-image {
	  position: relative;
	  display: block;
	  overflow: hidden; }

	.product-image .front-image {
	  display: block;
	  width: auto;
	  height: auto; }

	.product-image .front-image img {
	  min-width: 99.9%;
	  max-width: 101% !important;
	  width: auto !important;
	  height: auto !important;
	  display: block; }
 
	 </style>
</head>
<body>

<div class="container">
	<div class="row">
		<?php 
			foreach ($products->result() as $product) {
		?>
			<div class="trick-card col-xs-12 col-sm-4 col-md-3 col-lg-3">
              	<div class="trick-card-inner">
                	<a href="<?php echo base_url();?>produk/detail/<?php echo $product->id;?>">
                      <div class="product-image">
                          <div class="front-image"><img src="<?php echo base_url();?>upload/puls/<?php echo $product->image;?>" class="gbr"></div>
                      </div>  
                  </a>
              	</div>
          	</div>
		<?php } ?>
	</div>
</div>

	<script src="<?php echo base_url();?>assets/js/jquery-1.11.0.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.js"></script>
</body>
</html>