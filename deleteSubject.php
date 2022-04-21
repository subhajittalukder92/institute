<?php
include "include/dbconfig.php";
$id=trim(mysqli_real_escape_string($conn,$_POST['id']));
echo $sql="DELETE FROM subjects WHERE id='$id'";
$res=mysqli_query($conn,$sql);
if($res){
    echo 1;
}else{
    echo 0;
}

?>