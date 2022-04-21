<?php 
session_start();
include "include/dbconfig.php";
if($_POST)
{
	$validator	    = array('success' => false, 'messages' => array());
	$editDate 		= trim($_POST['editDate']);
	$editDescription = trim($_POST['editDescription']);
	$editStatus     = trim($_POST['editStatus']);
	$slno 			= trim($_POST['memberId']);
	
	
	
		$sql		    = "UPDATE `notice` SET `notice`='$editDescription',`date`='$editDate',
						`status`='$editStatus'  WHERE `id`='$slno'";
	
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