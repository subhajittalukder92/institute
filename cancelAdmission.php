<?php 
session_start();
include('include/no-cache.php');
include('include/dbconfig.php'); 
include('include/check-login.php');
if(isset($_POST['submit']))
{
	$studentid		 = trim($_POST['studentid'])     ;
	$pursuingcourse  = trim($_POST['pursuingcourse']);
	
	$sql1="DELETE FROM `student_info` WHERE `Student_Id`='$studentid'";
	$sql2="DELETE FROM `pursuing_course` WHERE `student_id`='$studentid' AND `course_id`='$pursuingcourse'";
	$sql3="DELETE FROM `daybook` WHERE `student_id`='$studentid' AND `course_id`='$pursuingcourse'";
	$sql4="DELETE FROM `payment` WHERE `student_id`='$studentid' AND course_id='$pursuingcourse'";
	$res3=mysqli_query($conn,  $sql3);
	
	if($res3)
	{
		$res2=mysqli_query($conn,  $sql2);
		if($res2)
		{
			$res1=mysqli_query($conn,  $sql1);
			if($res1)
			{
				$res4=mysqli_query($conn,  $sql4);
				if($res4)
				{
					echo '<script>alert("Canceled Successfully !") </script>';
				}
				else{
					echo '<script>alert("ERROR-4 : OPERATION FAILED !") </script>';
				}
			}
			else{
				echo '<script>alert("ERROR-1 : OPERATION FAILED !") </script>';
			}
		}
		else{
				echo '<script>alert("ERROR-2 : OPERATION FAILED !") </script>';
			}
	}
	else{
		echo '<script>alert("ERROR-3 : OPERATION FAILED !") </script>';
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
?>
<?php include('include/menu.php');?>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-md-offset-3">
	          <h3 class="page-header">Cancel Admission</h3>
				<form method="POST" id="createTeacherForm" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
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
                        	 <button type="submit" name="submit" id="submit" class="btn btn-info btn-md btn-block" value="null">Cancel Now</button>
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
	$('form').on('submit',function(e){
		var ress = confirm("Are You Sure To Cancel This Admission ??");
		if(ress)
		{
			return true;
		}
		else{
			e.preventDefault();
			return false;
		}
	});
});
</script>

 