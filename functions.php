<?php

function checkYear($fromyear)
{
	include "include/dbconfig.php";
	$sql="SELECT MIN(`Session1`) AS minsession FROM student_info";
	$res=mysqli_query($conn,  $sql);
	$row=mysqli_fetch_assoc($res);
	if($fromyear < $row['minsession'])
	{
		return false;
	}
	else{
		return true;
	}
	
}
function sessionById($sessionId){
	include "include/dbconfig.php" ;
	$sql 	= "SELECT * FROM `session` WHERE `slno`='$sessionId'";
	$res 	= mysqli_query($conn,  $sql);
	$row 	= mysqli_fetch_assoc($res);	
	return $row;
}
function findCourseName($ID)
{
	include "include/dbconfig.php" ;
	$sql 		="SELECT * FROM `courses` WHERE `id`='$ID'";
	$res 		=mysqli_query($conn,  $sql);
	$row 		=mysqli_fetch_assoc($res);
	$courseinfo =$row['course_name']."-".$row['description'] ;
	return $courseinfo ;
}
function addToPaymentRecord($slno,$course,$paidamt,$payby,$chequeno,$date,$studentID)
{
	include "include/dbconfig.php" ;
	$sql = "INSERT INTO `payment`(`admission_slno`,`date`, `course_id`, `student_id`, `payment_type`,`payment_amt`, `payby`, `cheque_no`)
		   VALUES ('$slno','$date','$course','$studentID','ADMISSION','$paidamt','$payby','$chequeno')";
		 /*   ECHO $sql; */
	$res = mysqli_query($conn,  $sql);
	if($res)
	{
		return true;
	}
	else{
		return false;
	}
	
}
function addIncomeToDayBook($studentID,$fees,$course,$particulars,$date,$payby)
{
	include "include/dbconfig.php" ;
	$mode=null;
	if($payby == "CASH")
	{
	$sql  = "INSERT INTO `daybook` (`student_id`, `course_id`, `user_id`, `date`, `particulars`,
			`cash`,`to`, `type`) 
		    VALUES ('$studentID','$course','$_SESSION[userid]','$date','$particulars','$fees','CASH','INCOME')" ;
	}
	else{
		$mode = "BANK";
		$sql  = "INSERT INTO `daybook` (`student_id`, `course_id`, `user_id`, `date`, `particulars`,
			    `bank`, `to`, `type`) 
		        VALUES ('$studentID','$course','$_SESSION[userid]','$date','$particulars','$fees','BANK','INCOME')" ;
	}
	
	$res  = mysqli_query($conn,  $sql) ;
	return (isset($res) ? true : false);

}
function findStudentRegistraionNo($sessioncode,$coursecode)
{
	include "include/dbconfig.php" ;
	// $sql2="SELECT * FROM courses WHERE id='$coursecode'  ";
	// $res2=mysqli_query($conn,$sql2);
	// $row2=mysqli_fetch_assoc($res2);
	// $course_code=$row2['course_id'];


	$sql3="SELECT * FROM franchises WHERE id='{$_SESSION['franchise_id']}'  ";
	$res3=mysqli_query($conn,$sql3);
	$row3=mysqli_fetch_assoc($res3);
	$institutecode =$row3['code'];
		
	// $sql 		="SELECT MAX(`serial_no`) AS `slno` FROM `pursuing_course` WHERE `course_code`='$course_code' AND `session_code`='$sessioncode' AND franchise_id='{$_SESSION['franchise_id']}'";
	$sql 		= "SELECT COUNT(*) AS `slno` FROM `pursuing_course` WHERE `mode_of_insertion` = 'manual'";
	$res 		= mysqli_query($conn,  $sql);
	$row 		= mysqli_fetch_assoc($res);
	if($row['slno']!= null)
	{
		// $regno=$institutecode.$sessioncode.$course_code.sprintf('%0' . 4 . 's',($row['slno']+1));
		 $settings = getSettings();
		 $regno = "JYBCE-" . $institutecode . "-" . str_pad(($settings['base_regno'] + $row['slno'] + 1), 5, "0", STR_PAD_LEFT);
		 
		 
		return $regno;
	}
	else{
		// $regno=$institutecode.$sessioncode.$course_code."0001";

		$regno = "JYBCE-" . $institutecode . "-" . str_pad(($settings['base_regno'] + 1), 5, "0", STR_PAD_LEFT);
		return $regno;
	}
	
}
function getSettings()
{
	include "include/dbconfig.php" ;
	$sql 		= "SELECT * FROM `settings`";
	$res 		= mysqli_query($conn,  $sql);
	$arr=[];
	while($row = mysqli_fetch_assoc($res)){
		$arr[$row['setting_name']] = $row['value'] ;
	}
	return $arr;
}
function findSerialNo($sessioncode,$coursecode)
{
	include "include/dbconfig.php" ;
	$sql 		="SELECT MAX(`serial_no`) AS `slno` FROM `pursuing_course` WHERE `course_code`='$coursecode' AND `session_code`='$sessioncode'";
	$res 		=mysqli_query($conn,  $sql);
	$row 		=mysqli_fetch_assoc($res);
	if($row['slno']!=null)
	{
		
		return (sprintf('%0' . 4 . 's',($row['slno']+1)));
	}
	else{
		$slno=sprintf('%0' . 4 . 's',1);
		return $slno;
	}
}
function generateSessionCode($fromyear,$frommonth)
{
	include "include/dbconfig.php";

	$sql="SELECT * FROM `student_info` WHERE `Session1`='$fromyear'";
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		$query="SELECT * FROM `student_info` WHERE `Session1`='$fromyear' AND `session_month`='$frommonth'" ;
			$ress= mysqli_query($conn,  $query)      ;
		if(mysqli_num_rows($ress) > 0)
		{
			$row=mysqli_fetch_assoc($ress);
			return $row['session_code'];
		}
		else{
			$sql="SELECT * FROM `student_info` WHERE `Session1`='$fromyear' AND `session_month`< '$frommonth' ORDER BY `session_month` DESC LIMIT 1";
			/* echo $sql; */
			$res=mysqli_query($conn,  $sql);
			if(mysqli_num_rows($res) > 0)
			{
				/* echo "Hi"; */
				$row=mysqli_fetch_assoc($res);
				$difference= $frommonth - $row['session_month'];
				if($frommonth >= 1 && $frommonth <= 3)
				{	
					$no=strlen($row['session_code']);
					$zero=3;
					return sprintf('%0' . $zero. 's',1);
				}
				elseif($frommonth >= 4 && $frommonth <= 6)
				{
					/* echo "Hi"; */
					$value=($row['session_code'] + 1);
					$no=strlen($value);
					$zero=3;
					return sprintf('%0' . $zero . 's', 2);
					
				}
				elseif($frommonth >= 7 && $frommonth <= 9)
				{ 
					$value=($row['session_code'] + 2 );
					$no=strlen($value);
					$zero=4-$no;
					return sprintf('%0' . $zero . 's', 3);
				}
				elseif($frommonth >= 10 && $frommonth <= 12)
				{
					$value=($row['session_code'] + 3 );
					$no=strlen($value);
					$zero=3;
					return sprintf('%0' . $zero . 's', 4);

				}
			}
			else{
				/* echo "Hi";
				echo $frommonth ; */
			if($frommonth >= 1 && $frommonth <= 3)
			{
				
				
				$zero=3 ;
				return sprintf('%0' . $zero. 's',1);
				
			}
			elseif($frommonth >= 4 && $frommonth <= 6)
			{echo "Hi";
				$zero=3 ;
				return sprintf('%0' . $zero. 's',2);
				
			}
			elseif($frommonth >= 7 && $frommonth <= 9)
			{
				
				
				$zero=3;
				return sprintf('%0' . $zero. 's',3);
				
			}
			elseif($frommonth >= 10 && $frommonth <= 12)
			{
				$zero=3;
				return sprintf('%0' . $zero. 's',4);
				
			}
			}
		}
	}
	else{
		$sql="SELECT * FROM `student_info` WHERE `Session1`< '$fromyear' ORDER BY `Session1` DESC LIMIT 1";
		/* echo $sql; */
		$res=mysqli_query($conn,  $sql);
		if(mysqli_num_rows($res) > 0)
		{
			$row=mysqli_fetch_assoc($res);
			$dbYear=$row['Session1'];
			$yearDifference = $fromyear - $dbYear;
			$sessioncode=($yearDifference * 4)+1;
			$no=strlen($sessioncode);
			/* echo $no; */
			if($frommonth >= 1 && $frommonth <= 3)
			{
				$zero=3;
				return sprintf('%0' . $zero. 's',$sessioncode);

			}
			elseif($frommonth >= 4 && $frommonth <= 6)
			{
				$zero=3;
				return sprintf('%0' . $zero. 's',($sessioncode+1));

			}
			elseif($frommonth >= 7 && $frommonth <= 9)
			{
				$zero=3 ;
				return sprintf('%0' . $zero. 's',($sessioncode+2));

			}
			elseif($frommonth >= 10 && $frommonth <= 12)
			{
				$zero=3;
				return sprintf('%0' . $zero. 's',($sessioncode+3));
				
			}
		}
		else{
			$stat=checkYear($fromyear);
			if($stat)
			{
			if($frommonth >= 1 && $frommonth <= 3)
			{
				
				
				$zero=3;
				return sprintf('%0' . $zero. 's',1);
				
			}
			elseif($frommonth >= 4 && $frommonth <= 6)
			{
				
				
				$zero=3;
				return sprintf('%0' . $zero. 's',2);
				
			}
			elseif($frommonth >= 7 && $frommonth <= 9)
			{
				
				
				$zero=3;
				return sprintf('%0' . $zero. 's',3);
				
			}
			elseif($frommonth >= 10 && $frommonth <= 12)
			{
				$zero=3;
				return sprintf('%0' . $zero. 's',4);
				
			}
			}
			else{
				return "Invalid Session";
			}
		}
	}
}
function getCourses($id = Null)
{
	include "include/dbconfig.php" ;
	if(!empty($id)){
		$sql = "SELECT * FROM `courses` WHERE `id`='$id'";
	}else{
		$sql = "SELECT * FROM `courses`";
	}
	$result = mysqli_query($conn, $sql);
	$arr= ['success'=> false, 'records'=>[]];
	if(mysqli_num_rows($result) > 0){
		$arr['success'] = true;
		while($row = mysqli_fetch_assoc($result)){
			$arr['records'][] = $row;
		}
	}

	return json_encode($arr) ;

}
function getAllCourses($id = Null)
{
	include "include/dbconfig.php" ;
	if(!empty($id)){
		$sql = "SELECT * FROM `courses` WHERE `id`='$id'";
	}else{
		$sql = "SELECT * FROM `courses`";
	}
	$result = mysqli_query($conn, $sql);
	$arr= [];
	if(mysqli_num_rows($result) > 0){
		
		while($row = mysqli_fetch_assoc($result)){
			$arr[] = $row;
		}
		return count($arr) > 1 ? $arr : $arr[0] ;
	}



}

function getStudents($id = Null)
{
	include "include/dbconfig.php" ;
	if(!empty($id)){
		$sql = "SELECT * FROM `student_info` WHERE `slno`='$id'";
	}else{
		$sql = "SELECT * FROM `student_info`";
	}
	$result = mysqli_query($conn, $sql);
	$arr = [];
	if(mysqli_num_rows($result) > 0){
		
		while($row = mysqli_fetch_assoc($result)){
			$arr[] = $row;
		}
		return count($arr) > 1 ? $arr : $arr[0] ;
	}

	

}

function getMarkDetails($marksId)
{
	include "include/dbconfig.php" ;
	$sql = "SELECT * FROM `marks_details` WHERE `marks_id`='$marksId'";
	$ress = mysqli_query($conn, $sql);
	$arr= [] ;
	if(mysqli_num_rows($ress) > 0){
		while($row = mysqli_fetch_assoc($ress)){
			$arr[] = $row;
		}
		return $arr ;
	}

}
function getFranchises($id = Null)
{
	include "include/dbconfig.php" ;
	if(!empty($id)){
		$sql = "SELECT * FROM `franchises` WHERE `id`='$id'";
	}else{
		$sql = "SELECT * FROM `franchises`";
	}
	$result = mysqli_query($conn, $sql);
	$arr= ['success'=> false, 'records'=>[]];
	if(mysqli_num_rows($result) > 0){
		$arr['success'] = true;
		while($row = mysqli_fetch_assoc($result)){
			$arr['records'][] = $row;
		}
	}

	return json_encode($arr) ;

}
function calculateGrade($marks){
	include "include/dbconfig.php" ;
	$readCommand = "SELECT * FROM `grades`";
			   
	   $readStmt = mysqli_query($conn, $readCommand);
	   
	   $grade = null;
	   while ($row = mysqli_fetch_assoc($readStmt)) {
		if($marks <= $row['marks_upto']){
			$grade = $row['grade_name'];
			break;
		}
		   
	   } 			

	   return $grade;
}
function showFranchises($id = Null)
{
	include "include/dbconfig.php" ;
	if(!empty($id)){
		$sql = "SELECT * FROM `franchises` WHERE `id`='$id'";
	}else{
		$sql = "SELECT * FROM `franchises`";
	}
	$result = mysqli_query($conn, $sql);
	$arr= [];
	if(mysqli_num_rows($result) > 0){
	
		while($row = mysqli_fetch_assoc($result)){
			$arr[] = $row;
		}
	}

	return ($arr) ;

}
function getFranchisesById($id = Null)
{
	include "include/dbconfig.php" ;
	$sql = "SELECT * FROM `franchises` WHERE `id`='$id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);


	return $row ;

}
function getSubjects($id = Null)
{
	include "include/dbconfig.php" ;
	if(!empty($id)){
		$sql = "SELECT * FROM `subjects` WHERE `course_id`='$id'";
	}else{
		$sql = "SELECT * FROM `subjects`";
	}
	$result = mysqli_query($conn, $sql);
	$arr= ['success'=> false, 'records'=>[]];
	if(mysqli_num_rows($result) > 0){
		$arr['success'] = true;
		while($row = mysqli_fetch_assoc($result)){
			$arr['records'][] = $row;
		}
	}

	return json_encode($arr) ;

}
function getSubjectsById($id = Null)
{
	include "include/dbconfig.php" ;
	if(!empty($id)){
		$sql = "SELECT * FROM `subjects` WHERE `id`='$id'";
	}else{
		$sql = "SELECT * FROM `subjects`";
	}
	$result = mysqli_query($conn, $sql);
	$arr = [];
	if(mysqli_num_rows($result) > 0){
	
		while($row = mysqli_fetch_assoc($result)){
			$arr[] = $row;
		}
		return count($arr) > 1 ? $arr : $arr[0] ;
	}



}
function getAdmissionByRegno($regno)
{
	include "include/dbconfig.php" ;
	$sql = "SELECT * FROM `pursuing_course` WHERE `regno`='$regno'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	return $row ;

}
function getAdmissionById($id)
{
	include "include/dbconfig.php" ;
	$sql = "SELECT * FROM `pursuing_course` WHERE `pusuing_id`='$id'";
	
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	return $row ;

}

function getSubjectsByCourse($id = Null)
{
	include "include/dbconfig.php" ;
	if(!empty($id)){
		$sql = "SELECT * FROM `subjects` WHERE `course_id`='$id'";
	}else{
		$sql = "SELECT * FROM `subjects`";
	}
	$result = mysqli_query($conn, $sql);
	$arr = [];
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			$arr[] = $row;
		}
	}
	return $arr;
}
function getSessions($id = Null)
{
	include "include/dbconfig.php" ;
	$sql = "SELECT `session` FROM `pursuing_course` GROUP BY `session` ORDER BY `session` DESC";
	$result = mysqli_query($conn, $sql);
	$arr= ['success'=> false, 'records'=>[]];
	if(mysqli_num_rows($result) > 0){
		$arr['success'] = true;
		while($row = mysqli_fetch_assoc($result)){
			$arr['records'][] = $row['session'];
		}
	}

	return json_encode($arr) ;

}
function getTotalMarksByCourse($courseId){
	include "include/dbconfig.php" ;
	$sql = "SELECT * FROM `subjects` WHERE `course_id`='$courseId'";
	$result = mysqli_query($conn, $sql);
	$totalMarks = 0;
	if(mysqli_num_rows($result) > 0){
	
		while($row = mysqli_fetch_assoc($result)){
			extract($row) ;
			$totalMarks += $full_marks;
		}
	}
	return $totalMarks;

}

?>