<?php
session_start();
include "check-login.php";
$info=getUserInfo();

function getExamID()
{
	include "../include/dbconfig.php";
	$sql="SELECT * FROM `examinfo` WHERE `status`='ACTIVE'";
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
	$row=mysqli_fetch_assoc($res);
	/* print_r($row); */
	return $row;
	}
	else{
		return 0;
	}
}


function getExamRules()
{
	include "../include/dbconfig.php";
	$examid	 = getExamID();
	$sql="SELECT * FROM `exam_rule` WHERE `exam_id`='$examid[id]'";
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		while($row=mysqli_fetch_assoc($res))
		{
			echo " <label>".$row['particular']."</label><br/>";
		}
		echo '<br/><label class="checkbox-inline"><input type="checkbox" id="checkbox1" >I Have Read Above Rules & Regulation and I Agreed. </label><br/>';
	}
}
?>
<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  
</head>
<body>

<div class="container">
  <h2>CJNNYCTC</h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
    
    <li style="float:right"></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
     <div class="col-sm-12">
		<br/>
	   <label for="usr">Registration No:</label>
	   <label for="usr"><?php echo $_SESSION['user'];?></label><br/>
	   <label for="usr">Student Name:</label>
	   <label for="usr"><?php echo $info['St_Name'] ;?></label><br/>
	   
	  </div>
	   <center><label class="text-success"><u>Rules & Terms</u></label></center>
	  <div class="col-sm-12">
		<br/>
		<center>
	  <?php getExamRules();?>
	   
	   
	  </center>
	  
	  </div>
	 
	  <div class="clearfix"></div>
	  <div class="form-group" style="margin-top:5%;">
	   <center><button type="button" id="startExam" class="btn btn-primary" disabled>Start Exam</button></center>       
		</div>
    </div>


  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">
function strtExam() 
{

	popupWindow = window.open('exam.php','popUpWindow','fullscreen=yes,resizable=no,left=50,top=50,scrollbars=yes,titlebar: no,toolbar: no,statusbar:no,menubar=no,location=no,directories=no, status=yes')
}
$('#startExam').on('click',function(e){
	strtExam();
	$('#startExam').prop('disabled',true);
});
$(document).ready(function(e){
	 $('#checkbox1').change(function() {
        if($(this).is(":checked")) {
            $('#startExam').prop('disabled',false);
        }
        else{
			$('#startExam').prop('disabled',true);
		};        
    });	
});

</script>  
</body>

</html>
<?php 
function getUserInfo()
{
	include "../include/dbconfig.php";
	$sql="SELECT * FROM `student_info` WHERE `regno`='$_SESSION[user]'";
	$res=mysqli_query($conn,  $sql);
	$row=mysqli_fetch_assoc($res);
	return $row;
}
?>
