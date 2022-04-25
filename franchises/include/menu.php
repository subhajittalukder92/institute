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
<style>
#overlay{	
  position: fixed;
  z-index: 99999;
  width: 100%;
  height:100%;
  display: none;
  background: rgba(0,0,0,0.6);
}
.cv-spinner {
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;  
}
.spinner {
  width: 40px;
  height: 40px;
  border: 4px #ddd solid;
  border-top: 4px #2e93e6 solid;
  border-radius: 50%;
  animation: sp-anime 0.8s infinite linear;
}
@keyframes sp-anime {
  100% { 
    transform: rotate(360deg); 
  }
}
.is-hide{
  display:none;
}
</style>
<body>
<div id="overlay">
	  <div class="cv-spinner">
	    <span class="spinner"></span>
	  </div>
	</div>
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

						<i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['franchise_name']; ?> <i class="fa fa-caret-down"></i>

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