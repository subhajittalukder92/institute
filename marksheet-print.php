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
<link href="https://fonts.googleapis.com/css2?family=Oleo+Script&display=swap" rel="stylesheet">
<!-- google fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
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
    width:405px;
    margin:auto;
    padding-top:122px;
    }
    .student-pic{
        width: 72px;
        height: 79px;
        margin-bottom: 13px;
    }
    .info{
        margin-left: 145px;
        font-size: 14px;
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
        width:91%;
        margin:auto;
        padding-top:75px;
    }
}
</style>
</head>
<body>

    <div class="marksheet-bg">         
        <div class="content border">
            <div align="right"><img src="images/ms.png" class="student-pic"></div>
            <h6 class="info">123456789</h6>
            <h6 class="info">Subhajit Talukdar</h6>
            <h6 class="info">Arun Talukdar</h6>
            <h6 class="info">Diploma in Computer Application</h6>
            <h6 class="info">4 Months</h6>
            <h6 class="info">ABCD12345</h6>
        </div>
    </div>

</body>
</html>