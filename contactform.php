<?php 
session_start();
include('include/no-cache.php');
include('include/dbconfig.php'); 
include('include/check-login.php');

if(isset($_POST['formid']) && isset($_SESSION['formid']) && $_POST['formid'] == $_SESSION['formid'])
{
	
	$name			= strtoupper(trim($_POST['studentname']));
	$dob 			= strtoupper(trim($_POST['dob']));
	$date 			= strtoupper(trim($_POST['date']));
	$gurdian		= strtoupper(trim($_POST['gurdian']));
	$address		= strtoupper(trim($_POST['address']));
	$contact1		= strtoupper(trim($_POST['contact1']));
	$contact2		= strtoupper(trim($_POST['contact2']));
	$qualification	= strtoupper(trim($_POST['qualification']));
	$course			= strtoupper(trim($_POST['course']));
	$prevcourse		= strtoupper(trim($_POST['prevcourse']));
	$mode			= strtoupper(trim($_POST['mode']));
	
	$sql			="INSERT INTO `contact_list`(`date`,`student_name`, `gurdian`, `address`, `contact1`, `contact2`,
					`query_course`, `qualification`, `previous_course`, `know_from`, `dob`) 
					VALUES ('$date','$name','$gurdian','$address','$contact1','$contact2','$course','$qualification','$prevcourse'
					,'$mode','$mode')";
	$res			=mysqli_query($conn,  $sql);
	if($res)
	{
		echo '
			<script>
					alert("Successsfully Saved");
			</script>
		';
	}
	else{
		echo '
			<script>
					alert("ERROR : Could not Saved");
			</script>
		';
	}
	$_SESSION['formid']=md5(rand(0,10000000));	
}
else{
	$_SESSION['formid']=md5(rand(0,10000000));	
}
function getCandidates()
{
	include('include/dbconfig.php'); 
	$option='';
	$sql="SELECT pursuing_course.*,student_info.*
		FROM `pursuing_course`
		INNER JOIN student_info
		ON student_info.Student_Id=pursuing_course.student_id
		WHERE pursuing_course.current_status='PURSUING'
		GROUP BY pursuing_course.student_id";
	$res=mysqli_query($conn,  $sql)        ;
	while($row=mysqli_fetch_assoc($res))
	{
		$option.='<option value="'.$row['student_id'].'">'.$row['St_Name']."-".$row['Fathers_Name'].'</option>';
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
<?php include('include/menu.php');?>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-md-offset-3">
	          <h3 class="page-header">Student Information & Query Details</h3>
				<form method="POST" id="createTeacherForm" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
					<div class="form-group">
						<label for="product" class="control-label">Candidate Name<span class="required"></span></label>
						<input type="text" name="studentname"  id="studentname" class="form-control" required>

					</div>
					<div class="form-group">
						<label >DOB: <span class="required"></span>
						</label>
						<div class="input-group date form_date col-md-16" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
							<input class="form-control" type="text" name="dob" id="dob" required autocomplete="off" readonly>
							<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>
					</div>
					<div class="form-group">
						<label>Gurdian Name</label>
						 <input type="text" name="gurdian" class="form-control" id="gurdian" required>
					</div>
					<div class="form-group">
						<label>Address</label>
						 <input type="text" name="address" class="form-control" id="address" required>
					</div>
					<div class="form-group">
						<label>Mobile-1</label>
						 <input type="text" name="contact1" class="form-control" id="contact1" >
					</div>
					<div class="form-group">
						<label>Mobile-2</label>
						 <input type="text" name="contact2" class="form-control" id="contact2" >
					</div>
					<div class="form-group">
						<label>Education Qualification</label>
						 <input type="text" name="qualification" class="form-control" id="qualification" required>
					</div>
					<div class="form-group">
						<label>Course Looking For</label>
						 <select  name="course" class="form-control" id="course" required>
							<option value="">--Select--</option>
							<?php getCourses();    ?>
						 </select>
					</div>
					<div class="form-group">
						<label>How Candidate Know About CJNYCTC ?</label>
						 <select  name="mode" class="form-control" id="mode" required>
							<option value="">--Select--</option>
							<option value="HAND BILL">HAND BILL</option>
							<option value="FLEX">FLEX</option>
							<option value="NEWS PAPER">NEWS PAPER</option>
							<option value="MIKING ADVT.">MIKING ADVT.</option>
							<option value="BY EX-STUDENT">BY EX-STUDENT</option>
							<option value="SOCIAL MEDIA">SOCIAL MEDIA</option>
							<option value="BY SELF">BY SELF</option>
						 </select>
					</div>
					<div class="form-group">
						<label>Any Course Previously Completed ? Mention Details</label>
						 <input type="text" name="prevcourse" class="form-control" id="prevcourse" >
					</div>
					<div class="form-group">
						<label >Today Date: <span class="required"></span>
						</label>
						<div class="input-group date form_date col-md-16" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
							<input class="form-control" type="text" name="date" id="date" value="<?php echo date('Y-m-d');?>" required autocomplete="off" readonly>
							<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>
					</div>
					<div class="form-group">
                        	 <button type="submit" name="submit" id="submit" class="btn btn-info btn-md btn-block" value="null">Submit</button>
                   
                    </div>
					<input type="hidden" name="formid" id="formid" value="<?php echo htmlspecialchars($_SESSION['formid']);?>">
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
<script type="text/javascript">
$(document).ready(function(e){
	$('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
});
</script>

 