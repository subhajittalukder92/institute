<?php
     session_start();
     include 'include/dbconfig.php';
     include 'include/check-login.php';
     include "../functions.php";       
    
    if($_POST)
    {
        
    $params = $_POST['params'];
    $franchiseId = $_SESSION['franchise_id'] ;
    $marksDetails  = json_decode($params, true);
    $columns       = $columnValues = '';
    $affectedRows  = 0;
    /**
     * Calculating Total, Obtained Marks & Grades For Marks Table.         
    */
    $totalMarks = $obtainedMarks = 0 ; 
    foreach($marksDetails as $key1 => $item){
        
        $totalMarks = $obtainedMarks = 0 ; 
        foreach ($item['subjects'] as $key2 => $subject) {

            $totalMarks    += (int) $subject['full_marks'];
            $obtainedMarks += (int) $subject['marks_obtained_theory'];
            $obtainedMarks += (int) $subject['marks_obtained_practical'];
        }
        $percentage = (($obtainedMarks * 100) / $totalMarks) ;
       
        $marksDetails[$key1]['total_marks']    = $totalMarks;
        $marksDetails[$key1]['obtained_marks'] = $obtainedMarks;
        $marksDetails[$key1]['grades']         = calculateGrade($percentage) ;
        $marksDetails[$key1]['status']         = "completed";
    }
    
    /**
     *  Insert Query For `Marks` & `Marks_details` Table .         
    */
    foreach ($marksDetails as $i => $value) {
        $admissionData = getAdmissionById($value['admission_id']);
        if(empty($value['id'])){
            mysqli_begin_transaction($conn);
            $param        = array_diff_key($value, array_flip(["subjects", "id"]));
            $param['franchise_id']   = $franchiseId ;
            $param['franchise_info'] = json_encode(getFranchisesById($franchiseId)) ;
           
            $param['course_id'] =  $admissionData['course_id'];
            $courses = getAllCourses($admissionData['course_id']);
            if(!empty($courses)){
                unset($courses['description']);
            }
            $param['course_info'] = json_encode($courses);
            $param['created_at']  =  date('Y-m-d H:i:s');
            $param['submit_by']   =  $_SESSION['franchise_userid'];
            $columns      = implode(',', array_keys($param));
            $columnValues = "('" . implode("','", array_values($param)) . "')";
            $query        = "INSERT INTO `marks` ({$columns}) VALUES " . $columnValues ;
            $marks        = mysqli_query($conn, $query);
            $marksId      = mysqli_insert_id($conn);

            foreach ($value['subjects'] as $j => $subject) {
                unset($subject['id']);  
                $subjectData = getSubjectsById($subject['subject_id']);
                $subject['marks_id']             = $marksId;
                $subject['semester_subjects']    = $subjectData['semester_subjects'];
                $subject['full_marks_practical'] = $subjectData['practical_marks'];
                $subject['full_marks_theory']    = $subjectData['full_marks'];
                $subjectColumns  = implode(',', array_keys($subject));
                $subjectValues   = "('" . implode("','", array_values($subject)) . "')";
                $subjectQuery    = "INSERT INTO `marks_details` ({$subjectColumns}) VALUES {$subjectValues}" ;
                $marksDetail     = mysqli_query($conn, $subjectQuery);

                if($marks && $marksDetail){
                    
                    $result['success']  = true;
                    $result['message']  = "Marks saved successfully.";
                    mysqli_commit($conn);
                }else{
                
                    $result['success']  = false;
                    $result['message']  = mysqli_error($conn);
                   mysqli_rollback($conn);
                } 
            }
        }else{
            $date        = date('Y-m-d H:i:s');
            $updateQuery = "UPDATE `marks` SET `franchise_id`='{$franchiseId}', `admission_id`='{$value['admission_id']}'
                        ,`course_id`='{$admissionData['course_id']}', `student_id`='{$value['student_id']}',
                        `total_marks`='{$value['total_marks']}', `obtained_marks`='{$value['obtained_marks']}',`grades`='{$value['grades']}',
                        `modified_at`='{$date}' WHERE `id` ='{$value['id']}'";
        
            $updateQueryRes  = mysqli_query($conn, $updateQuery);
            $affectedRows    = mysqli_affected_rows($conn) > 0 ? ($affectedRows + 1) : $affectedRows;
            // Update Marks Details Table.
            foreach ($value['subjects'] as $j => $subject) 
            {
            if(!empty($subject['id']))
            {
                $updateDetailQuery = "UPDATE `marks_details` SET `subject_id`='{$subject['subject_id']}', 
                `subject_name`='{$subject['subject_name']}', `full_marks`='{$subject['full_marks']}',
                `marks_obtained_theory`='{$subject['marks_obtained_theory']}',
                `marks_obtained_practical`='{$subject['marks_obtained_practical']}' WHERE `id` ='{$subject['id']}'";
                //   echo $updateDetailQuery;
                $updateDetailQueryRes  = mysqli_query($conn, $updateDetailQuery);
                $affectedRows          = mysqli_affected_rows($conn) > 0 ? ($affectedRows + 1) : $affectedRows;
            }
            }
            if($affectedRows > 0){
            $result['success']  = true;
            $result['message']  = "Marks updated successfully.";
            }else{
            $result['success']  = true;
            $result['message']  = "No Records Are Updated.";
            }
        }
    }
    echo json_encode($result);
}
?>