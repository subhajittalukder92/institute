<?php 
include "include/dbconfig.php";
include "include/no-cache.php";
$frommonth=trim($_POST['frommonth']);
$fromyear=trim($_POST['fromyear']);
$sql="SELECT * FROM `student_info` WHERE `Session1`='$fromyear'";
$res=mysqli_query($conn,  $sql);
if(mysqli_num_rows($res) > 0)
{
	$query="SELECT * FROM `student_info` WHERE `Session1`='$fromyear' AND `session_month`='$frommonth'" ;
		$ress= mysqli_query($conn,  $query)      ;
	if(mysqli_num_rows($ress) > 0)
	{
		$row=mysqli_fetch_assoc($ress);
		echo $row['session_code'];
	}
	else{
		$sql="SELECT * FROM `student_info` WHERE `Session1`='$fromyear' AND `session_month`< '$frommonth' ORDER BY `session_month` DESC LIMIT 1";
		$res=mysqli_query($conn,  $sql);
		$row=mysqli_fetch_assoc($res);
		$difference= $frommonth - $row['session_month'];
		if($difference >= 1 && $difference < 3)
		{
			$no=strlen($row['session_code']);
			$zero=3-$no;
			if($zero==2)
			{
				sprintf('%0' . $zero. 's', $row['session_code']);
			}
			elseif($zero==1)
			{
				echo "0".($row['session_code']);
			}
			else{
				echo ($row['session_code']);
			}
		}
		elseif($difference >= 3 && $difference < 6)
		{
			//;
			//$zero=6-$no;
			$value=($row['session_code'] + 1);
			$no=strlen($value);
			$zero=4-$no;
			if($zero==2)
			{
				echo sprintf('%0' . $zero . 's', $value);
			}
			elseif($zero==1)
			{
				echo sprintf('%0' . $zero . 's', $value);
			}
			else{
				echo sprintf('%0' . $zero . 's', $value);
			}
		}
		elseif($difference >= 6 && $difference < 9)
		{
			$value=($row['session_code'] + 2 );
			$no=strlen($value);
			$zero=4-$no;
			
			if($zero==2)
			{
				echo sprintf('%0' . $zero . 's', $value);
			}
			elseif($zero==1)
			{
				echo sprintf('%0' . $zero . 's', $value);
			}
			else{
				echo sprintf('%0' . $zero . 's', $value);
			}
		}
		elseif($difference >= 9 && $difference < 12)
		{
			$value=($row['session_code'] + 3 );
			$no=strlen($value);
			$zero=4-$no;
			
			if($zero==2)
			{
				echo sprintf('%0' . $zero . 's', $value);
			}
			elseif($zero==1)
			{
				echo sprintf('%0' . $zero . 's', $value);
			}
			else{
				echo sprintf('%0' . $zero . 's', $value);
			}
		}
	}
}
else{
	$sql="SELECT * FROM `student_info` WHERE `Session1`<'$fromyear' ORDER BY `Session1` DESC LIMIT 1";
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		$row=mysqli_fetch_assoc($res);
		$dbYear=$row['Session1'];
		$yearDifference = $fromyear - $dbYear;
	}
	else{
		
	}
}
?>