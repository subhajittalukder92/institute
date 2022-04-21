<?php session_start();
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
			$option.='<option value="'.$row['id'].'">'.$row['course_name'].'-'.$row['description'].'</option>';
		}
		echo $option;
	}
}                                  

function  getFranchise()
{
	include('include/dbconfig.php');
	$option = '';
	$sql = "SELECT * FROM `franchises`";
	$res = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($res)) {
		$option .= '<option value="' . $row['id'] . '">' . $row['franchise_name'] . '</option>';
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
	          <h3 class="page-header">Coursewise Admission</h3>
				<form method="post" id="createTeacherForm" action="coursewisereport.php" enctype="multipart/form-data">
					<div class="form-group">
						<label for="product" class="control-label">Franchise Name<span class="required"></span></label>
						<select name="franchise" id="franchise" class="selectpicker form-control" data-live-search="true" required>
							<option value="">Select Franchise</option>
							<?php getFranchise(); ?>
						</select>
					</div>
					<div class="form-group">
							<label>Course Name</label>
							<select class="form-control" name="course" id="course" required>
								<option value="">--Select--	 </option>
								<option value="ALL">ALL </option>
								<?php getCourses(); ?>
							</select>
					</div>
					<div class="form-group">
						<label>From</label>
						 <div class="input-group date form_date col-md-16" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
								<input class="form-control" type="text" name="from" id="from" value="" required autocomplete="off">
								<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>

					</div>
					<div class="form-group">
						<label>To</label>
						 <div class="input-group date form_date col-md-16" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
								<input class="form-control" type="text" name="to" id="to" value="" required autocomplete="off">
								<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
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
