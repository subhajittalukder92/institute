<?php
	session_start();
	unset($_SESSION['admin_userid']);
	echo '<script>alert("Logout Successfully.");window.location.assign("index.php");</script>';
?>