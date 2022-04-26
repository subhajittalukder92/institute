<?php 
session_start();
include "include/dbconfig.php";
$memberId = $_POST['member_id'];
$sql = "SELECT * FROM `user_info` INNER JOIN  `franchises` ON  `user_info`.`member_id`=`franchises`.`id` WHERE `user_id` ='$memberId'";
/* echo $sql; */
$res = mysqli_query($conn,  $sql);
$row = mysqli_fetch_assoc($res);
$row = array_map(function ($v) {
    return $v ?: '';
}, $row);
echo json_encode($row);
?>