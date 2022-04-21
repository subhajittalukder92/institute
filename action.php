<?php 
include "include/dbconfig.php";
$input		=filter_input_array(INPUT_POST);
$coursename = mysqli_real_escape_string($conn,trim($input["course_name"]));
$description =trim($input["description"]);
$duration	 =trim($input["duration"]);
$course_fee	 =trim($input["course_fee"]);
$fee_type	 =trim($input["fee_type"]);
/* Action Edit */
if($input["action"] === 'edit')
{
 $query = " UPDATE `courses` SET `course_name`='$coursename',
		   `description`='$description',`duration`='$duration',`course_fee`='$course_fee',
		   `fee_type`='$fee_type'
		    WHERE course_id = '".$input["course_id"]."'
		";
/* echo $query; */
$res= mysqli_query($conn,  $query);
if($res)
{
	$input['result']="success";

	
}

}
 if($input["action"] === 'delete')
{
	$s=checkCourse($input["course_id"]);
	
	if($s)
	{
		$sql="DELETE FROM `courses` WHERE `course_id`='".$input["course_id"]."'";
		/* echo $sql; */
		$res=mysqli_query($conn,  $sql);
		if($res)
		{
			$input['result']="success";
		}
		else{
			$input['result']="failed";
		}
	}
	else{
		$input['result']="invalid";
		
	}
		
}
	echo json_encode($input);
function checkCourse($courseid)
{
	include "include/dbconfig.php";
	$sql="SELECT * FROM `pursuing_course` WHERE `course_id`='$courseid'";
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		return false;
	}
	else{
		return true;
	}
}
?>