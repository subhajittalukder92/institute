<?php 
include "include/dbconfig.php";
$sql="SELECT * FROM `franchises`";
$res = mysqli_query($conn,  $sql) ;
$row=mysqli_fetch_assoc($res);

$subtitle=$row['subtitle'];
$affiliation=$row['affiliation'];
$registration=$row['registration'];
$iso=$row['iso'];
$code=$row['code'];
$address=$row['address'];
$contact=$row['contact'];






?>