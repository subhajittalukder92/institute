<?php 
session_start();
include "check-login.php";
function fetchQuestions()
{
	$setno = "SET-".rand(1,2);
	include "../include/dbconfig.php";
	/* $sql="SELECT * FROM `question_info` WHERE `exam_id`='$_SESSION[examid]' AND `set_no`='$setno'"; */
	$sql="SELECT * FROM `question_info` WHERE `exam_id`='$_SESSION[examid]'";
	/* echo $sql; */
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		$i=0;
		while($row=mysqli_fetch_assoc($res))
		{
			echo '
			<div class="form-group">
			<table class="table table-bordered table-stripped">
			<input type="hidden" name="qid[]" id="qid'.$i.'" value="'.$row['id'].'" tabindex="'.$i.'">
			<tr>
				<label>'.$row['questn'].'</label>
			</tr>
			<tr>	  
			<div class="radio">
				  <label><input type="radio" name="optradio['.$i.']" value="A" tabindex="'.$i.'">'.$row['op_a'].'</label>
			</div>
			</tr>
			<tr>
				<div class="radio">
				  <label><input type="radio" name="optradio['.$i.']" value="B" tabindex="'.$i.'">'.$row['op_b'].'</label>
				</div>
			</tr>
			<tr>
				<div class="radio">
				  <label><input type="radio" name="optradio['.$i.']" value="C" tabindex="'.$i.'">'.$row['op_c'].'</label>
				</div>
			</tr>
			<tr>
				<div class="radio">
				  <label><input type="radio" name="optradio['.$i.']" value="D" tabindex="'.$i.'">'.$row['op_d'].'</label>
				</div>
			</tr>
			</table>
			</div>';
			$i++;
		}
	}
	else{
		session_destroy();
		echo "<script>alert('This Page iS Currently Not Available.');
		window.location='index.php';
		
		</script>";
		
	}
	
	
	
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">
function disableF5(e) 
{ if ((e.which || e.keyCode) == 116)
	e.preventDefault();
};
function startTimer(duration) 
{
	var timer = duration, minutes, seconds;
	setInterval(function () {
		minutes = parseInt(timer / 60, 10)
		seconds = parseInt(timer % 60, 10);

		minutes = minutes < 10 ? "0" + minutes : minutes;
		seconds = seconds < 10 ? "0" + seconds : seconds;

		document.getElementById("time").innerHTML= minutes+":"+seconds;

		if (--timer < 0) {
			document.forms["myForm"].submit();
		}
	}, 1000);
}
	function chekPassword()
	{
		
		$.ajax({
				url:"checkPasword.php",
				method:"POST",
				data:{'examid':$('#exmid').val(),'pass':$('#password').val()},
				success:function(data)
				{
					if(data)
					{
						$('#myModal').modal('toggle');
						$('#password').val("");
						$('#error').html("");
					}
					else{
						$('#error').html("Password Incorrect");
					}
				}
			});
	}
	$(document).on("keydown", disableF5);

	$(document).ready(function(e){
	
		duration =parseInt($('#timer').val()) * 60;
		/* startTimer(duration) ; */
		
	$(window).focus(function(e){
		$('#myModal').modal({backdrop: 'static', keyboard: false}) 
		});
	$('#unlock').on('click',function(){
		chekPassword();
	});
	$('#password').on('keydown',function(e){
		
		if((e.which || e.keyCode) == 13)
		{
			chekPassword();
		}
	});
	
	});
</script>
  
</head>
<body>
<nav class="navbar-fixed-top navbar-default">
<div class="container-fluid">
  <div class="navbar-header">
    <a class="navbar-brand" href="#"><label for="email">Registration Number: <?php echo $_SESSION['user'];?></label></a>
  </div>
  <div class="navbar-header pull-right">
    <a class="navbar-brand" href="#"><div id="time" style="float:right"></div></div></a>
  </div>
 
</div>
</nav>
<div class="container-fluid">

	<div class="row">
		<div class="col-sm-2"> <h2>
			  <script type="text/javascript">
				var timeLeft=2*60;
			  </script>
			  
	<div id="time"style="float:right">timeout</div></h2></div>
		<div class="col-sm-10" style="margin-top:5%;text-align:left;">
		<form method="post" id="myForm"  action="answer.php">
				<?php fetchQuestions();?>
			<div class="form-group">
				<input type="submit" value="Submit Now" class="btn btn-success" />
			</div>
		</form>
		<input type="hidden" name="exmid" id="exmid" value="<?php echo $_SESSION['examid']; ?>">
		<input type="hidden" name="timer" id="timer" value="<?php echo $_SESSION['time']; ?>">
	   </div>
	
	</div>
	
</div>

</body>
  <!-- Modal -->
<div style="margin-top:10%;" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-lock"></i> Exam Locked</h4>
			</div>
			<div class="modal-body">
			<div class="form-group" >
				   <label class="col-sm-3 control-label">Password<span style="color:red"> <b></b></span> </label>
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <input type="password" class="form-control" id="password" required name="password">
                  </div><br/>
				 
			</div>
			<div class="form-group" >
			 <font id="error" style="margin-left:40%;" color="red"></font>
			 </div>
				<div class="clearfix"></div>
			</div>
			<div class="modal-footer">
				<button type="button" id="unlock" class="btn btn-primary"><i class="fa fa-unlock-alt"></i> Unlock</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>               
</html>
