<?php 
 include "include/dbconfig.php" ;
 $validator = array('success' => false, 'messages' => array());
 if($_POST)
 {
	 $description = trim($_POST['description']);
	 $sessionCode = trim($_POST['sessionCode']);
	 $status 	  = trim($_POST['status']);
	 
	 $sql="INSERT INTO `session`(`id`,`description`, `session_code`, `status`)
	 VALUES ('$sessionCode','$description','$sessionCode','$status')" ;
	 $res=mysqli_query($conn,  $sql);

	if($res)
	{
		 $validator['success'] = true;
        $validator['messages'] = "Successfully Added";
	}
	else{
		$validator['success'] = false;
        $validator['messages'] = "Error while adding the member information";
	}
	
	echo json_encode($validator);

	
 }
?>