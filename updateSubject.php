<?php
include "include/dbconfig.php";
$res=json_encode($_POST);
$data=json_decode($res,true);

echo $sql="update subjects set course_id='$data[course_id]',subject='$data[subjectname]',full_marks='$data[fullmarks]' where id='$data[id]'";

$res=mysqli_query($conn,$sql);
if($res){
    echo 1;
}
else{
    echo 0;
}

?>