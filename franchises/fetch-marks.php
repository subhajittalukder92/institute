<?php
session_start();
include "../functions.php";
include 'include/dbconfig.php';
include 'include/check-login.php';

if($_POST){
    $franchise = $_SESSION['franchise_id'] ;
    $regno     = $_POST['regno'] ;
    $admission = getAdmissionByRegno($regno);
    $result    = ['success' => true, 'heads' => []];
    
    if(!empty($admission)){
        $examSubjects = getSubjectsByCourse($admission['course_id']);
      
        $heads    = ['head_0'=> 'Student Name'];
        $subjects   = $studentRecords =  $studentMarks = $marksDetail = [];
        $totalMarks = 0;
        foreach ($examSubjects as $key => $subject) {
           $subject['total_marks'] = ($subject['full_marks'] + $subject['practical_marks']) ;
            $heads['head_'.count($heads)] = $subject['subject']; 
            $subjects[] = $subject;
            $totalMarks += ($subject['full_marks'] + $subject['practical_marks']);
        }
        $heads['head_'.count($heads)] = 'Total Marks';
        $heads['head_'.count($heads)] = 'Obtained Marks';

        $query   = "SELECT `student_info`.`St_Name`, admisn.*,marksTable.* FROM
                        (SELECT `pursuing_course`.`pusuing_id` AS `id`,`pursuing_course`.`student_id`,`pursuing_course`.`course_id`
                        FROM `pursuing_course` 
                        WHERE `pursuing_course`.`pusuing_id`='{$admission['pusuing_id']}' AND `pursuing_course`.`franchise_id`='{$franchise}'
                        AND `pursuing_course`.`current_status`='PURSUING'
                        )admisn
                LEFT JOIN 
                        (SELECT `id` AS `marks_id`,`admission_id`,`total_marks`,`obtained_marks`,`status`
                        FROM marks WHERE `admission_id`='{$admission['pusuing_id']}' AND `marks`.`franchise_id`='{$franchise}'
                        )marksTable
                ON admisn.`id` = marksTable.`admission_id`
                LEFT JOIN `student_info` ON `student_info`.`slno` = admisn.`student_id`";

        $stmt = mysqli_query($conn, $query);
        while ($data = mysqli_fetch_assoc($stmt)) {
            extract($data) ;
            $studentRecords[] = [
                'marks_id'      => !is_null($marks_id) ? $marks_id : "", 
                'admission_id'  => !is_null($id) ? $id  : "", 
                'course_id'     => $course_id, 
                'student_id'    => $student_id, 
                'student_name'  => $St_Name,
                'student'       => getStudents($student_id) ,
                'total_marks'   => $totalMarks, 
                'obtained_marks'=> !is_null($obtained_marks) ? $obtained_marks : "" , 
                'status'        => !is_null($status) ? $status : "" , 
                'rows'          => []   // For Headwise Subject Marks Records.
                ];
        
        }

        /**
         * Preparing Headwise Subject Marks.
        */

        foreach ($studentRecords as $key1 => $record) {
            $sl   = 1;
            $temp = [];
            $temp['head_0']     = $record['student_name'];
            foreach ($subjects as $key2 => $subject) {
                $totalMarks    +=  $subject['total_marks'] ;
                $marksQuery     = "SELECT * FROM `marks_details` WHERE `marks_id`='{$record['marks_id']}' 
                                    AND `subject_id`='{$subject['id']}'";
                $marksDetailRes = mysqli_query($conn,  $marksQuery);

                if(mysqli_num_rows($marksDetailRes) > 0){
                    $marksData           = mysqli_fetch_assoc($marksDetailRes);
                    $temp['head_'.$sl++] = $marksData;
                }else{
                    $temp['head_'.$sl++] = [
                                            "id" => null, 
                                            "subject_id" => $subject['id'], 
                                            "subject_name"=> $subject['subject'],
                                            "full_marks_theory" => $subject['full_marks'], 
                                            "marks_obtained_theory" => "",
                                            "full_marks_practical" => $subject['practical_marks'],  
                                            "marks_obtained_practical" => "", 
                                            "full_marks"  => ($subject['full_marks'] + $subject['practical_marks']), 
                                            ];
                }
            }
            $temp['head_'.$sl++] = !is_null($record['total_marks']) ? $record['total_marks'] : $totalMarks;
            $temp['head_'.$sl++] = !is_null($record['obtained_marks']) ? $record['obtained_marks'] : "";
            $studentRecords[$key1]['rows'] =  $temp ;

        }
        $result['heads']    = $heads;
        $result['records']  = $studentRecords;
      

        echo json_encode($result);	  

    }else{

    }
  
}



?>