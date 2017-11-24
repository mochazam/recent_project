<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Jquery Raty usage in PHP - Simple Star Ratting Plugin</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lib/jquery.raty.css">
</head>
<body>
<div>
    <!-- We use three products below and make DIVs with class star for showing stars -->
    <h3>Mobile</h3>
    <p>it a first product (444444)</p>
    <div id="444444" class="<?php echo $post_id ?>"></div>

    <h3>Laptop</h3>
    <p>it a second product (666666)</p>
    <div id="666666" class="<?php echo $post_id ?>"></div>

    <h3>Magazine</h3>
    <p>it a third product (777777)</p>
    <div id="777777" class="star"></div>

</div>

<div id="default"></div>
<!-- Jquery and Raty Js with scrpt having class star
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
<!--For Raty-->
<script type="text/javascript" src="<?php echo base_url() ?>assets/lib/jquery.raty.js"></script>

<script type="text/javascript">

    $(function() {
        //Below line will get stars images from img folder
        $.fn.raty.defaults.path = '<?php echo base_url() ?>assets/lib/images';
        //Below block code will post score and pid to raty1.php page where you will insert/update it into database. you can also change raty settings also from here. please read documentations
        $("#<?php echo $post_id ?>").raty({
            <?php if(isset($rates) && $rates != 0){ ?>
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
                alert($(this).prop('id') + score);
                alert(dataString);
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

    });
</script>
  
</body>
</html>