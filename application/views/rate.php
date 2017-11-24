<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
<title>Codeigniter Demos </title>
 
<link href="<?php echo base_url() ?>assets/rate/bootstrap.min.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/rate/jquery.min.js.download"></script>
<link href="<?php echo base_url() ?>assets/rate/starter-template.css" rel="stylesheet">
</head>
<body>

 
<div class="container">
 
<link rel="stylesheet" href="<?php echo base_url() ?>assets/rate/bootstrap.min(1).css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/rate/star-rating.css" media="all" type="text/css">
<script src="<?php echo base_url() ?>assets/rate/jquery.min.js(1).download"></script>
<script src="<?php echo base_url() ?>assets/rate/star-rating.js.download" type="text/javascript"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $('.rating').on('rating.change', function (event, value, caption) {
            var rate_id = $(this).prop('id');
            var pure_id = rate_id.substring(6);
            $.post('<?php echo base_url()."rate_star/create_rate";?>', {score: value, pid: pure_id},
                function (data) {
                    $('#' + rate_id).rating('refresh', {
                        showClear: false,
                        showCaption: false,
                        disabled: true
                    });
                });
            alert(value);
            console.log(pure_id);
        });
    });

</script>
<div class="starter-template">
        <h1>Bootstrap start Rating</h1>
        <img src="<?php echo base_url(); ?>assets/rate/<?= $news->ne_img; ?>"/>
        <span dir="ltr" class="inline">
        <input id="input-<?= $news->ne_id ?>" name="rating"
            <?php if ($news->nrt_total_rates > 0 or $news->nrt_total_points > 0) { ?>
                value="<?php echo $news->nrt_total_points / $news->nrt_total_rates ?>"
            <?php } else { ?>
                value="0"
            <?php } ?>
            <?php if ($this->session->userdata('uid') == false) { ?>
                data-disabled="false"
            <?php } else { ?>
                data-disabled="<?= $rated ?>"
            <?php } ?>
               class="rating "
               min="0" max="5" step="0.5" data-size="xs"
               accept="" data-symbol="&#xf005;" data-glyphicon="false"
               data-rating-class="rating-fa">
    </span>
        <!-- Jquery and Raty Js with scrpt having class star -->

        <a class="btn btn-danger" href="<?= base_url() ?>rate_star/clear_user_rating">Clear user rating</a>
    </div>
 

</body>
</html>