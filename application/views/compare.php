<?php 
	foreach ($absen->result() as $row) {
		echo $row->nim;
		echo "<br>";
	}
?>