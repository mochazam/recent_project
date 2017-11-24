<?php
foreach ($prev_data->result() as $row) {
	echo "Previous data : ".$row->propinsi. ", ID : ".$row->propinsi_id;
}

echo "<br>";

foreach ($query->result() as $row) {
	echo "Current data : ".$row->propinsi. ", ID : ".$row->propinsi_id;
}

echo "<br>";

foreach ($next_data->result() as $row) {
	echo "Next data : ".$row->propinsi. ", ID : ".$row->propinsi_id;
}
?>