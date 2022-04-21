<?php 
session_start();
include "include/dbconfig.php" ;
include "include/check-login.php" ;
include "include/no-cache.php" ;
$courseid=trim(isset($_POST['courseid']) ? $_POST['courseid'] : "");
$examid	 =trim(isset($_POST['examid']) ? $_POST['examid'] : "");
$year	 =trim(isset($_POST['year']) ? $_POST['year'] : "");
$month	 =trim(isset($_POST['month']) ? $_POST['month'] : "");
$ids	 = getExistStudents($examid);
$sql="
	SELECT pursuing_course.*,student_info.* FROM `pursuing_course` 
	INNER JOIN student_info
	ON student_info.Student_Id=pursuing_course.student_id
	WHERE pursuing_course.course_id='$courseid' AND pursuing_course.current_status='PURSUING' AND 
	pursuing_course.session_code='$year' AND pursuing_course.starting_month='$month' AND 
	pursuing_course.student_id NOT IN ($ids)
	";
	/* echo $sql; */
$option='';
$res=mysqli_query($conn,  $sql);
if(mysqli_num_rows($res) > 0)
{
	while($row=mysqli_fetch_assoc($res))
	{
		$option.='<option value="'.$row['Student_Id'].'">'.$row['regno']."-".$row['St_Name'].'</option>';
	}
	echo $option;
}
function getExistStudents($examid)
{
	include "include/dbconfig.php";
	$sql="SELECT * FROM `student_logininfo` WHERE `exm_id`='$examid'" ;
	$res=mysqli_query($conn,  $sql);
	$ids="";
	if(mysqli_num_rows($res) > 0)
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$ids.="'".$row['student_id']."',";
		}
		$ids=rtrim($ids,',');
		return $ids;
	}
	else{
		$ids="''";
		return $ids;
	}
}
?>