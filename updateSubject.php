<?php
include "include/dbconfig.php";
$res=json_encode($_POST);
$data=json_decode($res,true);

 $sql="update subjects set `course_id`='$data[course_id]',`subject`='$data[subjectname]',
    `semester_subjects`='$data[semSubjects]',`sem_order`='$data[order]',
    `full_marks`='$data[fullmarks]' ,`practical_marks`='$data[practicalFullmarks]' 
     where id='$data[id]'";

$res=mysqli_query($conn,$sql);
if($res){
    echo 1;
}
else{
    echo 0;
}

?>