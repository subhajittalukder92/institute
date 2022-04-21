<?php
session_start();
function getItems()
{
	include('include/dbconfig.php');
	$sql = "SELECT * FROM `courses`";
	$res = mysqli_query($conn,  $sql);
	if (mysqli_num_rows($res) > 0) {
		while ($row = mysqli_fetch_assoc($res)) {
			echo '
				<tr>
					<td style="text-align:center">' . $row['course_name'] . '</td>
					<td style="text-align:center">' . $row['description'] . '</td>
					<td style="text-align:center">' . $row['duration'] . '</td>
					<td style="text-align:center">' . $row['unit'] . '</td>
					<td style="text-align:center">' . $row['course_fee'] . '</td>
					<td style="text-align:center">' . $row['fee_type'] . '</td>
				</tr>
				';
		}
	}
}
include('include/menu.php'); ?>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-10 col-md-10 col-xs-12">
				<h3 class="page-header">Add New Course</h3>
				<form class="form-horizontal" method="post" id="createTeacherForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
					<div id="add-course-messages"></div>
					<div class="form-group">
						<label for="fname" class="col-sm-4 control-label">Course Name : </label>
						<div class="col-sm-8">
							<input type="text" required class="form-control" id="coursename" name="coursename" placeholder="Course Name" />
						</div>
					</div>
					<div class="form-group">
						<label for="fname" class="col-sm-4 control-label">Course Code : </label>
						<div class="col-sm-8">
							<input type="text" required class="form-control" id="courseid" name="courseid" placeholder="Course Id" />
						</div>
					</div>
					<div class="form-group">
						<label for="lname" class="col-sm-4 control-label">Description: </label>
						<div class="col-sm-8">
							<textarea class="form-control" id="description" name="description"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="dob" class="col-sm-4 control-label">Duration: </label>
						<div class="col-sm-8">
							<input type="text" required class="form-control" id="cdescription" name="cdescription" placeholder="Duration" />
						</div>
					</div>
					<div class="form-group">
						<label for="dob" class="col-sm-4 control-label">Eligibility: </label>
						<div class="col-sm-8">
							<input type="text" required class="form-control" id="eligibility" name="eligibility" placeholder="Eligibility" />
						</div>
					</div>
					<div class="form-group">
						<label for="age" class="col-sm-4 control-label">Duration Unit: </label>
						<div class="col-sm-8">
							<input type="text" required class="form-control" id="unit" name="unit" placeholder="Month/Year" />
						</div>
					</div>
					<div class="form-group">
						<label for="contact" class="col-sm-4 control-label">Course Fee: </label>
						<div class="col-sm-8">
							<input type="text" required class="form-control" id="fees" name="fees" />
						</div>
					</div>
					<!-- <div class="form-group">
						<label for="feetype" class="col-sm-4 control-label">Fee Type: </label>
						<div class="col-sm-8">
							<input type="text" required class="form-control" id="feetype" name="feetype" />
						</div>
					</div> -->

					<div class="form-group">
						<button type="submit" name="submit" id="submit" class="btn btn-primary btn-md btn-block">Submit</button>
					</div>
					<!-- /col-md-6 -->


					<!-- /col-md-4 -->

					<!-- /col-md-12 -->


					<!-- /row -->
			</div>

			</form>

		</div>

		<!-- add teacher -->
		<div class="modal fade" tabindex="-1" role="dialog" id="addCourse">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Add Course</h4>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>

<!-- /#wrapper -->
<?php include('include/footer.php'); ?>

</body>

</html>
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script>
	$(document).ready(function() {
		CKEDITOR.replace('description');
		var table = $('#example').DataTable({
			lengthChange: false,
			buttons: ['copy', 'excel', 'pdf', 'colvis']
		});

		CourseTable = $("#manageCourseTable").DataTable({});

		table.buttons().container()
			.appendTo('#example_wrapper .col-sm-6:eq(0)');

		$('form').on('submit', function(e) {
			$.ajax({
				url: "insertCourse.php",
				method: "post",
				data: $("#createTeacherForm").serialize(),
				dataType: 'json',
				success: function(data) {
					if (data) {
						$("#add-course-messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
							'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Successfully Course Added</div>');
						clearForm();

					} else {
						$("#add-course-messages").html('<div class="alert alert-danger alert-dismissible" role="alert">' +
							'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error : Unable To Save ! </div>');

					}

				}

			});

			return false;
		});

		function clearForm() {
			$('input[type="text"]').val('');
			$('select').val('');

		}
	});
</script>