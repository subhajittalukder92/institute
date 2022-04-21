<?php 
session_start();
include "include/check-login.php";
include "include/dbconfig.php";
$memberId = $_POST['member_id'];
$sql = "SELECT * FROM question_info WHERE id ='$memberId'";
$res = mysqli_query($conn,  $sql);
$row = mysqli_fetch_assoc($res);
echo json_encode($row);
?>