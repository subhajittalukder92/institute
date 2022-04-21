<?php 
session_start();
include('include/no-cache.php');
include('include/dbconfig.php');
include('include/check-login.php');

$id    =trim(isset($_POST['franchiseId']) ? $_POST['franchiseId'] : "") ;
$sql   ="SELECT * FROM `student_info` WHERE `franchise_id`='$id'";

$res   = mysqli_query($conn,  $sql);
$result = array('success'=> false, 'records'=>[]);
if(mysqli_num_rows($res) > 0)
{
	$result['success']=true;
	while($row = mysqli_fetch_assoc($res)){
		array_push($result['records'], $row);
	}
}
echo json_encode($result);

?>

