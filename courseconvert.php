<?php 
session_start();
include('include/no-cache.php');
include('include/dbconfig.php'); 
include('include/check-login.php');
include "functions.php";
if(isset($_POST['formid']) && isset($_SESSION['formid']) && $_POST['formid'] == $_SESSION['formid'])
{
	extract($_POST);
	$serialno		= findSerialNo($sessionCode,$course);
	$regno			= findStudentRegistraionNo($sessionCode,$course);
	$dateInfo		= explode('-',$date);
	$newStid		=findMaxID($dateInfo[0]);
	$result		= addToStudentInfo($newStid,$studentid,$regno,$dateInfo[0],$sessionCode,$date);
	if($result)
	{
		$k=addStudentToPursuingTable($course,$newStid,$dateInfo[0],$fees,$date,$sessionCode,$course,$serialno,$courseday,$time,(int)$dateInfo[1]);
		if($k)
		{	
			updatePaymentRecord($newStid,$studentid,$course);
			echo '<script> alert("Conversion Successful")</script>';
		}
		else{
			echo '<script> alert("ERROR :  PROCESS FAILED.")</script>';
		}
	}
	else{
			echo '<script> alert("ERROR :  PROCESS FAILED.")</script>';
		}
	$_SESSION['formid']=md5(rand(0,10000000));	


}
else{
	
	$_SESSION['formid']=md5(rand(0,10000000));
}
function addToStudentInfo($newStid,$studentid,$regno,$Session,$sessionCode,$date)
{
	include "dbconfig.php";
	$info=fetchInfoById($studentid) ;
	
	$sql    	= "INSERT INTO `student_info`(`Student_Id`, `St_Name`, `Fathers_Name`, `DOB`, `Gender`, `Cust`, `Religion`, 
				 `Mother_Trong`, `Session1`,`session_month`,`session_code`, `Roll`, `DOA`, `Mothers_Name`, `adminslno`, `Vill`, `Post`, `PS`, `Dist`, `Pin`, 
				 `Contact_no`,`contact2`,`aadhar`, `qualification`, `regno`,`image_name`,`previous_course`,`previous_inst`,`ref_name`,`admission_type`,`convert_from`)
				  VALUES ('$newStid','$info[St_Name]','$info[Fathers_Name]','$info[DOB]','$info[Gender]','$info[Cust]','$info[Religion]','$info[Mother_Trong]','$Session','','$sessionCode','',
				 '$date','$info[Mothers_Name]','','$info[Vill]','$info[Post]','$info[PS]','$info[Dist]','$info[Pin]','$info[Contact_no]','$info[contact2]','$info[aadhar]',
				 '$info[qualification]','$regno','$info[0]','$info[previous_course]','$info[previous_inst]','$info[ref_name]','DIPLOMA CONVERSION','$info[slno]')" ;
	$res=mysqli_query($conn,  $sql);
	if($res)
	{
		return true;
	}
	else{
		return false;
	}
	
}
function updatePaymentRecord($newStid,$oldStid,$courseCode)
{
	include "include/dbconfig.php" ;
	$sql = "UPDATE `payment` SET `course_id`='$courseCode',`student_id`='$newStid' WHERE `student_id`='$oldStid'" ;
	$res = mysqli_query($conn,  $sql) ; 
	if($res)
	{
		$query="UPDATE `pursuing_course` SET `remarks`='TRANSFERED' WHERE `student_id`='$oldStid'" ;
		$ress = mysqli_query($conn,  $query) ; 
		if($ress)
		{
			return true;
		}
		else{
			return false;
		}
	}
}
function findMaxID($session)
{
	include "include/dbconfig.php" ;
	$studentID=null;
	if($session!="")
	{
		$sql="SELECT MAX(`Student_Id`) AS stid FROM `student_info` WHERE `Session1`='$session'";
		/* echo $sql; */
		$res = mysqli_query($conn,  $sql)	;
		$row = mysqli_fetch_assoc($res);
		if($row['stid'] == null)
		{
			$year		= (string)$session;
			$studentID  = $year."001";
			return $studentID;
		}
		else{
			$studentID	=$row['stid'] +1;
			return $studentID;
		}
	}
}
function fetchInfoById($studentID)
{
	include('include/dbconfig.php'); 
	$sql="SELECT * FROM `student_info` WHERE `Student_Id`='$studentID'";
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		$row = mysqli_fetch_assoc($res) ;
		return $row ;
	}
	
}
function addStudentToPursuingTable($course,$studentID,$session,$fees,$date,$sessioncode,$coursecode,$serialno,$courseday,$time,$month)
{
	include "include/dbconfig.php" ;
	$courseday		= implode(',',$courseday);
	$sql="INSERT INTO `pursuing_course`(`session`,`date`,`student_id`, `course_id`,`course_code`, `session_code`, `serial_no`, `course_fee`, `course_days` ,`time`
		 ,`starting_year`, `starting_month`,`remarks`)
		  VALUES ('$session','$date','$studentID','$course','$coursecode','$sessioncode','$serialno','$fees','$courseday','$time','$session','$month','DIPLOMA CONVERSION')";
	$res = mysqli_query($conn,  $sql);
	$pursuing_id=mysqli_insert_id($conn);
	if($res)
	{
		return  true;
	}
	else{
		return false;
	}
	
}
function  getCandidates()
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
		$option.='<option value="'.$row['student_id'].'">'.$row['regno']."-".$row['St_Name']."-".$row['Fathers_Name'].'</option>';
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
function getSession()
{
	include "include/dbconfig.php" ;
	$sql="SELECT * FROM `session` WHERE `status`='ACTIVE'";
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		while($row=mysqli_fetch_assoc($res))
		{
			echo '<option value="'.$row['session_code'].'">'.$row['session_code']."-".$row['description'].'</option>';
		}
	}
}

?>
<?php include('include/menu.php');?>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-md-offset-3">
	          <h3 class="page-header">Course Conversion</h3>
				<form method="post" id="createTeacherForm" action="<?php echo $_SERVER['PHP_SELF'] ; ?>" enctype="multipart/form-data">
					<input type="hidden" name="formid" id="formid" value="<?php echo htmlspecialchars($_SESSION['formid']);?>">
					<div class="form-group">
						<label for="product" class="control-label">Candidate Name<span class="required"></span></label>
						<select name="studentid"  id="studentid" class="selectpicker form-control"  data-live-search="true" required>
							<option value="">--Select--</option>
							<?php getCandidates();?>
						</select>
					</div>
					<div class="form-group">
						<label>Pursuing Course</label>
						 <select class="form-control" name="pursuingcourse" id="pursuingcourse">
							<option value="">--Select--</option>
						 </select>
					</div>
					<div class="form-group">
						<label>Session</label>
						 <select class="form-control" name="sessionCode" id="sessionCode">
							<option value="">--Select--</option>
							<?php getSession(); ?>
						 </select>
					</div>
					<div class="row">
					<div class="form-group">
						<div class="col-sm-6 col-md-6 col-xs-12">
							<label>Converted Course</label>
						<select class="form-control" name="course" id="course">
							<option value="">--Select--</option>
							<?php getCourses(); ?>
						 </select>
						
						</div>
						<div class="col-sm-6 col-md-6 col-xs-12">
						<label>Registration Id</label>
						 <input type="text" class="form-control" name="registrationNo" id="registrationNo" readonly>
							
						</div>
						<div class="clearfix"></div>
					</div>
					
					</div>
					<div class="form-group">
						<label>Course Fees</label>
						 <input type="text" class="form-control" name="fees" id="fees" >
					</div>
					<div class="form-group">
						<label>Admission Date</label>
						 <input type="date" class="form-control" name="date" id="date" value="<?php echo date('Y-m-d') ;?>">
					</div>
					<div class="row">
					<div class="form-group">
						<div class="col-sm-6 col-md-6">
							<label>Time</label>
							<select id="time" name="time"  class="form-control" >
								<option value="">--Select--</option>
								<option value="06.00 AM">06.00 AM</option>
								<option value="07.00 AM">07.00 AM</option>
								<option value="08.00 AM">08.00 AM</option>
								<option value="10.00 AM">10.00 AM</option>
								<option value="11.00 AM">11.00 AM</option>
								<option value="12.00 PM">12.00 PM</option>
								<option value="01.00 PM">01.00 PM</option>
								<option value="02.00 PM">02.00 PM</option>
								<option value="03.00 PM">03.00 PM</option>
								<option value="04.00 PM">04.00 PM</option>
								<option value="05.00 PM">05.00 PM</option>
								<option value="06.00 PM">06.00 PM</option>
								<option value="07.00 PM">07.00 PM</option>
								<option value="08.00 PM">08.00 PM</option>
							</select>
						</div>
						<div class="col-sm-6">
						<label>Course Day</label>
							<select id="courseday" name="courseday[]" multiple class="form-control selectpicker" >
								<option value="MON">MONDAY		</option>
								<option value="TUE">TUESDAY		</option>
								<option value="WED">WEDNESDAY	</option>
								<option value="THU">THURSDAY	</option>
								<option value="FRI">FRIDAY		</option>
								<option value="SAT">SATURDAY	</option>
								<option value="SUN">SUNDAY		</option>
							</select>
						</div>
						<div class="clearfix"></div>
					</div>
					</div>
					<div class="form-group">
                        	 <button type="submit" name="submit" id="submit" class="btn btn-info btn-md btn-block" value="null">Submit</button>
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
<script type="text/javascript">
$(document).ready(function(e){
		$('#sessionCode , #course').on('change',function(){
		if($('#sessionCode').val() !="" && $('#course').val() != "")
		{
			$.ajax({
					url:"getRegistrationNo.php",
					method:"post",
					data:{
						'sessionCode':$('#sessionCode').val(),
						'course':  $('#course').val()
					},
					success:function(data)
					{
						$('#registrationNo').val(data);
					}
				});
		}
	});
	$('#course').on('change',function(e){
		if($('#pursuingcourse').val() != "")
		{
			 $.ajax({
				 url:"findCombinedCourseFees.php",
				 method:"post",
				 data:{'newcourseid':$('#course').val(),
					   'oldcourseid':$('#pursuingcourse').val()
					   },
				 success:function(data)
				 {
					 $('#fees').val(data);
				 }
			 });
		}
 });
	$('#studentid').on('change',function(e)
	{
		var studentid = $(this).val();
		$.ajax({
			url:"loadCourse.php",
			method:"post",
			data:{'studentid':studentid},
			success:function(data)
			{
				$('#pursuingcourse').html(data);
			}
			
		});
	
	});
});
</script>

 