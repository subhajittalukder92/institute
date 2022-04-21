<?php 
session_start();
include('include/check-login.php');
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
		$option.='<option value="'.$row['student_id'].'">'.$row['St_Name']."-".$row['Fathers_Name'].'</option>';
	}
	echo $option;
}
function getCourses()
{
	include ('include/dbconfig.php');
	$sql="SELECT * FROM `courses` group by `course_name`";
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
	          <h3 class="page-header">Due List</h3>
				<form method="post" id="createTeacherForm" action="duelist.php" enctype="multipart/form-data">
					<div class="form-group">
							<label>Course Name</label>
							<select class="form-control" name="coursename" id="coursename" required>
								<option value="">--Select--	 </option>
								<option value="ALL">ALL </option>
								<?php getCourses(); ?>
							</select>
					</div>
					<div class="form-group">
						<div class="form-group">
							<label for="product" class="control-label">Candidate Name<span class="required"></span></label>
							<select name="studentid"  id="studentid" class="selectpicker form-control"  data-live-search="true" required>
								<option value="">--Select--</option>
								<option value="ALL">ALL </option>
								<?php getCandidates();?>
							</select>
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
