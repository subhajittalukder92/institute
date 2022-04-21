<?php 
include "include/dbconfig.php";
$output = array('data' => array());
$examid = $_POST['examid'];
$courseid = $_POST['courseid'];
$session=$_POST['year'];
$month=$_POST['month'];
$sql="SELECT * FROM `student_logininfo` 
	  INNER JOIN examinfo
	  ON  student_logininfo.exm_id=examinfo.id
	  INNER JOIN pursuing_course
	  ON pursuing_course.student_id = student_logininfo.student_id
	  WHERE student_logininfo.`exm_id`='$examid' AND student_logininfo.`course_no`='$courseid'
	  AND pursuing_course.`session_code`='$session' AND pursuing_course.`starting_month`='$month'";
	/* echo $sql; */
$res=mysqli_query($conn,  $sql);
$x=1;
while($row=mysqli_fetch_array($res))
{
	 $actionButton = '
    <div class="btn-group" tabindex="-1">
     <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-cog"></i>   Action <span class="caret"></span>
     </button>
     <ul class="dropdown-menu">
     <li><a type="button" data-toggle="modal"  data-target="#editMemberModal" onclick="editMember('.$row[0].')"> <span class="glyphicon glyphicon-edit"></span> Edit</a></li>
     <li><a type="button" data-toggle="modal"  data-target="#removeMemberModal" onclick="removeMember('.$row[0].')"> <span class="glyphicon glyphicon-trash"></span> Remove</a></li>   
     </ul>
    </div>';
	$output['data'][]=array
	(
		$x,
		$row[7],
		$row[2],
		$row[5],
		$actionButton
	);
	$x++;
}
echo json_encode($output);
?>