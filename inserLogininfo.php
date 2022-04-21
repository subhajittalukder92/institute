<?php 
include "include/dbconfig.php";
$validator = array('success' => false, 'messages' => array());
if($_POST)
{
	foreach($_POST['studentid'] AS $key)
	{
		$regno=getRegno($key);
		$sql="INSERT INTO `student_logininfo`(`student_id`, `regno`, `exm_id`,`course_no`) 
			VALUES('$key','$regno','$_POST[examid]','$_POST[course]')";
		/* echo $sql."<br/>"; */
		$res = mysqli_query($conn,  $sql);
	}
	if($res)
	{
		$validator['success'] = true;
        $validator['messages'] = "Successfully Added";
	}
}
echo json_encode($validator);
function getRegno($key)
{
	include "include/dbconfig.php";
	$sql="SELECT * FROM student_info WHERE `Student_Id`='$key'";
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		$row=mysqli_fetch_assoc($res);
		return $row['regno']; 
	}
	else{
		return null;
	}
}
?>