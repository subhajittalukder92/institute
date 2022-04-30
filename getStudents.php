<?php 
    include('include/dbconfig.php');

    $reg_no = $_POST['reg_no'];

    $sql="SELECT pursuing_course.current_status, student_info.St_Name, student_info.Fathers_Name, student_info.image_name, courses.course_name
          FROM pursuing_course
          LEFT JOIN student_info ON pursuing_course.student_id=student_info.slno
          LEFT JOIN courses ON pursuing_course.course_id=courses.id
          WHERE pursuing_course.regno='".$reg_no."'";

    $res = $conn->query($sql);
    $result=array();

    while($rows = $res->fetch_assoc())
    {
        if(!empty($rows['image_name'])){
             if (file_exists("Student_images/".$rows['image_name'])) {
             $rows['image_name']="Student_images/".$rows['image_name'];
        }else{
             $rows['image_name']="images/blank-student.jpg";
        }
        }else{
             $rows['image_name']="images/blank-student.jpg";
        }
       
     
        array_push($result,$rows);
     } 
     if (mysqli_num_rows($res)>0) {
         echo json_encode(array('success'=>true,"data"=>$result));
     }else{
        echo json_encode(array('success'=>false,'message' => "No data Found!"));
     }
?>