<?php 
include "include/dbconfig.php";
$id=trim(isset($_POST['id']) ? $_POST['id'] : "") ;
$sql 		 ="SELECT * FROM `courses` WHERE `id`='$id'";
$res 		=mysqli_query($conn,  $sql);
if(mysqli_num_rows($res) > 0)
{
	$row = mysqli_fetch_assoc($res);
}
echo $row['course_fee']

?>

