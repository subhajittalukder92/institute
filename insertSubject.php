<?php 
include ("include/dbconfig.php");
$data= json_encode($_POST);
$arr=json_decode($data,true);
$sql="INSERT INTO `subjects`( `course_id`, `subject`, `semester_subjects`, `sem_order`, `full_marks`, `practical_marks`) 
VALUES ('$arr[course_id]', '$arr[subjectname]', '$arr[semSubjects]', '$arr[order]', '$arr[fullmarks]', '$arr[practicalFullmarks]')";

$res=mysqli_query($conn,  $sql);
if($res)
{
	echo 1;
}
else{
	echo 0;
}
?>