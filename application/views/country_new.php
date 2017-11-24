<!DOCTYPE html>
<html>
<head>
    <title>Tag chose new</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/chosen/chosen.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/chosen/chosen.jquery.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery(".chosen").chosen();
    });
</script>

</head>
<body>

    <div class="block">
    <div class="title lightTextShadow"><?php echo $this->lang->line('category_create')? $this->lang->line('category_edit') : 'Create'; ?></div>
    <br/>

    <div class="content">
        <?php echo form_open_multipart('admin_country/create/') ?>
        <fieldset class="form boxStyle">

            <label for="category_name" class="label"><?php echo $this->lang->line('category_title')? $this->lang->line('category_title') : 'Kategori'; ?></label>
            <input id="category_name" class="textBox med rnd5" name="category_name"
                   value="<?= set_value('category_name') ?>"/>
            <?php echo form_error('category_name'); ?>

            <br/>
            <label class="label">الخدمات المرتبطة </label>
            <?= form_dropdown('service[]',$services,"", 'multiple="true" style="width:400px;" class="chosen chosen-select chosen-rtl" data-placeholder="قم باختيار الخدمة" id="service"'); ?>

            </br>

            <div class="center">

                <input id="submit" type="submit" value="insert" class="button sml inlineBlock rnd5 drkTextShadow"/>
            </div>
        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>


</body>
</html>


