<!DOCTYPE html> 
<html>
<head>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
	<script type="text/javascript">
		function get_kecamatan() {
			var id_kota = $("#kota").val();
			$.ajax({
				type: 'post',
				url: "<?php echo base_url('site/get_kecamatan'); ?>",
				data: "id_kota="+id_kota,
				success: function(msg) {
					$("#div_kecamatan").html(msg);
				}
			});
		}
	</script>

</head>
<body>
	<form name="aaa" id="aaa">
		<b>KOTA</b><br>
		<select name="kota" id="kota" onchange="get_kecamatan();">
			<option value=""></option>
			<?php
				foreach ($kota as $k) {
					echo "<option value='".$k->id_kota."'>".$k->nama_kota."</option>";
				}
			?>	
		</select>
		<br><br>
		<b>KECAMATAN</b>
		<div id="div_kecamatan">
			<select name="kecamatan" id="kecamatan"></select>
		</div>	
	</form>
</body>
</html>	