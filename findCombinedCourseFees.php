<?php 
include "include/dbconfig.php";
$newcourseid=trim(isset($_POST['newcourseid']) ? $_POST['newcourseid'] : "") ;
$oldcourseid=trim(isset($_POST['oldcourseid']) ? $_POST['oldcourseid'] : "") ;

$sql 		 ="SELECT SUM(`course_fee`) AS FEES FROM `courses` WHERE `course_id` IN ('$newcourseid','$oldcourseid')";

$res 		=mysqli_query($conn,  $sql);
if(mysqli_num_rows($res) > 0)
{
	$row = mysqli_fetch_assoc($res);
	echo $row['FEES'] ;
}


?>

