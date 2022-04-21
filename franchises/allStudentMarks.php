<?php 
session_start();
include "include/dbconfig.php";
$output = array('data' => array());
$data1=array();


 

$sql2="SELECT student_info.St_Name,pursuing_course.regno,courses.course_name,marks.obtained_marks as total_obtain_marks,marks.total_marks,marks.id FROM marks INNER JOIN marks_details ON marks_details.marks_id=marks.id INNER JOIN student_info ON student_info.slno=marks.student_id INNER JOIN pursuing_course ON pursuing_course.pusuing_id=marks.admission_id INNER JOIN courses ON courses.id=marks.course_id WHERE pursuing_course.franchise_id='{$_SESSION['franchise_id']}' GROUP BY marks.id";


	
	
$res=mysqli_query($conn, $sql2);
$x=1;


while($row=mysqli_fetch_assoc($res))
{
	 
	$sql3="select GROUP_CONCAT(subjects.subject) as subject,GROUP_CONCAT(marks_details.obtained_marks) as obtained_marks FROM marks_details INNER JOIN subjects ON subjects.id=marks_details.subject_id WHERE marks_details.marks_id='{$row['id']}'";
	$res2=mysqli_query($conn,$sql3);
	 
	while($row2=mysqli_fetch_assoc($res2))
	{
		$data1['sub'][]=$row2['subject']."<br>";
		$data1['marks'][]=$row2['obtained_marks']."<br>";	 
	}

	 
	 
	$subject_data=implode(" ",$data1['sub']);
	$marks_data=implode(" ",$data1['marks']);
	
	$output['data'][]=array
	(
		$x,
		$row['St_Name'],
		$row['regno'],
		$row['course_name'],
		$subject_data,
		$marks_data,
		$row['total_obtain_marks']
	);
	
	unset($data1);
	$x++;
}
echo json_encode($output);

 