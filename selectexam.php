<?php 
session_start();
include "include/no-cache.php";
include "include/dbconfig.php";
include "include/check-login.php";
if(isset($_POST['submit']))
{

	$examname	= strtoupper(trim($_POST['examname']));
	$date		= trim($_POST['date']);
	$sql		= "INSERT INTO `examinfo`(`exam_name`,`date`) 
				  VALUES ('$examname','$date')";
	$res		= mysqli_query($conn,  $sql);
	if($res)
	{
		echo "<script>alert('Exam Name Saved.')</script>";
	}
	else{
		echo "<script>alert('ERROR : UNABLE TO SAVE!')</script>";
	}
}
function getExamName()
{
	include "include/dbconfig.php";
	
	$sql="SELECT * FROM `examinfo`";
	/* echo $sql; */
	$res=mysqli_query($conn,  $sql);
	$option='';
	while($row=mysqli_fetch_assoc($res))
	{
		$option.='<option value="'.$row['id'].'">'.$row['exam_name'].'</option>';
	}
	echo $option;
}
function getCourses()
{
	include ('include/dbconfig.php');
	$sql="SELECT * FROM `courses` ORDER BY `course_name`";
	$res=mysqli_query($conn,  $sql);
	$option='';
	if(mysqli_num_rows($res) > 0)
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$option.='<option value="'.$row['course_id'].'">'.$row['course_name'].'-'.$row['description'].'</option>';
		}
		echo $option;
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
	          <h3 class="page-header">Result </h3>
				<form method="GET" id="createTeacherForm" action="viewresults.php" enctype="multipart/form-data">
					<div class="form-group">
							<label>Exam Name</label>
							<select class="form-control" name="examname" id="examname" required>
								<option value="">--Select--</option>
								<?php getExamName();?>
							</select>

					</div>
					<div class="form-group">
							<label>Course </label>
							<select  id="course"  name="course"  class="form-control" required >
								<option value="">--Select--</option>
								<?php getCourses(); ?>
							</select>

					</div>
					<div class="form-group">
                        	 <button type="submit" id="submit" class="btn btn-info btn-md btn-block" value="null">Submit</button>
                    </div>
				</form>
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