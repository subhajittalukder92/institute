<?php
	session_start();
	session_destroy();
	//header(location:'index.php');
	echo '<script>alert("Logout Successfully.");window.location.assign("index.php");</script>';
?>