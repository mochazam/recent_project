<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form action="<?php echo base_url().'settings/index';?>" method="post">
      <?php foreach($this->global_data as $key => $val):?>
      <div class="form-group">
          <label><?=$key?></label>
          <input type="text" name="config_item['<?=$key?>']'" class="form-control" value="<?=$val?>" />
      </div>
      <?php endforeach; ?>
      <button class="btn btn-success" type="submit">حفظ</button>
</form>

</body>
</html>