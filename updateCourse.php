<?php
include ("include/dbconfig.php");
$data1=json_encode($_POST);
$data2=json_decode($data1,true);

$sql="UPDATE `courses` SET `course_name`='$data2[coursename]',`description`='$data2[description]',`duration`='$data2[cdescription]',`eligibility`='$data2[eligibility]',`course_fee`='$data2[fees]' WHERE id='$data2[id]'";

$res=mysqli_query($conn,$sql);
if($res)
{
    echo 1;
}
else{
    echo 0;
}


?>