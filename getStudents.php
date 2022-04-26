<?php 
    include('include/dbconfig.php');

    $reg_no = $_POST['reg_no'];

    $sql="SELECT pursuing_course.current_status, student_info.St_Name, student_info.Fathers_Name, student_info.image_name, courses.course_name
          FROM pursuing_course
          LEFT JOIN student_info ON pursuing_course.student_id=student_info.Student_Id
          LEFT JOIN courses ON pursuing_course.course_id=courses.course_id
          WHERE pursuing_course.regno='".$reg_no."'";

    $res = $conn->query($sql);
    $result=array();

    while($rows = $res->fetch_assoc())
    {
        $rows['image_name']="Student_images/".$rows['image_name'];
        array_push($result,$rows);
     } 
     if (mysqli_num_rows($res)>0) {
         echo json_encode(array('success'=>true,"data"=>$result));
     }else{
        echo json_encode(array('success'=>false));
     }
?>