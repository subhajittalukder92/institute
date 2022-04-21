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
function findStudentRegistraionNo($sessionId,$courseId)
{
	include "include/dbconfig.php" ;

	$sql2="SELECT * FROM courses WHERE id='$courseId'  ";
	$res2=mysqli_query($conn,$sql2);
	$row2=mysqli_fetch_assoc($res2);
	$course_code=$row2['course_id'];


	$sql3="SELECT * FROM franchises WHERE id='{$_SESSION['franchise_id']}'  ";
	$res3=mysqli_query($conn,$sql3);
	$row3=mysqli_fetch_assoc($res3);
	$institutecode =$row3['code'];

	$sql4="SELECT * FROM session WHERE slno='$sessionId'  ";
	$res4=mysqli_query($conn,$sql4);
	$row4=mysqli_fetch_assoc($res4);
	$sessioncode =$row4['session_code'];
		
	$sql 		="SELECT MAX(`serial_no`) AS `slno` FROM `pursuing_course` WHERE `course_id`='$courseId' AND `session_id`='$sessionId' AND franchise_id='{$_SESSION['franchise_id']}'";
	$res 		=mysqli_query($conn,  $sql);
	$row 		=mysqli_fetch_assoc($res);
	if($row['slno']!=null)
	{
		$regno=$institutecode.$sessioncode.$course_code.sprintf('%0' . 4 . 's',($row['slno']+1));
		return $regno;
	}
	else{
		$regno=$institutecode.$sessioncode.$course_code."0001";
		return $regno;
	}
	
}
function findSerialNo($sessioncode,$coursecode)
{

	include "include/dbconfig.php" ;

	$sql2="SELECT * FROM courses WHERE id='$coursecode'";
	$res2=mysqli_query($conn,$sql2);
	$row2=mysqli_fetch_assoc($res2);
	$course_code=$row2['course_id'];

	$sql 		="SELECT MAX(`serial_no`) AS `slno` FROM `pursuing_course` WHERE `course_code`='$course_code' AND `session_code`='$sessioncode'";
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
