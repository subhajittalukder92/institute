<?php 
session_start();
include "include/dbconfig.php";
if($_POST)
{
	$validator	  = array('success' => false, 'messages' => array());
	$editPassword  = trim($_POST['editPassword']);
	$editName	    = trim($_POST['editName']);
	$editStatus     = trim($_POST['editStatus']);
	$slno 			= trim($_POST['memberId']);
	$sql		    = "UPDATE `examinfo` SET `exam_name`='$editName',`status`='$editStatus',`unlock_pass`='$editPassword'
						WHERE `id`='$slno'";
	/* echo $sql; */
	$result		  = mysqli_query($conn,  $sql);
	if($result)
	{
		$validator['success']= true;
		$validator['messages']= "Successfully Updated";
	}
	else{
		$validator['success']= false;
		$validator['messages']= "Update Failed !";
	}
	echo json_encode($validator);
}	

?>