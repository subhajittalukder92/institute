<?php 
include "include/dbconfig.php";
$validator = array('success' => false, 'messages' => array());
if($_POST)
{
	$sql="INSERT INTO `exam_rule`(`exam_id`, `particular`) VALUES ('$_POST[examid]','$_POST[desc]')";
		/* echo $sql."<br/>"; */
	$res = mysqli_query($conn,  $sql);
	if($res)
	{
		$validator['success'] = true;
        $validator['messages'] = "Successfully Added";
	}
}
echo json_encode($validator);

?>