<?php 
session_start();
$examid=trim($_POST['examid']);
$pass=trim($_POST['pass']);
echo checkPassword($pass,$examid);
function checkPassword($password,$examid)
{
	include "../include/dbconfig.php";
	$sql="SELECT * FROM `examinfo` WHERE `id`='$examid' AND BINARY `unlock_pass`='$password'";
	/* echo $sql; */
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		return true;
	}
	else{
		return false;
	}
}
?>