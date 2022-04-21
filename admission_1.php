<?php 
session_start();
include('include/no-cache.php');
include ("include/dbconfig.php");
$data = json_encode($_POST);
/* ECHO  $data; */
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
$regno			=strtoupper(trim($arr['regno']));
$chequeno		=strtoupper(trim($arr['chequeno']));
$stid			=findMaxID($session);
$courseday		=json_encode($arr['courseday']);
$courseday		=json_decode($courseday,true);
$courseday		=implode(',',$courseday);
$payby			=strtoupper(trim($arr['payby']));
$particulars	="ADMISSION TO ".findCourseName($course);
$sql    		= "INSERT INTO `student_info`(`Student_Id`, `St_Name`, `Fathers_Name`, `DOB`, `Gender`, `Cust`, `Religion`, 
				 `Mother_Trong`, `Session1`, `Roll`, `DOA`, `Mothers_Name`, `adminslno`, `Vill`, `Post`, `PS`, `Dist`, `Pin`, 
				 `Contact_no`,`mstatus`, `aadhar`, `qualification`, `regno`, `fathers_occupation`)
				  VALUES ('$stid','$sname','$fname','$dob','$gender','$caste','$religion','','$session','',
				  '$date','$mname','','$address','$po','$ps','$district','$pin','$contact','$mstatus','$aadhar',
				  '$qualification','$regno','$foccupation')" ;

/* echo $sql; */
$res =mysqli_query($conn,  $sql);
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
	$pursuing_id = addStudentToPursuingTable($course,$stid,$fees,$date,$courseday);
	addToPaymentRecord($course,$paidamt,$payby,$chequeno,$date,$stid);
	echo json_encode(
					array(
					'status'    => 1 ,
				    'studentID' =>$stid,
				    'regno	   '=>$regno,
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
		if($row['stid']==null)
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
function addStudentToPursuingTable($course,$studentID,$fees,$date,$courseday)
{
	include "include/dbconfig.php" ;
	$sql="INSERT INTO `pursuing_course`(`date`, `student_id`, `course_id`, `course_fee`, `course_days`)
		  VALUES ('$date','$studentID','$course','$fees','$courseday')";
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
function addToPaymentRecord($course,$paidamt,$payby,$chequeno,$date,$studentID)
{
	include "include/dbconfig.php" ;
	$sql = "INSERT INTO `payment`(`date`, `course_id`, `student_id`, `payment_amt`, `payby`, `cheque_no`)
		   VALUES ('$date','$course','$studentID','$paidamt','$payby','$chequeno')";
	$res = mysqli_query($conn,  $sql);
	if($res)
	{
		return true;
	}
	else{
		return false;
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

?>