<?php 
include "include/dbconfig.php";
$output = array('data' => array());
$examid = $_POST['examid'];
$sql="SELECT * FROM `question_info` WHERE `exam_id`='$examid'";
$res=mysqli_query($conn,  $sql);
$x=1;
while($row=mysqli_fetch_assoc($res))
{
	 $actionButton = '
    <div class="btn-group" tabindex="-1">
     <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-cog"></i>   Action <span class="caret"></span>
     </button>
     <ul class="dropdown-menu">
     <li><a type="button" data-toggle="modal"  data-target="#editMemberModal" onclick="editMember('.$row['id'].')"> <span class="glyphicon glyphicon-edit"></span> Edit</a></li>
     <li><a type="button" data-toggle="modal"  data-target="#removeMemberModal" onclick="removeMember('.$row['id'].')"> <span class="glyphicon glyphicon-trash"></span> Remove</a></li>   
     </ul>
    </div>';
	$output['data'][]=array
	(
		$x,
		$row['questn'],
		$row['op_a'],
		$row['op_b'],
		$row['op_c'],
		$row['op_d'],
		$row['answer'],
		$actionButton
	);
	$x++;
}
echo json_encode($output);
?>