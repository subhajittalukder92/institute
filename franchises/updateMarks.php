<?php
include "include/dbconfig.php";

extract($_POST);

$sql="SELECT * FROM marks_details WHERE id='$id'";
$res=mysqli_query($conn,$sql);
if(mysqli_num_rows($res)>0)
{
    $row=mysqli_fetch_assoc($res);
    echo json_encode($row);
}



?>