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
            <div align="right"><img src="images/ms.png" class="student-pic"></div>
            <h6 class="info">JYBCE-0039-00573</h6>
            <h6 class="info s-name">Subhajit Talukdar</h6>
            <h6 class="info s-name">Arun Talukdar</h6>
            <h6 class="info course-name">DIPLOMA IN OFFICE ACCOUNTING EXPERT & PUBLISHING (DOAEP)</h6>
            <h6 class="info duration">4 Months</h6>
            <h6 class="info course-code">ABCD12345</h6>
            <div class="sem1">
                <div class="practical" align="center">
                    <h6 class="practical-marks">100</h6>
                </div>
                <div class="theory" align="center">
                    <h6 class="practical-marks">99</h6>
                </div>
                <div class="theory" align="center">
                    <h6 class="practical-marks">&nbsp;</h6>
                </div>
                <div class="theory" align="center">
                    <h6 class="practical-marks">&nbsp;</h6>
                </div>
                <div class="sem1-subjects-div">
                    <h6 class="sem1-subjects">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without document or a typeface in.</h6>
                </div>
            </div>
            <div class="sem2">
                <div class="practical" align="center">
                    <h6 class="practical-marks2">100</h6>
                </div>
                <div class="theory" align="center">
                    <h6 class="practical-marks2">99</h6>
                </div>
                <div class="theory" align="center">
                    <h6 class="practical-marks2">&nbsp;</h6>
                </div>
                <div class="theory" align="center">
                    <h6 class="practical-marks2">&nbsp;</h6>
                </div>
                <div class="sem1-subjects-div">
                    <h6 class="sem1-subjects">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without document or a typeface in.</h6>
                </div>
            </div>
            <div class="row grand-total-div">
                <div class="col-6" align="center"><h6 class="font-11">345</h6></div>
                <div class="col-6" align="right"><h6 class="font-11 percentage">83%</h6></div>
            </div>
            <div class="row last-div">
                <div class="col-1"></div>
                <div class="col-4">
                    <h6 class="font-11 grade">A+</h6>
                    <h6 class="font-11 pass">PASS</h6>
                    <h6 class="result-date" align="right">30/12/2021</h6>
                </div>
                <div class="col-7">
                    <img src="images/qrcode.png" class="qrcode">
                </div>
            </div>
        </div>
    </div>

</body>
</html>