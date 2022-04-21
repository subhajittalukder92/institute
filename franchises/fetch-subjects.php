<?php
include('include/dbconfig.php');
include "../functions.php";

if($_POST){
extract($_POST);
$courseId = mysqli_real_escape_string($conn, $_POST['course']);

echo getSubjects($courseId) ;
}
?>