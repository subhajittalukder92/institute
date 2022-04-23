<?php 
include('include/dbconfig.php');
include('include/settings.php');
include 'functions.php';
$month = ["01" => "JAN", "02" => "FEB", "03" => "MAR",  "04" => "APR", "06" => "JUN",   "07" => "JUL", "08" => "AUG", "09" => "SEP", "10" => "OCT" ,"11" => "NOV" ,"12" => "DEC"];
    
$regNo = htmlspecialchars($_GET['id'], ENT_QUOTES);
$sql   = "SELECT `pursuing_course`.*,`student_info`.*, `marks`.`course_info`,`marks`.`marksheet_issue_date`,`marks`.`grades`,`marks`.`marksheet_qrcode`,`marks`.`id` AS `marks_id`,
        `marks`.`qrcode`,`marks`.`obtained_marks`,`marks`.`total_marks`, `franchises`.* FROM `pursuing_course`
        LEFT JOIN `student_info` ON `student_info`.`slno` = `pursuing_course`.`student_id`
        LEFT JOIN `marks` ON `marks`.`admission_id` = `pursuing_course`.`pusuing_id`
        LEFT JOIN `franchises` ON `franchises`.`id` = `pursuing_course`.`franchise_id`
        WHERE `pursuing_course`.`regno` ='{$regNo}' LIMIT 1" ;
$ress  = mysqli_query($conn, $sql) ;
if(mysqli_num_rows($ress) > 0){
    $data = mysqli_fetch_array($ress);
    $data['qrcode']     = getBaseAddress()."qrcode/". $data['qrcode'];
    $data['marksheet_qrcode']     = getBaseAddress()."qrcode/". $data['marksheet_qrcode'];
    $data['image_name'] = getBaseAddress()."Student_images/".$data['image_name'];
    $data['starting_month'] = !empty($data['starting_month']) ?  $month[$data['starting_month']] : "";
    $data['complete_month'] = !empty($data['complete_month']) ?  $month[$data['complete_month']] : "";
    $course = json_decode($data['course_info'], true);
    $marksDetail = getMarkDetails($data['marks_id']);
    
}else{
    echo '<h2 align="center">No Records Found</h2>';
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Marksheet Print</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- google fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
  <style>
    body, html {
    height: 100%;
    width:100%;
    margin: 0;
    }
    .marksheet-bg {
    background-image: url("images/marksheet.jpg");
    height: 655px; 
    width:500px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: contain;
    margin:auto;
    overflow:auto;
    }
    .content{
    width:408px;
    margin:auto;
    padding-top:122px;
    }
    .student-pic{
        width: 74px;
        height: 80px;
        margin-bottom: 15px;
    }
    .info{
        margin-left: 148px;
        font-size: 12px;
        font-family: 'Oswald', sans-serif;
    }
    .s-name{
        font-weight: 600;
        padding-top: 2px;
    }
    .course-name{
        font-size: 10px;
        padding-top: 4px;
    }
    .duration{
        padding-top: 5px;
    }
    .course-code{
        padding-top: 3px;
    }
    .sem1{
        margin-top: 50px; 
        min-height: 43px; 
        max-height: 43px;
    }
    .practical{
        width: 55px; 
        float: right;
    }
    .practical-marks{
        font-size: 10px; 
        margin-top: 6px;
    }
    .theory{
        width: 60px; 
        float: right;
    }
    .sem1-subjects-div{
        width: 172px;
    }
    .sem1-subjects{
        font-size: 8px;
    }
    .sem2{
        margin-top: 10px; 
        min-height: 43px; 
        max-height: 43px;
    }
    .practical-marks2{
        font-size: 10px; 
        margin-top: 4px;
    }
    .grand-total-div{
        margin-top: 1px;
    }
    .font-11{
        font-size: 11px;
    }
    .percentage{
        margin-right: 10px;
    }
    .last-div{
        margin-top: 4px;
    }
    .grade{
        margin-left: 10px;
    }
    .pass{
        margin-left: 10px;
    }
    .result-date{
        font-size: 10px; 
        margin-top: 21px;
    }
    .qrcode{
        width: 60px; 
        height: 60px; 
        margin-top: 5px;
    }

@media print{
    html, body {
        height: 99%;    
    }
    .marksheet-bg {
    background-image: url("images/marksheet.jpg");
    height: 100%; 
    width:100%;
    margin-top:10px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    overflow: visible;
    }
    .content{
        width:88%;
        margin:auto;
        padding-top:199px;
    }
    .student-pic{
        width: 124px;
        height: 136px;
        margin-bottom: 25px;
        margin-right: 2px;
    }
    .info{
        margin-left: 260px;
        font-size: 22px;
        font-family: 'Oswald', sans-serif;
    }
    .s-name{
        font-weight: 600;
        padding-top: 7px;
    }
    .course-name{
        font-size: 17px;
        padding-top: 14px;
    }
    .duration{
        padding-top: 11px;
    }
    .course-code{
        padding-top: 11px;
    }
    .sem1{
        margin-top: 87px; 
        min-height: 43px; 
        max-height: 43px;
    }
    .practical{
        width: 90px; 
        float: right;
    }
    .practical-marks{
        font-size: 16px; 
        margin-top: 6px;
    }
    .theory{
        width: 105px; 
        float: right;
    }
    .sem1-subjects-div{
        width: 295px;
    }
    .sem1-subjects{
        font-size: 13px;
    }
    .sem2{
        margin-top: 47px; 
        min-height: 43px; 
        max-height: 43px;
    }
    .practical-marks2{
        font-size: 16px; 
        margin-top: 4px;
    }
    .grand-total-div{
        margin-top: 33px;
    }
    .font-11{
        font-size: 17px;
    }
    .last-div{
        margin-top: 14px;
    }
    .pass{
        margin-top: 14px;
    }
    .result-date{
        font-size: 16px; 
        margin-top: 40px;
    }
    .qrcode{
        width: 110px; 
        height: 110px; 
        margin-top: 5px;
    }
}
</style>
</head>
<body>

    <div class="marksheet-bg">         
        <div class="content">
            <div align="right"><img src="<?php echo $data['image_name'];?>" class="student-pic"></div>
            <h6 class="info"><?php echo $data[7];?></h6>
            <h6 class="info s-name"><?php echo $data['St_Name'];?></h6>
            <h6 class="info s-name"><?php echo $data['Fathers_Name'];?></h6>
            <h6 class="info course-name"><?php echo $course['course_name']; ?></h6>
            <h6 class="info duration"><?php echo $course['duration']." ".$course['unit']; ?></h6>
            <h6 class="info course-code"><?php echo $course['course_id']; ?></h6>
            <div class="sem1">
                <div class="practical" align="center">
                    <h6 class="practical-marks"><?php echo $marksDetail[0]['marks_obtained_practical']; ?></h6>
                </div>
                <div class="theory" align="center">
                    <h6 class="practical-marks"><?php echo $marksDetail[0]['marks_obtained_theory']; ?></h6>
                </div>
                <div class="theory" align="center">
                    <h6 class="practical-marks"><?php echo $marksDetail[0]['full_marks_practical']; ?></h6>
                </div>
                <div class="theory" align="center">
                    <h6 class="practical-marks"><?php echo $marksDetail[0]['full_marks_theory']; ?></h6>
                </div>
                <div class="sem1-subjects-div">
                    <h6 class="sem1-subjects"><?php echo $marksDetail[0]['semester_subjects']; ?></h6>
                </div>
            </div>
            <div class="sem2">
                <div class="practical" align="center">
                    <h6 class="practical-marks2"><?php echo $marksDetail[1]['marks_obtained_practical']; ?></h6>
                </div>
                <div class="theory" align="center">
                    <h6 class="practical-marks2"><?php echo $marksDetail[1]['marks_obtained_theory']; ?></h6>
                </div>
                <div class="theory" align="center">
                    <h6 class="practical-marks2"><?php echo $marksDetail[1]['full_marks_practical']; ?></h6>
                </div>
                <div class="theory" align="center">
                    <h6 class="practical-marks2"><?php echo $marksDetail[1]['full_marks_theory']; ?></h6>
                </div>
                <div class="sem1-subjects-div">
                    <h6 class="sem1-subjects"><?php echo $marksDetail[1]['semester_subjects']; ?></h6>
                </div>
            </div>
            <div class="row grand-total-div">
                <div class="col-6" align="center"><h6 class="font-11"><?php echo $data['obtained_marks']; ?></h6></div>
                <div class="col-6" align="right"><h6 class="font-11 percentage"><?php echo ($data['obtained_marks'] * 100 / $data['total_marks']) ;?>%</h6></div>
            </div>
            <div class="row last-div">
                <div class="col-1"></div>
                <div class="col-4">
                    <h6 class="font-11 grade"><?php echo $data['grades']; ?></h6>
                    <h6 class="font-11 pass">PASS</h6>
                    <h6 class="result-date" align="right">&nbsp;&nbsp;<?php echo date("d/m/Y", strtotime($data['marksheet_issue_date'])); ?></h6>
                </div>
                <div class="col-7">
                    <img src="<?php echo $data['marksheet_qrcode'];?>" class="qrcode">
                </div>
            </div>
        </div>
    </div>

</body>
</html>