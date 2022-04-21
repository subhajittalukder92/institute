<?php 
session_start();
include "include/no-cache.php";
include "include/dbconfig.php";
include "include/check-login.php";
if(isset($_POST['submit']))
{
extract($_POST);
	$examname	= strtoupper(trim($_POST['examname']));
	
	$sql		= "INSERT INTO `examinfo`(`exam_name`,`date`,`status`,`unlock_pass`,`time`,`fm`) 
				  VALUES ('$examname','$date','','$password','$time','$fm')";
	$res		= mysqli_query($conn,  $sql);
	if($res)
	{
		echo "<script>alert('Exam Name Saved.')</script>";
	}
	else{
		echo "<script>alert('ERROR : UNABLE TO SAVE!')</script>";
	}
}
?>
<?php include "include/menu.php";
?>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-md-offset-3">
	          <h3 class="page-header">New Exam</h3>
				<form method="post" id="createTeacherForm" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
					<div class="form-group">
							<label>Exam Name</label>
							<input type="text" class="form-control" name="examname" id="examname" required>

					</div>
					<div class="form-group">
							<label>Date of Exam </label>
							<input type="date" class="form-control" name="date" id="date" required>

					</div>
					<div class="form-group">
							<label>Full Marks </label>
							<input type="text" class="form-control" name="fm" id="fm" required>

					</div>
					<div class="form-group">
							<label>Time (In Minutes) </label>
							<input type="text" class="form-control" name="time" id="time" pattern="{0-9}" required>

					</div>
					<div class="form-group">
							<label>Unlock Password </label>
							<input type="password" class="form-control" name="password" id="password"  required>

					</div>
					<div class="form-group">
                        	 <button type="submit" name="submit" id="submit" class="btn btn-info btn-md btn-block" value="null">Submit</button>
                    </div>
				</form>
				<font align="center">Exam Link: <b><?php echo $_SERVER['HTTP_HOST'];?>/exam</b></font>
		  		<!-- /col-md-6 -->
	 
			  		<!-- /col-md-4 -->
		 
		  	<!-- /col-md-12 -->
		    
	
	 	<!-- /row -->
      </div>
			</div>
		</div>
	</div>
</div>
</div>
<?php include('include/footer.php'); ?>
</body>
</html>