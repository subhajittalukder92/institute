<?php
include "include/dbconfig.php";

extract($_POST);

if($chk=='pre_edit')
{
    $sqli="SELECT * FROM marks_details WHERE id='$id'";
    $res=mysqli_query($conn,$sqli);


    if(mysqli_num_rows($res)>0)
    {
        $row=mysqli_fetch_assoc($res);
       echo  json_encode($row);
    }
    else{
       echo  json_encode(['status'=>'NO DATA']);
    }
}
else{

    $sqli="UPDATE marks_details SET obtained_marks='$obtained_marks' WHERE id='$id'";
    $res1=mysqli_query($conn,$sqli);

    if($res1)
    {
        $sqli2="SELECT SUM(obtained_marks) as total_marks FROM `marks_details` WHERE marks_id='$marks_id'";
        $res2=mysqli_query($conn,$sqli2);

        if(mysqli_num_rows($res2)>0)
        {
            $row2=mysqli_fetch_assoc($res2);
            $sqli3 = "UPDATE `marks` SET `obtained_marks`='{$row2['total_marks']}' WHERE `id` = '$marks_id'";

            $res3=mysqli_query($conn,$sqli3);

            if($res3)
            {
                echo 1;
            }
            else{
                echo 0;
            }
        }

    }
    
    
}
