<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Log In</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<br>
<br>
<div class="container">
	<div class="row">
		
    </div>
</div>
	<div class="container">
<div class="row">
		 <div class="col-sm-6 col-md-6 col-sm-offset-3" style="margin-top:4%;">
			  <div class="panel panel-info">
			  <div class="panel-heading">Exam Login</div>
				<div class="panel-body">
				  <form role="form" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
					<div class="form-group">
					  <label for="email">Registration Number</label>
					  <input type="text" class="form-control" name="regno" id="regno" placeholder="Enter Registration Number" required>
					</div>
					<div class="form-group">
					  <label for="email">Select Exam</label>
					  <select class="form-control" name="examid" id="examid"  required>
						<option value="">-- Select -- </option>
						<?php getExam(); ?>
					  </select>
					</div>
					<div class="form-group">
					  <label for="pwd">Password</label>
					  <input type="password" class="form-control" placeholder="Password" name="pwd" id="pwd" placeholder="Enter password" required>
					</div>
					<button type="submit" name="submit" class="btn btn-default">Log In</button>
				  </form>
				</div>
				</div>
			  </div>
				
	   </div>
   </div>
   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
<?php 
if(isset($_POST['submit']))
{
	include "../include/dbconfig.php";
	$regno	 = trim($_POST['regno']);
	$passwrd = trim($_POST['pwd']);
	$examid	 = trim($_POST['examid']);
	$sql="SELECT * FROM `student_logininfo` WHERE `exm_id`='$examid' AND `regno`='$regno' AND `password`='$passwrd'";
	/* echo $sql; */
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{ 
		if(checkSeccondAttempt($regno))
		{
			
			if(getExamID($examid))
			{
				$info = getExamID($examid);
				$_SESSION['user']	   = $regno;
				$_SESSION['Student_Id']= getStudentId($regno);
				$_SESSION['examid']=$examid ;
				$_SESSION['time']=$info['time'] ;
				echo "<script>
				window.location='home.php';
				</script>";
			}
			else{
				echo '<script>alert("Please Try Again Later");</script>';
			}
		}
		else{
			echo '<script>alert("You Have Already Appeared For This Exam.");</script>';
		}
	}
	else{
		echo '<script>alert("Wrong Registration No Or Password");</script>';
	}
}
function getStudentId($regno)
{
	include "../include/dbconfig.php";
	$sql="SELECT * FROM `student_info` WHERE `regno`='$regno'";
	$res=mysqli_query($conn,  $sql);
	$row=mysqli_fetch_assoc($res);
	return $row['Student_Id'];
	
}
function getExamID($examid)
{
	include "../include/dbconfig.php";
	$sql="SELECT * FROM `examinfo` WHERE `status`='ACTIVE' AND `id`='$examid'";
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
	$row=mysqli_fetch_assoc($res);
	return $row;
	}
	else{
		return 0;
	}
}
function checkSeccondAttempt($regno)
{
	include "../include/dbconfig.php";
	$examid=getExamID();
	$sql="SELECT * FROM `answer_record` WHERE `exam_id`='$examid[id]' AND `regno`='$regno'";
	/* echo $sql; */
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		return false;
	}
	else{
		return true;
	}

}
function getExam()
{
	include "../include/dbconfig.php" ;
	$sql="SELECT * FROM `examinfo` WHERE `status`='ACTIVE'";
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		while($row = mysqli_fetch_assoc($res))
		{
			echo '<option value="'.$row['id'].'">'.$row['exam_name'].'</option>';
		}
	}
	else{
		return true;
	}
}
?>