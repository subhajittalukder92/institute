<?php 
include "include/dbconfig.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $file   = $_FILES['docs']['name'];
 
        if (!empty($file)) {
            $extension   = strtolower(pathinfo($_FILES['docs']['name'], PATHINFO_EXTENSION));
            $fileName    = md5(uniqid(rand(), true)) . "." . $extension;
            $target_dir  = 'excel_file/' . $fileName;

            if (!is_dir('excel_file')) {
                mkdir('excel_file', 0777, true);
            }
          
            if (move_uploaded_file($_FILES['docs']['tmp_name'], $target_dir)) {
                set_time_limit(0);
                $file = fopen($target_dir, 'r');
                $i = 0;
                $createdAt = date('Y-m-d H:i:s');
                while (($Row = fgetcsv($file)) !== FALSE) {
                    if ($i > 0) {
                        if (!empty($Row[0])) {
                            $student   = !empty($Row[0]) ? $Row[0] : NULL;
                            $franchise = !empty($Row[1]) ? $Row[1] : NULL;
                            $course    = !empty($Row[2]) ? $Row[2] : NULL;
                            $regNo     = !empty($Row[3]) ? $Row[3] : NULL;
                            $admissionDate = !empty($Row[4]) ? date('Y-m-d', strtotime($Row[4])) : NULL;
                            $status     = !empty($Row[5]) ? $Row[5] : NULL;
                            $sql = "INSERT INTO `student_info`(`franchise_id`,`St_Name`) VALUES ('{$franchise}','{$student}')";
                            $res = mysqli_query($conn, $sql);
                            $studentId = mysqli_insert_id($conn);
                            $yoa = date('Y', strtotime($admissionDate));
                          
                           

                            $admissionQuery = "INSERT INTO `pursuing_course`(`date`, `session`, `student_id`, `course_id`,`franchise_id`, `regno`,`current_status`,`mode_of_insertion`) 
                                               VALUES ('{$admissionDate}', '{$yoa}', '{$studentId}', '{$course}', '{$franchise}', '{$regNo}', '{$status}', 'bulk_upload')";
                            echo $admissionQuery;
                          
                            $r = mysqli_query($conn, $admissionQuery);
                        }
                    }
                    $i++;
                   
                    
                }
                fclose($file);
                echo "Done";
            }
        }
}