<?php 
include "include/dbconfig.php";
$validator = array('success' => false, 'messages' => array());
if($_POST)
{
	$description = trim($_POST['description']);
	$q_id		 = trim($_POST['q_id']);

	$sql="UPDATE `exam_rule` SET `particular`='$description' WHERE `slno`='$q_id'";
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