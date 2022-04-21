<?php 
session_start();
include "include/dbconfig.php";
$memberId = $_POST['member_id'];
$sql = "SELECT * FROM exam_rule WHERE slno ='$memberId'";
/* echo $sql; */
$res = mysqli_query($conn,  $sql);
$row = mysqli_fetch_assoc($res);
echo json_encode($row);
?>