<?php 
include "include/dbconfig.php";
$input		 =filter_input_array(INPUT_POST);
$address	 =mysqli_real_escape_string($conn,trim($input["address"]));
$po			 =mysqli_real_escape_string($conn,trim($input["po"]));
$ps			 =mysqli_real_escape_string($conn,trim($input["ps"]));
$pin		 =mysqli_real_escape_string($conn,trim($input["pin"]));
$district	 =mysqli_real_escape_string($conn,trim($input["district"]));
$id			 =$input["id"];

if($input["action"] === 'edit')
{
 $query ="UPDATE `adress` SET `address`='$address',`po`='$po',`pin`='$pin',
		`ps`='$ps',`district`='$district' WHERE  `id`='$id'
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
		$sql="DELETE FROM `adress` WHERE `id`='$id'";
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
echo json_encode($input);


?>