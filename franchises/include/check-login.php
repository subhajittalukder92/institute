<?php

	if(!isset($_SESSION['franchise_session_id']) && !isset($_SESSION['franchise_id'])){
		
		header("Location: signin.php");
	}
	
?>