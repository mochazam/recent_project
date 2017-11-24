<!DOCTYPE html>
<html lang="en">
<head>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.1.js"></script>
</head>
<body>
	<a href="<?php base_url() ?>multi_image/add" class="btn btn-default">Tambah</a><br>
	<div id="container">
    <!-- cek apakah $list ada datanya -->
	<?php if(is_array($list)) : ?>
      	<!-- jika ada di looping sebanyak data yang di database -->
        <?php foreach($list as $row) : ?>
            <?php
            if (isset($row['nama'])) { ?>
                <img src="<?php echo base_url() ?>asset/<?php echo $row['nama']; ?>" alt="Responsive image" class="img-rounded"  height="200" width="200">
            <?php }
            ?>
        <?php endforeach; ?>
    <?php endif; ?>
	</div>

</body>
</html>