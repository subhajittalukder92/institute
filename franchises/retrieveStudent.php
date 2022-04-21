<?php 
session_start();
include "include/dbconfig.php";
$output = array('data' => array());

$sql="SELECT student_info.*,pursuing_course.regno as reg_no  FROM `student_info` INNER JOIN pursuing_course ON pursuing_course.student_id=student_info.slno where student_info.franchise_id='{$_SESSION['franchise_id']}' ";
	
	
$res=mysqli_query($conn, $sql);
$x=1;


while($row=mysqli_fetch_assoc($res))
{
	$actionButton = '
    <button class="btn btn-sm btn-success" onclick="editMember('.$row['slno'].')"><span class="glyphicon glyphicon-edit"></span> Edit</button>

	<a class="btn btn-sm btn-primary" target="_blank" href="franchiseadmitionprint.php?studentid='.$row['slno'].'" ><span class="fa fa-print"></span> Print</a>
	 
    <!--<button class="btn btn-sm btn-primary" data-toggle="modal"  data-target="#removeMemberModal" onclick="removeMember('.$row['slno'].')"><span class="glyphicon glyphicon-trash"></span> Remove</button>-->
     
     ';
	 
	$output['data'][]=array
	(
		$x,
		$row['St_Name'],
		$row['Fathers_Name'],
		$row['DOB'],
		$row['Gender'],
        $row['Cust'],
        $row['DOA'],
        $row['reg_no'],
	/* 	$label, */
		$actionButton,
	);
	$x++;
}
echo json_encode($output);
