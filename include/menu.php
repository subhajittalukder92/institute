<?php include('include/check-login.php'); 
// print_r($_SESSION);
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
			<ul class="nav navbar-top-links navbar-right">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i> ADMIN <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-message">
						<li><a href="changepassword.php"><i class="fa fa-shield fa-fw"></i> Change Password</a></li>
						<li class="divider"></li>
						<li><a href="logout.php"><i class="fa fa-power-off fa-fw"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">
						<li><a href="home.php"><i class="fa fa-dashboard fa-fw"></i> Dashbord</a></li>
						<li>
							<a href="#"><i class="fa fa-bookmark"></i> Session Creator<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="session.php">Manage Session</a></li>
							</ul>
						</li>
						<li>
							<a href="#"><i class="fa fa-users"></i> Manage User<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="user.php">User Management</a></li>
							</ul>
						</li>
						<li>
							<a href="#"><i class="fa fa-plus-circle"></i> Admission Form<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="admissionformprint.php">Print Admission-Form</a></li>
							</ul>
						</li>
						<li>
							<a href="#"><i class="fa fa-plus-circle"></i> Notice<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="newnotice.php">New Notice</a></li>
								<li><a href="notices.php">Manage Notice</a></li>
							</ul>
						</li>
						<li>
							<a href="#"><i class="fa fa-th-list"></i> Course Creator<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="newcourses.php">Add New Course</a></li>
								<li><a href="viewcourses.php">View Course</a></li>
							</ul>
						</li>
						<li>
							<a href="#"><i class="fa fa-th-list"></i> Semeters <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="newsubject.php">Add New Semeter</a></li>
								<li><a href="viewsubject.php">View Semeters</a></li>
							</ul>
						</li>
						<li>
							<a href="#"><i class="fa fa-rupee "></i> Franchise<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="franchise.php">Manage Franchise</a></li>
							</ul>
						</li>
						<li>
							<a href="#"><i class="fa fa-rupee "></i> Payment<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="ledgerform.php">Payment Report</a></li>
							</ul>
						</li>
						<li>
							<a href="#"><i class="fa fa-navicon"></i> Reports<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="studentsinfo.php">All Student Information</a></li>
								<li><a href="studentqueryform.php">Student Query By Month,Course </a></li>
								<li><a href="feesqueryform.php">Due Report</a></li>
								<li><a href="discountList.php">Discount List</a></li>
								<li><a href="batchwisequery.php">Batch Wise Query</a></li>
								<li><a href="newadmissionform.php">New Admission Course wise</a></li>
								<li><a href="sesionwiseAdmissionForm.php">New Admission Session wise</a></li>
							</ul>
						</li>
						<li>
							<a href="#"><i class="fa fa-th-list"></i> Certificates <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="issue-certificate.php">Issue Certificates</a></li>
								<li><a href="print-certificate.php">Print Certificates</a></li>
								<li><a href="view-certificate.php">View Certificates</a></li>
							</ul>
						</li>
						<li>
							<a href="#"><i class="fa fa-th-list"></i> Website <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="about-us.php">About Us</a></li>
								<li><a href="downloads.php">Download</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>