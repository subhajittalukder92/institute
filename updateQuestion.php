<?php 
include "include/dbconfig.php";
$validator = array('success' => false, 'messages' => array());
if($_POST)
{
	$questn = trim($_POST['equestion']);
	$op_A   = trim($_POST['eop_a']);
	$op_B   = trim($_POST['eop_b']);
	$op_C   = trim($_POST['eop_c']);
	$op_D	= trim($_POST['eop_d']);
	$set_no	= trim($_POST['eset_no']);
	$answer = trim($_POST['eanswer']);
	$q_id	= trim($_POST['q_id']);
	$set_no = trim($_POST['eset_no']);
	$sql="UPDATE `question_info` SET `set_no`='$set_no',`questn`='$questn',`op_a`='$op_A ',`op_b`='$op_B ',
			`op_c`='$op_C ',`op_d`='$op_D ',`answer`='$answer' WHERE `id`='$q_id'";
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