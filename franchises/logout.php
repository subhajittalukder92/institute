<?php
	session_start();
	unset($_SESSION['franchise_id']);
	unset($_SESSION['franchise_name']);
	unset($_SESSION['franchise_userid']);
	unset($_SESSION['franchise_password']);
	unset($_SESSION['franchise_session_id']); 
	unset($_SESSION['login_type']);
	
	//header(location:'index.php');
	echo '<script>alert("Logout Successfully.");window.location.assign("signin.php");</script>';
?>