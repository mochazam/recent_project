<html>
<head>
	<title>search</title>

	 <style type="text/css">

    .price {
        color: red;
        font-size: 25px;
        float: left;
    }

    .price-valuta {
        font-size: 12px;
        color: #000;
        
    }
    .harga {
        font-weight: 700;
    }

    .kecil {
        font-size: 16px;
        margin-top: -5px;
        right: 5px
    }

    </style>
</head>
<body>

	<form method="post" action="<?php echo base_url();?>search/do_something">
		<input type="text" name="text_search">
		<button type="submit" >search</button>
	</form>

	<?php echo tag_price(250000); ?>

</body>
</html>