<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="">

	<meta name="author" content="">

	<title>Niharika Software</title>

	<!-- Bootstrap Core CSS -->





	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />

	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css">

	<link rel="stylesheet" href="http://jquery.malsup.com/block/block.css?v3">

	<!-- modal -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- MetisMenu CSS -->

	<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

	<!-- DataTables CSS -->

	<link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

	<!-- DataTables Responsive CSS -->

	<link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

	<!-- Custom CSS -->

	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">

	<!-- Custom Fonts -->

	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- Datepick -->

	<link href="../datepick_api/css_date/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

	<!--MultiSelect -->

	<link rel="stylesheet" href="../docs/css/bootstrap-example.css" type="text/css">

	<link rel="stylesheet" href="../docs/css/prettify.css" type="text/css">

	<link rel="stylesheet" href="../dist/css/bootstrap-multiselect.css" type="text/css">

</head>



<body>



	<div id="wrapper">



		<!-- Navigation -->

		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;">

			<div class="navbar-header">

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

					<span class="sr-only">Toggle navigation</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

				</button>

				<a class="navbar-brand" href="">Administrator Portal</a>

			</div>

			<!-- /.navbar-header -->



			<ul class="nav navbar-top-links navbar-right">


				<!-- /.dropdown-alerts -->

				<!-- /.dropdown -->

				<li class="dropdown">

					<a class="dropdown-toggle" data-toggle="dropdown" href="#">

						<i class="fa fa-user fa-fw"></i> ADMIN <i class="fa fa-caret-down"></i>

					</a>

					<ul class="dropdown-menu dropdown-message">

						<li><a href="changepassword.php"><i class="fa fa-shield fa-fw"></i> Change Password</a>

						</li>

						<li class="divider"></li>

						<li><a href="logout.php"><i class="fa fa-power-off fa-fw"></i> Logout</a>

						</li>

					</ul>

					<!-- /.dropdown-user -->

				</li>

				<!-- /.dropdown -->

			</ul>

			<!-- /.navbar-top-links -->



			<div class="navbar-default sidebar" role="navigation">

				<div class="sidebar-nav navbar-collapse">

					<ul class="nav" id="side-menu">

						<li>

							<a href="home.php"><i class="fa fa-dashboard fa-fw"></i> Dashbord</a>

						</li>

						<li>

							<a href="studentmanagement.php"><i class="fa fa-plus-circle"></i> Student Management</a>

						</li>


						<li>

							<a href="#"><i class="fa fa-rupee"></i> Payment<span class="fa arrow"></span></a>

							<ul class="nav nav-second-level">

								<li>

									<a href="franchisescollectform.php">Collect Fee</a>

								</li>

								<li>

									<a href="ledgerform.php">Payment Report</a>

								</li>

								<li>

									<a href="duelist.php">Due Report</a>

								</li>

								<!-- <li>

									<a href="cancelPayment.php">Delete Receipt </a>

								</li> -->

							</ul>

						</li>

						<li>

							<a href="#"><i class="fa fa-plus-circle"></i> Student Marks <span class="fa arrow"></a>
							<ul class="nav nav-second-level">

								<li>

									<a href="marks-entry.php"> Marks Entry</a>

								</li>

								<!-- <li>
									<a href="marks-edit.php"> Marks Edit</a>

								</li> -->

								<li>

									<a href="showallstudent.php"> Show All Student</a>

								</li>


							</ul>

						</li>



						<!-- <li>

							<a href="#"><i class="fa fa-paper-plane"></i> Exam Setting<span class="fa arrow"></span></a>

							<ul class="nav nav-second-level">

								<li>

									<a href="examcreate.php">Create Exam</a>

									<a href="examselect.php">Set Question</a>

									<a href="activeExam.php">Active Exam Link</a>

									<a href="loginsetting.php">Manage Student Login</a>

									<a href="setrule.php">Exam Rule & Description Setting</a>

									<a href="selectexam.php">Result</a>

									<a href="removeanswer.php">Remove Answer Record</a>

								</li>



							</ul>

						</li> -->

					</ul>



					<!-- /.nav-second-level -->



				</div>

				<!-- /.sidebar-collapse -->

			</div>

			<!-- /.navbar-static-side -->

		</nav>
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">

					<!--    <div class="x_panel">
                   <div class="x_content"> -->
					<h3 class="page-header">Marks Entry</h3>

					<form action="/computer_institute/institute/franchises/marks-entry.php" method="POST">
						<div class="form-group">

							<div class="col-md-2 col-sm-2 col-xs-12">
								<label>Session</label>
								<select name="session" id="session" class="form-control">
									<option value="">Select Session</option>
									<option value="2022">2022</option>
									<option value="2021">2021</option>
									<option value="2020">2020</option>
									<option value="2019">2019</option>
								</select>
							</div>
							<!-- <div class="col-md-3 col-sm-3 col-xs-12">

								<label>Franchise</label>
								<select name="franchise" id="franchise" class="form-control">
									<option value="">Select Franchise</option>
															</select>
									</div> -->
							<div class="col-md-2 col-sm-2 col-xs-12">
								<label>Course</label>
								<select name="course" id="course" class="form-control">
									<option value="">Select Course</option>
									<option value="1">BASIC</option>
									<option value="2">DCA</option>
									<option value="3">FA</option>
									<option value="4">DFA</option>
									<option value="5">SPOKEN ENGLISH</option>
									<option value="7">ASECC (ENGLISH)</option>
									<option value="8">ENGLISH (SCHOOL)</option>
									<option value="9">PKJ</option>
									<option value="10">AUTOCAD</option>
									<option value="11">DTP</option>
									<option value="12">ADFA</option>
									<option value="13">PRACTICE COURSE</option>
								</select>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-12">
								<label>Subject</label>
								<select name="subject" id="subject" class="form-control">
									<option value="">Select Subject</option>
								</select>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<label>&nbsp;</label>
								<button type="button" id="search" class="btn btn-info form-control">Search</button>
							</div>


							<div class="clearfix"></div>
						</div>

						<div class="form-group">
							<div class="col-sm-2 col-md-2 col-sm-offset-5 col-md-offset-5">

							</div>
						</div>
						<div class="clearfix"></div>

						<div>&nbsp;</div>
						<div class="table-responsive">
							<input type="hidden" name="formid" id="formid" value="131a19ca0fce3372b187f1f93c63e7a9">
							<table id="example" class="table table-stripped">
								<thead>
									<th style="text-align:left;"># </th>
									<th style="text-align:center;">Name</th>
									<th style="text-align:center;">Registration No </th>
									<th style="text-align:center;">Full Marks</th>
									<th style="text-align:center;">Obtained Marks</th>
								</thead>
								<tbody>

								</tbody>
							</table>
							<button type="submit" name="submit" id="submit" class="btn btn-success form-control">Save</button>
						</div>
					</form>

					<!-- /panel -->
				</div>

			</div>
		</div>
	</div>


	<!-- modal -->
	<div id="editMemberModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editMemberModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="myModalLabel">Update Password</h4>
				</div>
				<div id="editMessage"></div>
				<form method="post" id="updateMemberForm" class="form-horizontal" action="updateRecord.php">
					<div class="modal-body">
						<div class="messages"></div>
						<div id="testmodal" style="padding: 5px 20px;">
							<div class="form-group">
								<label class="col-sm-2 control-label">Password</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="password" name="password" required="required">
									<input type="hidden" id="q_id" name="q_id">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
						<button type="submit" id="modalSave" class="btn btn-primary antosubmit">Save changes</button>
					</div>
				</form>
			</div>
		</div>

	</div>

	<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Warning</h4>
				</div>
				<div class="modal-body">
					<font color="red">Do You Really Want To Remove This Info?</font>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-danger" id="removeBtn" name="removeBtn">Yes</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>

	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
	<script src="../js/file-validator.js" type="text/javascript" charset="utf-8"></script>
	<script src="../js/app.js"></script>

	<!-- Syntax Highlighting Support -->
	<script src="../highlighting/sh_main.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="../highlighting/sh_javascript_dom.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="../highlighting/sh_html.min.js" type="text/javascript" charset="utf-8"></script>
	<!-- End -->
	<script type="text/javascript" src="../docs/js/bootstrap-3.3.2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
	<!-- Metis Menu Plugin JavaScript -->
	<script src="../vendor/metisMenu/metisMenu.min.js"></script>
	<!-- DataTables JavaScript -->
	<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
	<script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
	<!-- Datepick -->
	<script type="text/javascript" src="../datepick_api/bootstrap_date/js/bootstrap.min_date.js"></script>
	<script type="text/javascript" src="../datepick_api/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
	<script type="text/javascript" src="../datepick_api/js/locales/bootstrap-datetimepicker.en.js" charset="UTF-8"></script>
	<!-- Custom Theme JavaScript -->
	<script src="../dist/js/sb-admin-2.js"></script>
	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js">
	</script>
	<!--MultiSelect -->
	<script type="text/javascript" src="../docs/js/prettify.js"></script>
	<script type="text/javascript" src="../dist/js/bootstrap-multiselect.js"></script>
	<!-- CK Editor -->
	<script src="../ckeditor/ckeditor.js"></script>
	<!--End-->
	<script src="../dist/js/sb-admin-2.js"></script>
	<!-- Tables Edit-->
	<script src="../jquery-tabledit/jquery.tabledit.min.js"></script>
	<div class="panel-footer">
		<p style="text-align:center;margin-top:6px;">&copy; Copyright Reserved By Niharika Software</p>
	</div>

</body>

</html>


<!-- /#page-wrapper -->



<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="vendor/metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>
<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js">
</script>
<!--MultiSelect -->
<script type="text/javascript" src="docs/js/prettify.js"></script>
<script type="text/javascript" src="dist/js/bootstrap-multiselect.js"></script>
<!-- CK Editor -->
<script src="ckeditor/ckeditor.js"></script>

<!-- Page-Level Demo Scripts - Notifications - Use for reference -->
<script type="text/javascript">
	$(document).ready(function() {

		$('#course').on('change', function(e) {
			var form = $('#myForm');
			$.ajax({
				url: "fetch-subjects.php",
				type: 'POST',
				data: {
					"course": $('#course').val()
				},
				dataType: 'json',
				success: function(response) {
					let option = '<option value="">Select Subject</option>';
					if (response.success) {
						for (i = 0; i < response.records.length; i++) {
							option += '<option value="' + response.records[i].id + '">' + response.records[i].subject + '</option>';
						}
						$('#subject').html(option);
					}
				}
			});

			return false;


		});

		$('#search').on('click', function(e) {
			// e.preventDefault();
			var form = $('#myForm');

			$.ajax({
				url: "fetch-marks.php",
				type: "POST",
				data: {
					"franchise": $('#franchise').val(),
					"course": $('#course').val(),
					"session": $('#session').val(),
					"subject": $('#subject').val(),
					"type": "insert"
				},
				dataType: 'json',
				success: function(response) {
					let option = '';
					if (response.success) {
						for (i = 0; i < response.records.length; i++) {
							option += '<tr>' +
								'<td style="text-align:center;"><input type="hidden" value="' + response.records[i].pusuing_id + '"  name="admissionId[]" id="admissionId' + i + '">' + (i + 1) + '</td>' +
								'<td style="text-align:center;"><input type="hidden" name="studentId[]" id="studentId' + response.records[i].student_id + '" value="' + response.records[i].student_id + '">' + response.records[i].St_Name + '</td>' +
								'<td style="text-align:center;">' + response.records[i].regno + '</td>' +
								'<td style="text-align:center;"><input type="hidden"  name="fullMarks[]" id="fullMarks' + i + '" value="' + response.records[i].full_marks + '">' + response.records[i].full_marks + '</td>' +
								'<td style="text-align:center;"><input type="number" class="form-control" name="obtainedMarks[]" id="obtainedMarks' + i + '"></td>' +
								'</tr>';
						}
						$('#example tbody').html(option);
					}
				}
			});
			return false;
		});
	});

	function editMember(id = null) {
		$('.messages').html("");
		$('#updateMemberForm')[0].reset();
		/* alert(id); */
		if (id) {

			$.ajax({
				url: 'getSelectedRecord.php',
				type: 'post',
				data: {
					member_id: id
				},
				dataType: 'json',
				success: function(response) {
					/* alert(response.id); */
					$("#password").val(response.password);
					$("#q_id").val(response.id);
				}
			});


		} else {
			alert("Error : Refresh the page again");
		}
	}

	function removeMember(id = null) {
		if (id) {
			$('#removeBtn').unbind('click').bind('click', function() {

				$.ajax({
					url: 'removeRecord.php',
					type: 'post',
					data: {
						member_id: id
					},
					dataType: 'json',
					success: function(response) {
						if (response.success == true) {
							$(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
								'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
								'<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
								'</div>');

							// refresh the table
							reload($('#examid').val(), $('#course').val(), $('#year').val(), $('#month').val());

							// close the modal
							$("#removeMemberModal").modal('hide');

						} else {
							$(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
								'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
								'<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
								'</div>');
						}
					}
				});

			});
		}

	}
</script>

</body>

</html>