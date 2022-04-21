<?php 
session_start();
include "include/dbconfig.php";
if($_POST)
{
	$validator	  = array('success' => false, 'messages' => array());
	$editSession  = trim($_POST['editSession']);
	$editDescription = trim($_POST['editDescription']);
	$editStatus     = trim($_POST['editStatus']);
	$slno 			= trim($_POST['memberId']);
	$sql		    = "UPDATE `session` SET `description`='$editDescription',`session_code`='$editSession',
						`status`='$editStatus'  WHERE `slno`='$slno'";
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