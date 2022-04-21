<?php 
include('include/dbconfig.php');
$id=isset($_POST['id'])?$_POST['id']:"";

$sql="DELETE FROM courses WHERE id='$id'";

$res=mysqli_query($conn,$sql);

if($res)
{
    echo 1;
}
else{
    echo 0;
}

?>