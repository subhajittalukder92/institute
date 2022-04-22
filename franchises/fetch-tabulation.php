<?php
session_start();
include "include/dbconfig.php";
include "../functions.php";
if($_POST){
    extract($_POST);
    $result = ['success' => true, 'heads' => [], 'records'=>[]];
    $studentecord = [];  $subjects = []; $studentMarks = []; $count = $sl = 1;
    $heads = ['head_0'=> 'Student Name', 'head_1' => 'Registration No'];
    $subjectQuery = "SELECT * FROM `subjects` WHERE `course_id`='$course'" ;
    $subjectRes   = mysqli_query($conn, $subjectQuery);
   
    while($subjectData = mysqli_fetch_assoc($subjectRes)){
        extract($subjectData);
        $count = count($heads);
        $subjectData['head_'.$count] = $subject ;
        $heads['head_'.$count] = $subject;
        $subjects[] = $subjectData;
       
    }
    $heads['head_'.count($heads)] = 'Total Marks';
    $heads['head_'.count($heads)] = 'Obtained Marks';
    $result['heads'] =  $heads ;
    $sql = "SELECT `marks`.`id`, `marks`.`student_id`, `marks`.`admission_id`,`student_info`.`St_Name`, 
            `pursuing_course`.`regno`,`marks`.`total_marks`,`marks`.`obtained_marks` FROM `marks` 
            LEFT JOIN `student_info`  ON  `student_info`.`slno` =  `marks`.`student_id`
            LEFT JOIN `pursuing_course`  ON  `pursuing_course`.`pusuing_id` =  `marks`.`admission_id`
            WHERE `marks`.`admission_id` IN (SELECT `pusuing_id` FROM `pursuing_course` WHERE `course_id`='$course' 
            AND `current_status`='PURSUING' AND `session`='$session' AND `franchise_id`='{$_SESSION['franchise_id']}')";

    $res = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_assoc($res)){
        extract($row);
        //  $query = "SELECT * FROM `marks_details` WHERE `marks_id`='$id' AND `subject_id`='$subject'";
        //  $marksDetailRes = mysqli_query($conn,  $query);
        
         $studentecord[] = array('marks_id'=> $id, 'student_name'=> $St_Name, 'registration_no'=> $regno, 
                                 'total_marks'=> $total_marks, 'obtained_marks'=> $obtained_marks);
    }

    foreach ($studentecord as $key => $record) {
        $sl = 2;
        $temp = [];
        $totalObtainedMarks = 0;
        $temp['head_0'] = $record['student_name'];
        $temp['head_1'] = $record['registration_no'];
        foreach ($subjects as $key => $subject) {
            
             $query = "SELECT * FROM `marks_details` WHERE `marks_id`='$record[marks_id]' AND `subject_id`='$subject[id]'";
             $marksDetailRes = mysqli_query($conn,  $query);
             if(mysqli_num_rows($marksDetailRes) > 0){
                $marksData         = mysqli_fetch_assoc($marksDetailRes);
               // $temp['head_'.$sl++] = $marksData['obtained_marks'];
                $temp['head_'.$sl++] = "<b>Theory: </b> " . $marksData['marks_obtained_theory']. "    <b>Practical: </b>". $marksData['marks_obtained_practical'];
               
             }else{
                $temp['head_'.$sl++] = "";
              
             }
        }
        $temp['head_'.$sl++] =$record['total_marks'];
        $temp['head_'.$sl++] =$record['obtained_marks'];
        $studentMarks[] =  $temp ;
       
    }
    $result['records'] =  $studentMarks ;
    echo json_encode($result);
}
