<?php 
session_start();
include "include/dbconfig.php" ;
include "include/check-login.php" ;
include "include/no-cache.php" ;
$courseid=trim(isset($_POST['courseid']) ? $_POST['courseid'] : "");

$sql="
	SELECT pursuing_course.*,student_info.* FROM `pursuing_course` 
	INNER JOIN student_info
	ON student_info.Student_Id=pursuing_course.student_id
	WHERE pursuing_course.course_id='$courseid' AND pursuing_course.current_status='PURSUING'
	";
	/* echo $sql; */
$option='';
$res=mysqli_query($conn,  $sql);
if(mysqli_num_rows($res) > 0)
{
	while($row=mysqli_fetch_assoc($res))
	{
		$option.='<option value="'.$row['Contact_no'].'">'.$row['regno']."-".$row['St_Name'].'</option>';
	}
	echo $option;
}

?>