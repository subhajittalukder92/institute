<?php
include "include/dbconfig.php";

$sql="SELECT *,subjects.id as sid,courses.course_name as cname FROM subjects INNER JOIN courses on courses.id=subjects.course_id ORDER BY `subjects`.`id` DESC";
$res=mysqli_query($conn,$sql);
$data=array();
if(mysqli_num_rows($res)>0)
{
    while($row=mysqli_fetch_assoc($res))
    {
        $data[]=$row;
    }
}

echo json_encode($data);


?>