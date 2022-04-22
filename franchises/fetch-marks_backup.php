<?php 
session_start();
include 'include/dbconfig.php';
include 'include/check-login.php';
include "../functions.php";

if($_POST){
   $franchise = $_SESSION['franchise_id'] ;
   $course    = $_POST['course'] ;
   $session   = $_POST['session'] ;
   $subject   = $_POST['subject'] ;
   $type      = isset($_POST['type']) ? $_POST['type'] : "" ;
         
   

 if($type == "insert"){
    $query = "SELECT Q.*,`student_info`.`St_Name`,`marks_details`.`subject_id`,`marks_details`.`obtained_marks`,`subjects`.`subject`,`subjects`.`full_marks` FROM 
    (SELECT P.*,`marks`.`id` 
    FROM (SELECT `pusuing_id`,`student_id`,`franchise_id`,`regno`
          FROM `pursuing_course` 
          WHERE `session`='$session' AND `franchise_id`='$franchise' AND `course_id`='$course' 
          AND `current_status`= 'PURSUING')P 
    LEFT JOIN `marks` ON P.`pusuing_id` = `marks`.`admission_id`)Q
    LEFT JOIN `marks_details` ON Q.`id` = `marks_details`.`marks_id`  AND `marks_details`.`subject_id`='$subject'
    LEFT JOIN `student_info` ON `student_info`.`slno` = Q.`student_id`
    LEFT JOIN `subjects` ON `subjects`.`id` = '$subject'" ;
 }else{
    $query = "SELECT Q.*,`student_info`.`St_Name`,`marks_details`.`subject_id`,`marks_details`.`obtained_marks`,`marks_details`.`id` as md_id ,`subjects`.`subject`,`subjects`.`full_marks` FROM 
    (SELECT P.*,`marks`.`id` 
    FROM (SELECT `pusuing_id`,`student_id`,`franchise_id`,`regno`
          FROM `pursuing_course` 
          WHERE `session`='$session' AND `franchise_id`='$franchise' AND `course_id`='$course' 
          AND `current_status`= 'PURSUING')P 
    INNER JOIN `marks` ON P.`pusuing_id` = `marks`.`admission_id`)Q
    INNER JOIN `marks_details` ON Q.`id` = `marks_details`.`marks_id`  AND `marks_details`.`subject_id`='$subject'
    INNER JOIN `student_info` ON `student_info`.`slno` = Q.`student_id`
    INNER JOIN `subjects` ON `subjects`.`id` = '$subject'" ;   
 }
   
   
        
  // echo $query;
    $ress   = mysqli_query($conn, $query);
    $result = array('success'=>false, 'records'=> []);
    if(mysqli_num_rows($ress) > 0){
        $result['success'] = true;
        while($row = mysqli_fetch_assoc($ress)){
            if($type == "insert"){
                if(empty($row['obtained_marks'])){
                    $result['records'][] = $row ;
                }
            }else{
                $result['records'][] = $row ;
            }
            
           
        }
    }
    echo json_encode($result) ;
}
