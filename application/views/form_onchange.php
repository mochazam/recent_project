<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Onchange di Codeigniter</title>
</head>	 
<body>
	<h1>Onchange di Codeigniter dengan Jquery</h1>
	<hr />
	<form id="form1" name="form1" method="post" action="">
	  <p>
	    <label for="select_provinsi"></label>
	    <select name="select_provinsi" id="select_provinsi">
	    <option>--Pilih Provinsi--</option>
	    <!-- fungsi untuk menampilkan data pada select list-->
	    <?php foreach($provinsi as $row_provinsi) { ?>
	    <option value="<?php echo $row_provinsi->id_provinsi?>"><?php echo $row_provinsi->nama_provinsi?></option>
	    <?php } ?>
	    </select>
	  </p>
	   
	  <p>
	    <label for="select_kota"></label>
	    <select name="select_kota" id="select_kota" style="width:120px;">
	    	<option value="">Pilih Kota / Kabupaten</option>
	    <!-- fungsi untuk menampilkan data pada select list-->
	    <?php foreach($kota as $row_kota) { ?>
	    <option value="<?php echo $row_kota->id_kota?>" class="<?php echo $row_kota->id_provinsi; ?>"> <?php echo $row_kota->nama_kota?></option>
	    <?php } ?>
	    </select>
	  </p>

	  <p>
	    <label for="select_kecamatan"></label>
	    <select name="select_kecamatan" id="select_kecamatan" style="width:120px;">
	    	<option value="">Pilih Kecamatan</option>
	    <!-- fungsi untuk menampilkan data pada select list-->
	    <?php foreach($kecamatan as $row_kecamatan) { ?>
	    <option value="<?php echo $row_kecamatan->id_kecamatan?>" class="<?php echo $row_kecamatan->id_kota; ?>"> <?php echo $row_kecamatan->nama_kecamatan?></option>
	    <?php } ?>
	    </select>
	  </p>
	</form>
</body>
	 
	<!-- Memanggil file jquer -->
	  <script src="<?php echo base_url(); ?>assets/js/jquery-1.8.2.min.js"></script>
	  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.chained.min.js"></script>
	   
	  <!-- Fungsi javascript untuk onchange -->
	 <script type="text/javascript">
	     
	     $("#select_kota").chained("#select_provinsi"); <!-- parameter yang digunakan mesti sama dengan id select list-->

	     $("#select_kecamatan").chained("#select_kota"); <!-- parameter yang digunakan mesti sama dengan id select list-->
	  
	 /* Arti dari script diatas yaitu select list kota akan menampilkan data yang mempunyai id_provinsi
	    yang sama pada table kota dengan table provinsi
	 */  

	   </script>
	 
</html>

