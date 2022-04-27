<?php 
//institude code,session code,curse code,max number
session_start();
include "include/dbconfig.php" ;
include "functions.php" ;
if($_POST)
{
	$id	=trim(mysqli_real_escape_string($conn,$_POST['course']));

	$sql2="SELECT * FROM courses WHERE id='$id'  ";
	$res2=mysqli_query($conn,$sql2);
	$row=mysqli_fetch_assoc($res2);
	$coursecode=$row['course_id'];
    $franchise = $_POST['franchise'] ;
	$sql3="SELECT * FROM franchises WHERE id='{$franchise}'  ";
	$res3=mysqli_query($conn,$sql3);
	$row3=mysqli_fetch_assoc($res3);
	$institutecode =$row3['code'];
		
	$sql 		= "SELECT COUNT(*) AS `slno` FROM `pursuing_course` WHERE `mode_of_insertion` = 'manual'";
	$res 		= mysqli_query($conn,  $sql);
	$row 		= mysqli_fetch_assoc($res);
	if($row['slno']!= null)
	{
		$settings = getSettings();
		$regno = "JYBCE-" . $institutecode . "-" . str_pad(($settings['base_regno'] + $row['slno'] + 1), 5, "0", STR_PAD_LEFT);
		
		echo $regno;
	}
	else{
		// $regno=$institutecode.$sessioncode.$course_code."0001";

		$regno = "JYBCE-" . $institutecode . "-" . str_pad(($settings['base_regno'] + 1), 5,"0", STR_PAD_LEFT);
		echo $regno;
	}
}

?>