<?php 
include "include/dbconfig.php" ;
include "include/no-cache.php" ;

if($_POST)
{
	$studentId = trim($_POST['studentId']) ;
	$sql="SELECT * FROM `student_info` WHERE `Student_Id`='$studentId'";
	$res=mysqli_query($conn,  $sql) ;
	$row=mysqli_fetch_assoc($res) ;
	echo json_encode($row);
	
}
?>