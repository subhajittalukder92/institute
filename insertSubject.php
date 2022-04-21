<?php 
include ("include/dbconfig.php");
$data= json_encode($_POST);
$arr=json_decode($data,true);
$sql="INSERT INTO `subjects`( `course_id`,`subject`, `full_marks`) 
VALUES ('$arr[course_id]','$arr[subjectname]','$arr[fullmarks]')";

$res=mysqli_query($conn,  $sql);
if($res)
{
	echo 1;
}
else{
	echo 0;
}
?>