<?php 
//institude code,session code,curse code,max number
session_start();
	include "include/dbconfig.php" ;
	if($_POST)
	{
		$id	=trim(mysqli_real_escape_string($conn,$_POST['course']));

		$sql2="SELECT * FROM courses WHERE id='$id'  ";
		$res2=mysqli_query($conn,$sql2);
		$row=mysqli_fetch_assoc($res2);
		$coursecode=$row['course_id'];

		$sql3="SELECT * FROM franchises WHERE id='{$_SESSION['franchise_id']}'  ";
		$res3=mysqli_query($conn,$sql3);
		$row3=mysqli_fetch_assoc($res3);
		$institutecode =$row3['code'];
		
		$sessioncode	=trim($_POST['sessionCode']);
		
		$sql 		="SELECT MAX(`serial_no`) AS `slno` FROM `pursuing_course` WHERE `course_code`='{$coursecode}' AND `session_code`='$sessioncode' AND franchise_id='{$_SESSION['franchise_id']}'  ";
		$res 		=mysqli_query($conn,  $sql);
		$row 		=mysqli_fetch_assoc($res);
		if($row['slno']!=null)
		{
			$regno=$institutecode."-".$sessioncode."-".$coursecode."-".sprintf('%0' . 4 . 's',($row['slno']+1));
			echo $regno;
		}
		else{
			$regno=$institutecode.$sessioncode.$coursecode."0001";
			echo $regno;
		}
	}

?>