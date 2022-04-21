<?php 
session_start();
include "include/dbconfig.php";
$examid=trim($_POST['examid']);
$sql="SELECT * FROM `answer_record` WHERE `exam_id`='$examid' GROUP BY `regno`";
$res=mysqli_query($conn,  $sql);
if(mysqli_num_rows($res) > 0)
{
	$option='<option value="">--Select--</option>';
	while($row=mysqli_fetch_assoc($res))
	{
		$option.='<option value="'.$row['regno'].'">'.$row['regno'].'</option>';
	}
	echo $option;
}
else{
	$option='<option value="">--Select--</option>';
	echo $option;
	
}
?>