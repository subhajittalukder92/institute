<?php 
include "include/dbconfig.php";
$validator = array('success' => false, 'messages' => array());
if($_POST)
{
	$password = trim($_POST['password']);
	$q_id	= trim($_POST['q_id']);

	$sql="UPDATE `student_logininfo` SET `password`='$password' WHERE `id`='$q_id'";
	/* echo $sql; */
	$res=mysqli_query($conn,  $sql) ;
	if($res)
	{
		$validator['success'] = true;
        $validator['messages'] = "Successfully Modified";
	}
	else{
		$validator['success'] = false;
        $validator['messages'] = "Process Failed";
	}
	
	echo json_encode($validator);
}

?>