<?php
session_start();
include "functions.php";
include 'include/dbconfig.php';
include 'include/check-login.php';


if($_POST){
   extract($_POST);
   $result = ["success"=> false, "records" => [], "message" => ""];
   $sql    = "SELECT `marks`.*, `pursuing_course`.`regno`,`student_info`.`St_Name`
            FROM `marks` 
            LEFT JOIN `pursuing_course` ON `pursuing_course`.`pusuing_id` = `marks`.`admission_id`
            LEFT JOIN `student_info` ON `student_info`.`slno`= `marks`.`student_id`
            WHERE `marks`.`printed_at` IS NULL AND `marks`.`status` ='completed' AND `marks`.`franchise_id`='{$franchise}'" ;
   
   $ress = mysqli_query($conn, $sql);
   if(mysqli_num_rows($ress) > 0){
       $result['success'] = true;
       $result['message'] = "Data Found"; 
       while ($row = mysqli_fetch_assoc($ress)) {
           $row['course_info']  = json_decode($row['course_info']) ;
           $result['records'][] = $row;
       }
   }else{
    $result['message'] = "No data Found."; 
   }

   echo json_encode($result);
}