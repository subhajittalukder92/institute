<?php 
include ("include/dbconfig.php");
$data= json_encode($_POST);
$arr=json_decode($data,true);
$sql="INSERT INTO `courses`( `course_id`,`course_name`, `description`, `duration`, `unit`, `course_fee`,eligibility) 
VALUES ('$arr[courseid]','$arr[coursename]','$arr[description]','$arr[cdescription]','$arr[unit]','$arr[fees]','{$arr['eligibility']}')";

$res=mysqli_query($conn,  $sql);
if($res)
{
	echo 1;
}
else{
	echo 0;
}
?>