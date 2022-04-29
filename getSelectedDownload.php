<?php 
session_start();
include "include/dbconfig.php";
$id = $_POST['id'];
$sql = "SELECT * FROM `download` WHERE `id` ='$id'";
$res = mysqli_query($conn,  $sql);
$row = mysqli_fetch_assoc($res);
echo json_encode($row);
?>