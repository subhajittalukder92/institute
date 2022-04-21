<?php 
session_start();
include "include/check-login.php";
$info=getStudentInfo();
function fetchQuestions()
{
	include "include/dbconfig.php";
	$sql="SELECT * FROM `question_info`
		LEFT JOIN answer_record
		ON question_info.id=answer_record.q_id
		WHERE answer_record.exam_id='$_GET[examid]' AND answer_record.student_id='$_GET[stid]'";
		/* echo $sql; */
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		$i=0;
		while($row=mysqli_fetch_assoc($res))
		{
			echo '
			<div class="form-group">
			<table class="table" style="width:80%;">
				<tr>
					<td>
					<label>'.$row['questn'].'</label>
					</td>
				</tr>
				<tr>
					<td>
					  <label>Answer Made   : '.printResponse($row).' </label><br/>

					  <label class="text-success">Correct Answer : '.printAnswer($row).'</label>
					</td>
				</tr>
			</table>
			</div>';
			$i++;
		}
	}
	
	
	
}
function getStudentInfo()
{
	include "include/dbconfig.php";
	$sql="SELECT * FROM `student_info` WHERE `Student_Id` = '$_GET[stid]'";
	$res=mysqli_query($conn,  $sql);
	$row=mysqli_fetch_assoc($res);
	return $row;
}
function printResponse($row)
{
	include "include/dbconfig";
	if($row['answr']== 'A')
	{
		return $row['op_a'];
	}
	if($row['answr']== 'B')
	{
		return $row['op_b'];
	}
	if($row['answr']== 'C')
	{
		return $row['op_c'];
	}
	if($row['answr']== 'D')
	{
		return $row['op_d'];
	}
}
function printAnswer($row)
{
	include "include/dbconfig";
	if($row['answer']== 'A')
	{
		return $row['op_a'];
	}
	if($row['answer']== 'B')
	{
		return $row['op_b'];
	}
	if($row['answer']== 'C')
	{
		return $row['op_c'];
	}
	if($row['answer']== 'D')
	{
		return $row['op_d'];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar-fixed-top navbar-default">
<div class="container-fluid">
<div class="col-xs-6">
  <div class="navbar-header">
    <a class="navbar-brand" href="#"><label for="email">Registration No.: <?php echo $info['regno'];?></label></a>
  </div>
  </div>
  <div class="col-xs-6">
  <div class="navbar-header pull-right">
    <a class="navbar-brand" href="#"><label for="email">Student Name: <?php echo $info['St_Name'];?></label></div></a>
  </div>
  </div>
 
</div>
</nav>
<div class="container-fluid">

	<div class="row">
		<div class="col-sm-2"> <h2>
			  		  
	</h2></div>
		<div class="col-sm-10" style="margin-top:5%;text-align:left;">
		
				<?php fetchQuestions();?>
				
	   </div>
	
	</div>
	
</div>

</body>
</html>
