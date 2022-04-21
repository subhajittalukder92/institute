<?php 
	include "include/dbconfig.php";
	$session=trim($_POST['session']);
	$studentID=null;
	
	if($session!="")
	{
		$sql="SELECT MAX(`Student_Id`) AS stid FROM `student_info` WHERE `Session1`='$session'";
	
		
		/* echo $sql; */
		$res = mysqli_query($conn,  $sql)	;
		$row = mysqli_fetch_assoc($res);
		if($row['stid']==null)
		{
			$year		= (string)$session;
			$studentID  = $year."001";
			echo $studentID;
		}
		else{
			$studentID	=$row['stid'] +1;
			echo $studentID;
		}
		
	
				
	}
	

?>