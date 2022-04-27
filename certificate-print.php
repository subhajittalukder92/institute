<?php 
include('include/dbconfig.php');
include('include/settings.php');
include 'functions.php';
$month = ["01" => "JAN", "02" => "FEB", "03" => "MAR",  "04" => "APR", "05" => "MAY", "06" => "JUN",   "07" => "JUL", "08" => "AUG", "09" => "SEP", "10" => "OCT" ,"11" => "NOV" ,"12" => "DEC"];
    
$regNo = mysqli_real_escape_string($conn, $_GET['id']);
$sql   = "SELECT `pursuing_course`.*,`student_info`.*, `marks`.`course_info`,`marks`.`certificate_issue_date`,`marks`.`grades`,
        `marks`.`qrcode`, `franchises`.`franchise_name`,`franchises`.`address` FROM `pursuing_course`
        LEFT JOIN `student_info` ON `student_info`.`slno` = `pursuing_course`.`student_id`
        LEFT JOIN `marks` ON `marks`.`admission_id` = `pursuing_course`.`pusuing_id`
        LEFT JOIN `franchises` ON `franchises`.`id` = `pursuing_course`.`franchise_id`
        WHERE `pursuing_course`.`regno` ='{$regNo}' AND `marks`.`certificate_status` = 'issued' LIMIT 1" ;
$ress  = mysqli_query($conn, $sql) ;
if(mysqli_num_rows($ress) > 0){
    $data = mysqli_fetch_array($ress);
    $data['qrcode']     = getBaseAddress()."qrcode/". $data['qrcode'];
    $data['image_name'] = getBaseAddress()."Student_images/".$data['image_name'];
    $data['starting_month'] = !empty($data['starting_month']) ?  $month[$data['starting_month']] : "";
    $data['complete_month'] = !empty($data['complete_month']) ?  $month[$data['complete_month']] : "";
    $course = json_decode($data['course_info'], true);
}else{
    echo '<h2 align="center">No Records Found</h2>';
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Certificate Print</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body, html {
    height: 100%;
    width:100%;
    margin: 0;
    }
    .certificate-bg {
    background-image: url("images/certificate.jpg");
    height: 655px; 
    width:500px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: contain;
    margin:auto;
    overflow:auto;
    }
    .content{
    width:420px;
    margin:auto;
    padding-top:48px;
    }
    h6{
        font-size: 11px;
        font-weight: 700;
    }
    .reg-no{
        margin-left: 70px;
        font-size: 10px;
    }
    .name{
        margin-top:231px;
        font-size: 12px;
    }
    .father-name{
        margin-top: 10px;
        font-size: 12px;
    }
    .from-div{
        margin-top: 9px;
    }
    .at{
        font-size: 8.5px;
        margin-top: 2px;
    }
    .div1{
        width: 67px; 
        float: right;
    }
    .div2{
        min-width: 55px; 
        max-width: 55px; 
        float: right;
    }
    .div3{
        width: 218px; 
        float: right;
    }
    .ins-name{
        padding-left: 8px;
    }
    .pic-div-container{
        width:377px; 
        margin:auto; 
        margin-top: 19px;
    }
    .student-pic-div{
        width: 79px; 
        height: 80px; 
        float: right;
    }
    .qrcode-pic-div{
        width: 77px; 
        height: 80px;
    }
    .student-pic{
        width: 79px; 
        height: 80px;
    }
    .qrcode-pic{
        width: 77px; 
        height: 80px;
    }
    .issue-date{
        font-size: 11px; 
        font-weight: 500; 
        padding-left: 5px;
    }

@media print{
    html, body {
        height: 99%;    
    }
    .certificate-bg {
    background-image: url("images/certificate.jpg");
    height: 100%; 
    width:100%;
    margin-top:10px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    overflow: visible;
    }
    .content{
        width:91%;
        margin:auto;
        padding-top:72px;
    }
    h6{
        font-size: 18px;
    }
    .reg-no{
        margin-left: 127px;
        font-size: 15px;
    }
    .name{
        padding-left: 10px;
        margin-top: 400px;
        font-size: 19px;
    }
    .father-name{
        margin-top: 15px;
        font-size: 19px;
    }
    .from-div{
        margin-top: 15px;
        margin-bottom: 12px;
    }
    .div1{
        width: 115px; 
        float: right;
    }
    .div2{
        min-width: 90px;
        max-width: 90px; 
        float: right;
    }
    .div3{
        width: 379px; 
        float: right;
    }
    .ins-div{
        margin-top: 53px;
    }
    .ins-name{
        padding-left: 24px;
    }
    .grade-div{
        margin-top: 10px;
    }
    .at{
        padding-left: 5px;
        font-size: 15px;
    }
    .pic-div-container{
        width:644px; 
        margin:auto; 
        margin-top: 34px;
    }
    .student-pic-div{
        width: 131px; 
        height: 136px;
        border:1px solid lightgray;
    }
    .qrcode-pic-div{
        width: 128px; 
        height: 138px;
    }
    .student-pic{
        width: 131px; 
        height: 136px;
        margin-top: 2px;
    }
    .qrcode-pic{
        width: 127px; 
        height: 138px;
        margin-left: 1.5px;
    }
    .container{
        max-width: 97%;
        margin-top: 45px;
    }
    .issue-date{
        font-size: 15px; 
        font-weight: 500; 
        padding-left: 20px;
    }
}
</style>
</head>
<body>
<div class="certificate-bg">         
        <div class="content">
			<h6 class="reg-no"><?php echo $data[7];?></h6>
            <h6 class="name" align="center"><?php echo $data['St_Name'];?></h6>
            <h6 class="father-name" align="center"><?php echo $data['Fathers_Name'];?></h6>
            <div class="container-fluid from-div">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-5" align="center">
                        <h6 class="from"><?php echo $data['starting_month'].'-'.$data['starting_year']; ?></h6>
                    </div>
                    <div class="col-4" align="center">
                        <h6 class="from"><?php echo $data['complete_month'].'-'.$data['complete_year']; ?></h6>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
            <div class="div1"><h6 align="center"><?php echo $course['duration']; ?></h6></div>
            <div class="div2">&nbsp;</div>
            <div class="div3" align="center"><h6><?php echo !empty($course['short_name']) ? $course['short_name'] : ""; ?></h6></div>
            <div class="container-fluid ins-div" style="clear: both;">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-9" align="center">
                        <h6 class="ins-name"><?php echo $data['franchise_name']; ?></h6>
                    </div>
                </div>
            </div>
            <div class="container-fluid grade-div">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-2">
                        <h6><?php echo $data['grades']; ?></h6>
                    </div>
                    <div class="col-6">
                        <h6 class="at"><?php echo $data['address']; ?></h6>
                    </div>
                </div>
            </div>
            <div class="pic-div-container">
                <div class="student-pic-div">
                    <img src="<?php echo $data['image_name']; ?>" class="student-pic border">
                </div>
                <div class="qrcode-pic-div">
                    <img src="<?php echo $data['qrcode']; ?>" class="qrcode-pic border">
                </div>
            </div>
            <div class="container">
                <div class="clearfix mt-4">
                  <p class="float-start issue-date" ><?php echo date('d/m/Y', strtotime($data['certificate_issue_date'])); ?></p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>