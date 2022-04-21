<?php

	include('include/dbconfig.php');

    $course_id=trim(mysqli_real_escape_string($conn,$_POST['course_id']));

	 $sql="SELECT * FROM subjects WHERE course_id='{$course_id}'";
	$res=mysqli_query($conn,$sql);
	$option='<option value="">--Select--</option>';

	if(mysqli_num_rows($res)>0)
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$option .= '<option value="' . $row['id'] . '">' . $row['subject'] .'</option>';
		}
		
	}

    echo json_encode($option);

?>