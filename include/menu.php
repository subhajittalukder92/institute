<?php

include('include/check-login.php');

?>

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

	<!-- MetisMenu CSS -->

	<link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

	<!-- DataTables CSS -->

	<link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

	<!-- DataTables Responsive CSS -->

	<link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

	<!-- Custom CSS -->

	<link href="dist/css/sb-admin-2.css" rel="stylesheet">

	<!-- Custom Fonts -->

	<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- Datepick -->

	<link href="datepick_api/css_date/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

	<!--MultiSelect -->

	<link rel="stylesheet" href="docs/css/bootstrap-example.css" type="text/css">

	<link rel="stylesheet" href="docs/css/prettify.css" type="text/css">

	<link rel="stylesheet" href="dist/css/bootstrap-multiselect.css" type="text/css">

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

				</li>

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

							<a href="#"><i class="fa fa-bookmark"></i> Session Creator<span class="fa arrow"></span></a>

							<ul class="nav nav-second-level">

								<li>

									<a href="session.php">Manage Session</a>

								</li>



							</ul>

						</li>

						<li>

							<a href="#"><i class="fa fa-users"></i> Manage User<span class="fa arrow"></span></a>

							<ul class="nav nav-second-level">

								<li>

									<a href="user.php">User Management</a>

								</li>



							</ul>

						</li>

						<li>

							<a href="#"><i class="fa fa-plus-circle"></i> Registration Section<span class="fa arrow"></span></a>

							<ul class="nav nav-second-level">

								<li>

									<a href="newadmission.php">New Registration</a>

								</li>

								<li>

									<a href="admissionformprint.php">Print Admission-Form</a>

								</li>

								<li>

									<a href="cancelAdmission.php">Cancel Registration</a>

								</li>

								<li>

									<a href="courseconvert.php">Course Convert</a>

								</li>



							</ul>

						</li>

						<li>

							<a href="#"><i class="fa fa-plus-circle"></i> Notice<span class="fa arrow"></span></a>

							<ul class="nav nav-second-level">

								<li>

									<a href="newnotice.php">New Notice</a>

								</li>

								<li>

									<a href="notices.php">Manage Notice</a>

								</li>



							</ul>

						</li>

						<li>

							<a href="#"><i class="fa fa-th-list"></i> Course Creator<span class="fa arrow"></span></a>

							<ul class="nav nav-second-level">

								<li>

									<a href="newcourses.php">Add New Course</a>

								</li>

								<li>

									<a href="viewcourses.php">View Course</a>

								</li>



							</ul>

						</li>

						<li>

							<a href="#"><i class="fa fa-th-list"></i> Subjects <span class="fa arrow"></span></a>

							<ul class="nav nav-second-level">

								<li>

									<a href="newsubject.php">Add New Subject</a>

								</li>

								<li>

									<a href="viewsubject.php">View Subject</a>

								</li>



							</ul>

						</li>
						<li>
							<a href="#"><i class="fa fa-th-list"></i> Marks Section <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
									<a href="marks-entry.php">Marks Entry</a>
									<a href="marks-edit.php">Marks Edit</a>
									<a href="marks-tabulation.php">Marks Tabulation</a>
								</li>

							</ul>
						</li>
						<li>
							<a href="#"><i class="fa fa-rupee "></i> Franchise<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
									<a href="franchise.php">Manage Franchise</a>
								</li>
							</ul>
						</li>
						<li>

							<a href="#"><i class="fa fa-rupee "></i> Payment<span class="fa arrow"></span></a>

							<ul class="nav nav-second-level">

								<li>

									<a href="collectform.php">Collect Fee</a>

								</li>

								<li>

									<a href="ledgerform.php">Payment Report</a>

								</li>

								<!-- <li>
									<a href="notesInformation.php">Notes Information</a>
								</li>
								<li>
									<a href="cancelPayment.php">Delete Receipt </a>
								</li> -->

							</ul>

						</li>

						<li>

							<a href="#"><i class="fa fa-barcode"></i> Address Book<span class="fa arrow"></span></a>

							<ul class="nav nav-second-level">

								<li>

									<a href="addressbook.php">New Entry</a>

								</li>

								<li>

									<a href="viewaddress.php">View Address</a>

								</li>

							</ul>

						</li>

						<li>

							<a href="#"><i class="fa fa-book   "></i> Day Book<span class="fa arrow"></span></a>

							<ul class="nav nav-second-level">

								<li>

									<a href="daybookform.php">View Day Book</a>

								</li>

								<li>

									<a href="depositcash.php">Deposit Cash</a>

								</li>

								<li>

									<a href="withdrawcash.php">Withdrawl Cash</a>

								</li>

								<li>

									<a href="expenseentry.php">Expense Entry</a>

								</li>

								<li>

									<a href="expensedelete.php">Expense Delete</a>

								</li>

							</ul>

						</li>

						<li>

							<a href="#"><i class="fa fa-navicon"></i> Reports<span class="fa arrow"></span></a>

							<ul class="nav nav-second-level">

								<li>

									<a href="studentsinfo.php">All Student Information</a>

								</li>

								<li>

									<a href="studentqueryform.php">Student Query By Month,Course </a>

								</li>

								<li>

									<a href="feesqueryform.php">Due Report</a>

								</li>

								<li>

									<a href="discountList.php">Discount List</a>

								</li>

								<li>

									<a href="batchwisequery.php">Batch Wise Query</a>

								</li>

								<li>

									<a href="newadmissionform.php">New Admission Course wise</a>

								</li>

								<li>

									<a href="sesionwiseAdmissionForm.php">New Admission Session wise</a>

								</li>

								<!--<li>
									 <a href="collectionform.php">Collection List Date Wise</a>
								</li> 
								<li>
									 <a href="duelistform.php">Due List Month Wise</a>
								</li>-->

							</ul>

						</li>

						<li>

							<a href="#"><i class="fa fa-graduation-cap"></i> I-Card<span class="fa arrow"></span></a>

							<ul class="nav nav-second-level">

								<li>

									<a href="icardform.php">Print I-Card</a>

								</li>



							</ul>

						</li>

						<!--<<li>

							<a href="#"><i class="fa fa-graduation-cap"></i> Students Enquery <span class="fa arrow"></span></a>

							 <ul class="nav nav-second-level">

								<li>

									 <a href="contactform.php">Add New Enquery</a>

								</li>

								<li>

									 <a href="viewquery.php">View Enquery Students</a>

								</li>

							 </ul>

						</li>

						li>

							<a href="#"><i class="fa fa-comments"></i> Messaging<span class="fa arrow"></span></a>

							 <ul class="nav nav-second-level">

								<li>

									 <a href="messaging.php">Group SMS Send</a>

									 <a href="sms.php">Quick SMS Send</a>

								</li>

								

							 </ul>

						</li>

						<li>
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



					</ul>

					<!-- /.nav-second-level -->

					</li>

					</ul>

					</ul>

				</div>

				<!-- /.sidebar-collapse -->

			</div>

			<!-- /.navbar-static-side -->

		</nav>