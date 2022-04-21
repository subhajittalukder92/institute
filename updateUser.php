<?php 
session_start();
include "include/dbconfig.php";
if($_POST)
{
	$validator	  = array('success' => false, 'messages' => array());
	$editName  = strtoupper(trim($_POST['editName']));
	$editUserId = trim($_POST['editUserId']);
	$editType     = trim($_POST['editType']);
	$slno 			= trim($_POST['memberId']);
	$sql		    = "UPDATE `user_info` SET `name`='$editName',`user_name`='$editUserId',
						`type`='$editType'  WHERE `user_id`='$slno'";
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