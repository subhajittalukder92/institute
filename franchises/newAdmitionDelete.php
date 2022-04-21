<?php
include "include/dbconfig.php";

$id=trim(mysqli_real_escape_string($conn,$_POST['id']));

$sql="DELETE FROM student_info WHERE slno='{$id}'";
$sql2="DELETE FROM pursuing_course WHERE student_id='{$id}'";
$res=$conn->query($sql);
$res2=$conn->query($sql2);
$data=array();
if($res && $res2)
{
    $data=[
        'messages'=>"Delete Successfully",
        'success'=>true
    ];

}
else{
    $data=[
        'messages'=>" Delete Not Successful !",
        'success'=>false
    ];

}

echo json_encode($data);

?>