<?php 
session_start();
include "include/dbconfig.php";
if($_POST)
{
	$validator	  = array('success' => false, 'messages' => array());
	$userName  	  = trim(mysqli_real_escape_string($conn, $_POST['editUserName']));
	$userId   	  = trim($_POST['editUserId']);
	$franchiseName = trim($_POST['editName']);
	$memberId 	  = trim($_POST['editMemberId']);
	$password 	  = trim(mysqli_real_escape_string($conn, $_POST['editPassword']));
	$contact 	  = trim($_POST['editContact']);
	$address 	  = trim(mysqli_real_escape_string($conn,$_POST['editAddress']));

	
	$query		  = "Select * from `user_info` Where `user_name`='$userName' AND `user_id` NOT IN ('$userId')";
	$queryResult  = mysqli_query($conn, $query);
	
	if(mysqli_num_rows($queryResult) > 0){
		$validator['success']= false;
		$validator['messages']= "This user name is already taken";
	}else{
		$sql		= "UPDATE `user_info` SET `user_name`='$userName',`password`='$password'  WHERE `user_id`='$userId'";
		$franSql	= "UPDATE `franchises` SET `franchise_name`='$franchiseName', `address`='$address', `contact`='$contact'  WHERE `id`='$memberId'";
		
		$result_sql		  = mysqli_query($conn, $sql);
		$result_fran	  = mysqli_query($conn, $franSql);
		if($result_sql && $result_fran)
		{
			$validator['success']= true;
			$validator['messages']= "Successfully Updated";
		}
		else{
			$validator['success']= false;
			$validator['messages']= mysqli_error($conn);
		}
	}
	
	echo json_encode($validator);
}	

?>