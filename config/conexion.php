<?php
	$db = new mysqli("localhost","root","","tiendam");
	if (mysqli_connect_errno()) {
		echo "No se puede conectar 🚫";
	}
?>