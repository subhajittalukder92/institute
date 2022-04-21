<?php 
include "include/dbconfig.php";
include "include/no-cache.php";
$frommonth   = trim($_POST['frommonth']);
$fromyear    = trim($_POST['fromyear']);
$courseid    = trim($_POST['courseid']);
$coursecode  = sprintf('%0' . 3 . 's',$courseid);
$sessioncode =  generateSessionCode($fromyear,$frommonth);
$regno		 = findStudentRegistraionNo($sessioncode,$coursecode);
if($regno != "Invalid Session")
{
	echo $regno;
}
else{
	echo "Invalid Session";
}
function findStudentRegistraionNo($sessioncode,$coursecode)
{
	include 	"include/dbconfig.php" ;
	$sql 		="SELECT MAX(`serial_no`) AS `slno` FROM `pursuing_course` WHERE `course_code`='$coursecode' AND `session_code`='$sessioncode'";
	$res 		=mysqli_query($conn,  $sql);
	$row 		=mysqli_fetch_assoc($res);
	if($row['slno']!=null)
	{
		$regno=$sessioncode.$coursecode.sprintf('%0' . 4 . 's',($row['slno']+1));
		return $regno;
	}
	else{
		$regno=$sessioncode.$coursecode."0001";
		return $regno;
	}
	
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
			{/* echo "Hi"; */
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
?>