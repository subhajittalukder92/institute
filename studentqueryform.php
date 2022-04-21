<?php 
session_start();
include('include/check-login.php');
error_reporting(0);
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
	$sql="SELECT * FROM `session`";
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		while($row=mysqli_fetch_assoc($res))
		{
			echo '<option value="'.$row['session_code'].'">'.$row['session_code']."-".$row['description'].'</option>';
		}
	}
}
include('include/menu.php');?>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-md-offset-3">
	          <h3 class="page-header">Student Query Month ,Course & Session wise</h3>
				<form method="post" id="createTeacherForm" action="showstudents.php" enctype="multipart/form-data">
					<div class="form-group">
						<label for="product" class="control-label">Session<span class="required"></span></label>
						<select  id="session" name="session" class="form-control"  required>
							<option value="">--Select--</value>
							<?php getSession(); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="product" class="control-label">Course<span class="required"></span></label>
						<select  id="course"  name="course"  class="form-control col-md-7 col-xs-12" required>
							<option value="">--Select--</option>
							<?php getCourses(); ?>
						</select>
					</div>
					<div>&nbsp;</div>
					<div class="form-group">
						<label for="product" class="control-label">Admission Month<span class="required"></span></label>
						<select id="month" name="month"  class="form-control">
							<option value="">--Select--</option>
							<option value="1">JANUARY</option>
							<option value="4">APRIL</option>
							<option value="7">JULY</option>
							<option value="10">OCTOBER</option>
						<select>
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