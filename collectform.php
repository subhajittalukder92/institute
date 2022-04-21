<?php
session_start();
include('include/no-cache.php');
include('include/dbconfig.php');
include('include/check-login.php');
function  getCandidates()
{
	include('include/dbconfig.php');
	$option = '';
	$sql = "SELECT pursuing_course.*,student_info.*
		FROM `pursuing_course`
		INNER JOIN student_info
		ON student_info.Student_Id=pursuing_course.student_id
		WHERE pursuing_course.current_status='PURSUING'
		GROUP BY pursuing_course.student_id";
	$res = mysqli_query($conn,  $sql);
	while ($row = mysqli_fetch_assoc($res)) {
		$option .= '<option value="' . $row['student_id'] . '">' . $row['regno'] . "-" . $row['St_Name'] . "-" . $row['Fathers_Name'] . '</option>';
	}
	echo $option;
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
<?php include('include/menu.php'); ?>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-md-offset-3">
				<h3 class="page-header">Fees Collection</h3>
				<form method="GET" id="createTeacherForm" action="feecollect.php" enctype="multipart/form-data">
					<div class="form-group">
						<label for="product" class="control-label">Franchise Name<span class="required"></span></label>
						<select name="franchise" id="franchise" class="selectpicker form-control" data-live-search="true" required>
							<option value="">Select Franchise</option>
							<?php getFranchise(); ?>
						</select>
					</div>
				<!-- 	<form method="GET" id="createTeacherForm" action="feecollect.php" enctype="multipart/form-data"> -->
						<div class="form-group">
							<label for="product" class="control-label">Candidate Name<span class="required"></span></label>
							<select name="studentid" id="studentid" class="selectpicker form-control" data-live-search="true" required>
								<option value="">Select Candidate</option>
								<?php // getCandidates();
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Pursuing Course</label>
							<select class="form-control" name="pursuingcourse" id="pursuingcourse">
								<option value="">--Select--</option>
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
	$(document).ready(function(e) {
		$('#studentid').on('change', function(e) {
			var studentid = $(this).val();
			$.ajax({
				url: "loadCourse.php",
				method: "post",
				data: {
					'studentid': studentid
				},
				success: function(data) {
					$('#pursuingcourse').html(data);
				}

			});

		});
		$('#franchise').on('change', function(e) {
			var franchiseId = $(this).val();
			$.ajax({
				url: "loadStudentByFranchise.php",
				method: "post",
				data: {
					'franchiseId': franchiseId
				},
				dataType: "json",
				success: function(data) {
					
					let option = '<option value="">Select Candidate </option>';
					if (data.success) {

						for (i = 0; i < data.records.length; i++) {
							option += '<option value="' + data.records[i].slno + '">' + data.records[i].St_Name + '-' + data.records[i].Contact_no + '</option>'
						}
					}
					$('#studentid').html(option);
					$('#studentid').selectpicker('refresh');
				}

			});

		});
	});
</script>