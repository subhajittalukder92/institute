<?php 

include   ('include/dbconfig.php');	
	$sql="SELECT MAX(`id`) AS id FROM `session`";
	$res=mysqli_query($conn,  $sql);
	$row=mysqli_fetch_assoc($res);
	if($row['id'] == "NULL")
	{
		echo "0001";
	}
	else
	{
		echo sprintf('%0' . 4 . 's', $row['id']+1);
	}
?>