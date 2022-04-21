<?php
	if(isset($_SESSION['user'])){
	}
	else{
		 header("Location: index.php");
	}

?>