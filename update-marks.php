<?php
session_start();
include 'include/dbconfig.php';
include 'include/check-login.php';
include "functions.php";

if($_POST){
    extract($_POST);
    $result = ['success'=> false, 'message'=>''];
    $sql = "UPDATE `marks_details` SET `obtained_marks`='$obtained_marks' WHERE `id`='$marks_detail_id'";
    $res = mysqli_query($conn, $sql);
    if($res){
        $result['success'] = true;
        $result['messsage'] = "Marks Update successful.";
    }else{
        $result['messsage'] = mysqli_error($conn);
    }
    echo json_encode($result) ;
}

?>