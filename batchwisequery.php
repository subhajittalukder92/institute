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

function getSession()
{
	include "include/dbconfig.php" ;
	$sql="SELECT * FROM `session`";
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		while($row=mysqli_fetch_assoc($res))
		{
			echo '<option value="'.$row['slno'].'">'.$row['session_code']."-".$row['description'].'</option>';
		}
	}
}
include('include/menu.php');?>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-md-offset-3">
	          <h3 class="page-header">Batchwise Query</h3>
				<form method="post" id="createTeacherForm" action="showresult.php" enctype="multipart/form-data">
					<div class="form-group">
						<label for="product" class="control-label">Franchise Name<span class="required"></span></label>
						<select name="franchise" id="franchise" class="selectpicker form-control" data-live-search="true" required>
							<option value="">Select Franchise</option>
							<?php getFranchise(); ?>
						</select>
					</div>
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
						<label for="product" class="control-label">Batch Time<span class="required"></span></label>
						<select id="time" name="time"  class="form-control" required>
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