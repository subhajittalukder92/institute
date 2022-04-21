<?php 
session_start();
include "include/dbconfig.php";
$output = array('data' => array());

$sql="SELECT `franchises`.*, `user_info`.*  FROM `franchises` 
	INNER JOIN `user_info` 
	ON `user_info`.`member_id` = `franchises`.id";
	
	
$res=mysqli_query($conn, $sql);
$x=1;

while($row=mysqli_fetch_assoc($res))
{
	 $actionButton = '
    <div class="btn-group">
     <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     Action <span class="caret"></span>
     </button>
     <ul class="dropdown-menu">
     <li><a type="button" data-toggle="modal"  data-target="#editMemberModal" onclick="editMember('.$row['user_id'].')"> <span class="glyphicon glyphicon-edit"></span> Edit</a></li>
     <!-- <li><a type="button" data-toggle="modal"  data-target="#removeMemberModal" onclick="removeMember('.$row['user_id'].')"> <span class="glyphicon glyphicon-trash"></span> Remove</a></li> -->   
     </ul>
    </div>';
	if($row['type'] == "Administrator" || $row['type'] == "Super Administrator")
	{
		$label='<span class="label label-success">'.$row['type'].'</span>' ;
	}
	else{
		$label='<span class="label label-default">'.$row['type'].'</span>' ;
	}
	$output['data'][]=array
	(
		$x,
		$row['franchise_name'],
		$row['contact'],
		$row['user_name'],
		$row['password'],
	/* 	$label, */
		$actionButton,
	);
	$x++;
}
echo json_encode($output); 

?>