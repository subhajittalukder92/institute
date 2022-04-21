<?php 
session_start();
include "include/dbconfig.php";
$output = array('data' => array());

$sql="SELECT * FROM `notice`";
$res=mysqli_query($conn,  $sql);
$x=1;
while($row=mysqli_fetch_assoc($res))
{
	 $actionButton = '
    <div class="btn-group">
     <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     Action <span class="caret"></span>
     </button>
     <ul class="dropdown-menu">
     <li><a type="button" data-toggle="modal"  data-target="#editMemberModal" onclick="editMember('.$row['id'].')"> <span class="glyphicon glyphicon-edit"></span> Edit</a></li>
     <li><a type="button" data-toggle="modal"  data-target="#removeMemberModal" onclick="removeMember('.$row['id'].')"> <span class="glyphicon glyphicon-trash"></span> Remove</a></li>   
     </ul>
    </div>';
	if($row['status'] == "ACTIVE")
	{
	$label='<span class="label label-success">'.$row['status'].'</span>' ;
	}
	else{
	$label='<span class="label label-danger">'.$row['status'].'</span>' ;
	}
	$output['data'][]=array
	(
		$x,
		date('d/m/Y',strtotime($row['date'])),
		$row['notice'],
		$label,
		$actionButton
	);
	$x++;
}
echo json_encode($output); 

?>