<?php 
session_start();
include "include/dbconfig.php";
$memberId = $_POST['member_id'];
$sql = "SELECT * FROM student_logininfo WHERE id ='$memberId'";
/* echo $sql; */
$res = mysqli_query($conn,  $sql);
$row = mysqli_fetch_assoc($res);
echo json_encode($row);
?>