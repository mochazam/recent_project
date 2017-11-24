<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>maps</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css">

</head>

<body>
	
<div class="container">
	<div class="row hide-for-small-only">
	    <div class="large-14 columns">
	      <ul class="breadcrumb">
	          <li>
	              <a href="<?php echo base_url(); ?>" class="homepage-link" title="">Home</a>
	          </li>
	          <?php foreach ($breadcrumbs as $breadcrumb) : ?>
	            <?php if(isset($breadcrumb['href'])) : ?>
	              <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
	            <?php else : ?>
	              <li><?php echo $breadcrumb['text']; ?></li> 
	            <?php endif; ?>   
	          <?php endforeach; ?>
	        </ul>
	    </div>
	</div>  
</div>


</body>
</html>