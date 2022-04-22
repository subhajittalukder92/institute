<?php 
session_start();
include "include/dbconfig.php";
if($_POST)
{
	$validator	  = array('success' => false, 'messages' => array());
	$editName  = strtoupper(trim($_POST['editName']));
	$editUserId = trim($_POST['editUserId']);
	//$editType     = trim($_POST['editType']);
	$slno 			= trim($_POST['memberId']);
	if(checkDuplicate($slno, $editUserId))
	{
		$sql		    = "UPDATE `user_info` SET `name`='$editName',`user_name`='$editUserId'
		WHERE `user_id`='$slno'";
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
	}else{
		$validator['success']= false;
		$validator['messages']= "User name already taken !!";
	}
	
	
	echo json_encode($validator);
}	

function checkDuplicate($id, $editUserId)
{
	include "include/dbconfig.php";
	 $sql="SELECT * FROM `user_info` WHERE `user_name`='$editUserId' AND `user_id` NOT IN ('$id')";
	 $res=mysqli_query($conn,  $sql) ;
	 if(mysqli_num_rows($res) > 0)
	 {
		 return false;
	 }
	 else{
		 return true;
	 }
}

?>