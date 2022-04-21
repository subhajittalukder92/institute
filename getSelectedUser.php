<?php 
session_start();
include "include/dbconfig.php";
$memberId = $_POST['member_id'];
$sql = "SELECT * FROM `user_info` WHERE `user_id` ='$memberId'";
/* echo $sql; */
$res = mysqli_query($conn,  $sql);
$row = mysqli_fetch_assoc($res);
echo json_encode($row);
?>