<?php 
session_start();
include('include/no-cache.php');
include('include/dbconfig.php'); 
include('include/check-login.php');
$studentid = trim(isset($_POST['studentid']) ? $_POST['studentid'] : "" ) ;
$sql="SELECT pursuing_course.*,courses.*
FROM `pursuing_course`
INNER JOIN courses ON pursuing_course.course_id = courses.id WHERE pursuing_course.current_status='PURSUING' AND 
pursuing_course.student_id='$studentid'";
 //echo $sql; 
$res=mysqli_query($conn,  $sql);
$option='<option value="">--Select--</option>';

while($row=mysqli_fetch_assoc($res))
{
	$option.='<option value="'.$row['id'].'">'.$row['course_name'].'</option>';
}
echo $option;




?>