<?php 
session_start();
include('include/no-cache.php');
include ("include/dbconfig.php");
/* print_r($_POST); */
$data = json_encode($_POST);
$arr  = json_decode($data,true);

$sname			=strtoupper(trim($arr['sname']));
$fname			=strtoupper(trim($arr['fname']));
$mname			=strtoupper(trim($arr['mname']));
$address		=strtoupper(trim($arr['address']));
$po				=strtoupper(trim($arr['po']));
$ps				=strtoupper(trim($arr['ps']));
$district		=strtoupper(trim($arr['district']));
$gender			=strtoupper(trim($arr['gender']));
$dob			=strtoupper(trim($arr['dob']));
$nationality	=strtoupper(trim($arr['nationality']));
$mstatus		=strtoupper(trim($arr['mstatus']));
$religion		=strtoupper(trim($arr['religion']));
$caste			=strtoupper(trim($arr['caste']));
$pin			=strtoupper(trim($arr['pin']));
$contact		=strtoupper(trim($arr['contact']));
$aadhar			=strtoupper(trim($arr['aadhar']));
$occupation		=strtoupper(trim($arr['occupation']));
$foccupation	=strtoupper(trim($arr['foccupation']));
$session		=strtoupper(trim($arr['session']));
$qualification	=strtoupper(trim($arr['qualification']));
$course			=strtoupper(trim($arr['course']));
$fees			=strtoupper(trim($arr['fees']));
$date			=strtoupper(trim($arr['date']));
$paidamt		=strtoupper(trim($arr['paidamt']));
$regno1			=strtoupper(trim($arr['regno']));
$chequeno		=strtoupper(trim($arr['chequeno']));
$stid			=findMaxID($session);
$courseday		=json_encode($arr['courseday']);
$courseday		=json_decode($courseday,true);
$courseday		=implode(',',$courseday);
$payby			=strtoupper(trim($arr['payby']));
$frommonth		=trim($arr['frommonth']);
$tomonth		=trim($arr['tomonth']);
$toyear			=trim($arr['toyear']);
$sessioncode	=generateSessionCode($session,$frommonth);
$coursecode		=sprintf('%0' . 3 . 's', $course);
$serialno		=findSerialNo($sessioncode,$coursecode);
$regno2			=findStudentRegistraionNo($sessioncode,$coursecode);
$particulars	="ADMISSION TO ".findCourseName($course);
if($regno1==$regno2)
{
	$regno=$regno2;
}
else{
	$regno=$regno1;
}

/* */

	 
$sql    		= "INSERT INTO `student_info`(`Student_Id`, `St_Name`, `Fathers_Name`, `DOB`, `Gender`, `Cust`, `Religion`, 
				 `Mother_Trong`, `Session1`,`session_month`,`session_code`, `Roll`, `DOA`, `Mothers_Name`, `adminslno`, `Vill`, `Post`, `PS`, `Dist`, `Pin`, 
				 `Contact_no`,`mstatus`, `aadhar`, `qualification`, `regno`, `fathers_occupation`)
				  VALUES ('$stid','$sname','$fname','$dob','$gender','$caste','$religion','','$session','$frommonth','$sessioncode','',
				 '$date','$mname','','$address','$po','$ps','$district','$pin','$contact','$mstatus','$aadhar',
				 '$qualification','$regno','$foccupation')" ;

/* echo $sessioncode."-".$coursecode."-".$serialno; */
/* echo $sql; */
 $res =mysqli_query($conn,$sql);
$slno=mysqli_insert_id($conn);

if($res)
{
	if($payby=="CASH")
	{
		addIncomeToDayBook($stid,$fees,$course,$particulars,$date,$payby);
	}
	else{
		addIncomeToDayBook($stid,$fees,$course,$particulars,$date,$payby);
	}
	$pursuing_id = addStudentToPursuingTable($course,$stid,$session,$fees,$date,$sessioncode,$coursecode,$serialno,$courseday);
	addToPaymentRecord($slno,$course,$paidamt,$payby,$chequeno,$date,$stid);
	echo json_encode(
					array(
					'status'    => 1 ,
				    'studentID' =>$stid,
				    'regno'=>$regno,
					'slno'	    =>$slno
					  )
				    );
	
}
else{
		echo json_encode(
					array(
					'status'=> 0 ,
				   'studentID'=>'',
				   'regno'=>'',
				   'slno'=>$slno
				   )
				    ); 
}
 
function findMaxID($session)
{
	include "include/dbconfig.php" ;
	$studentID=null;
	if($session!="")
	{
		$sql="SELECT MAX(`Student_Id`) AS stid FROM `student_info` WHERE `Session1`='$session'";
		/* echo $sql; */
		$res = mysqli_query($conn,  $sql)	;
		$row = mysqli_fetch_assoc($res);
		if($row['stid'] == null)
		{
			$year		= (string)$session;
			$studentID  = $year."001";
			return $studentID;
		}
		else{
			$studentID	=$row['stid'] +1;
			return $studentID;
		}
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
function addStudentToPursuingTable($course,$studentID,$session,$fees,$date,$sessioncode,$coursecode,$serialno,$courseday)
{
	include "include/dbconfig.php" ;
		$data = json_encode($_POST);
/* ECHO  $data; */
	$arr  			= json_decode($data,true);
	$frommonth		= trim($arr['frommonth']);
	$tomonth		= trim($arr['tomonth']);
	$toyear			= trim($arr['toyear']);

	$sql="INSERT INTO `pursuing_course`(`session`,`date`,`student_id`, `course_id`,`course_code`, `session_code`, `serial_no`, `course_fee`, `course_days`
		 ,`starting_year`, `starting_month`, `complete_year`, `complete_month`)
		  VALUES ('$session','$date','$studentID','$course','$coursecode','$sessioncode','$serialno','$fees','$courseday','$session','$frommonth','$toyear','$tomonth')";
	$res=mysqli_query($conn,  $sql);
	$pursuing_id=mysqli_insert_id($conn);
	if($res)
	{
		return  $pursuing_id;
	}
	else{
		return false;
	}
	
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
function findStudentRegistraionNo($sessioncode,$coursecode)
{
	include "include/dbconfig.php" ;
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
function findCourseName($courseID)
{
	include "include/dbconfig.php" ;
	$sql 		="SELECT * FROM `courses` WHERE `course_id`='$courseID'";
	$res 		=mysqli_query($conn,  $sql);
	$row 		=mysqli_fetch_assoc($res);
	$courseinfo =$row['course_name']."-".$row['description'] ;
	return $courseinfo ;
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