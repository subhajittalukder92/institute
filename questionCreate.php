<?php 
include "include/dbconfig.php";
$validator = array('success' => false, 'messages' => array());
if($_POST)
{
	$questn = trim($_POST['question']);
	$op_A   = trim($_POST['op_a']);
	$op_B   = trim($_POST['op_b']);
	$op_C   = trim($_POST['op_c']);
	$op_D	= trim($_POST['op_d']);
	$set_no	= trim($_POST['set_no']);
	$answer = trim($_POST['answer']);
	$examid	= trim($_POST['examid']);
	
	$sql="INSERT INTO `question_info`(`exam_id`,`set_no`,`questn`, `op_a`, `op_b`, `op_c`, `op_d`, `answer`)
		VALUES ('$examid','$set_no','$questn','$op_A','$op_B','$op_C','$op_D','$answer')";
	$res=mysqli_query($conn,  $sql) ;
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